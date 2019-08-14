 
<?php
if (!isset($_SESSION['CACHE_CONDITION']) && !isset($_SESSION['URL_TYPE'])) {
    $_SESSION['CACHE_CONDITION'] = array();
    $_SESSION['URL_TYPE'] = array();
}

if (isset($_GET['searchbytype'])) {
    $urlType = str_replace("@", '/', $_GET['searchbytype']);
    $urlType = 'https://www.digikey.com/products/en/'.$urlType;
    $lstConditionFillter = null;

    if (!in_array($urlType, $_SESSION['URL_TYPE'])) {
        array_push($_SESSION['URL_TYPE'], $urlType);
        
        // @params $RoothostAPI and $urlType
        // @Return list condition by type
        $resp = getConditionByType(ROOTHOST_API_SEARCH , $urlType);
        $resp = json_decode($resp);
        $objData = array($urlType => $resp);
        // push data condition to cache session
        array_push($_SESSION['CACHE_CONDITION'], $objData);
    }
    // get data condition from cache session
    foreach ($_SESSION['CACHE_CONDITION'] as $key => $value) {
        foreach ($value as $url => $data) {
            if ($urlType == $url) {
                $lstConditionFillter = $data;
                break;
            }
        }
    }
}

// innit session condition search
if (!isset($_SESSION['COND_SEARCH'])) {
    $_SESSION['COND_SEARCH'] = array();
}

// If event POST condition
if (isset($_POST['submit_form_fillter'])) {
    $jsonFilter = array("type" => $urlType, "offset" => "0", "limit" => "30");
    foreach ($lstConditionFillter as $cboName => $value) { 
        // un unicode
        $cboName = strtolower(un_unicode($cboName));

        // execute data post
        if (isset($_POST['condition-'.$cboName])) {
            $arryPostData = $_POST['condition-'.$cboName];
            $objItem = array($cboName => $arryPostData);
            // check condition of combobox exist in array session or not
            if (cboNameIsExistSession($cboName, $_SESSION['COND_SEARCH'])) {
                // add value combobox to array
                $_SESSION['COND_SEARCH'] = addConditionToArray($cboName, $arryPostData, $_SESSION['COND_SEARCH']);
            } else {
                array_push($_SESSION['COND_SEARCH'], $objItem);    
            }
        }
    }
    // execute create object string conditon
    $strCondition = "";
    for ($i=0; $i < count($_SESSION['COND_SEARCH']); $i++) { 
        $strCondition.= json_encode($_SESSION['COND_SEARCH'][$i]).',';
    }
    if ($strCondition != "") {
        $strCondition = substr($strCondition, 0, strlen($strCondition)-1);
    }
    // assign string condition
    $jsonFilter['conditions'] = $strCondition;
    // json_encode object to string
    $jsonFilter = json_encode($jsonFilter);
    // echo $jsonFilter;
    // Call API search item by condition of type
    $respSearch = searchItemByConditionOfType(ROOTHOST_API_SEARCH , $jsonFilter);
    $respSearch = json_decode($respSearch);
    $dataHead = $respSearch != NULL ? $respSearch[0] : [];
    
    // var_dump($respSearch);
    // var_dump($_SESSION["COND_SEARCH"]);
}

function notExistCondSelected($item, $objCondSelected) {
    foreach ($objCondSelected as $key => $arr) {
        if (is_array($arr)) {
            foreach ($arr as $kvalue => $value) {
                if (in_array($item, $value)) {
                    return true;
                    break;
                }
            }
        }
    }
    return false;
}
function cboNameIsExistSession($cboName, $objCondSelected) {
    foreach ($objCondSelected as $key => $arr) {
        if (is_array($arr)) {
            foreach ($arr as $kvalue => $value) {
                if ($cboName == $kvalue) {
                    return true;
                    break;
                }   
            }
        }
    }
    return false;
}
function addConditionToArray($cboName, $arrData, $objCondSelected) {
    foreach ($objCondSelected as $key => $arr) {
        if (is_array($arr)) {
            foreach ($arr as $kvalue => $value) {
                if ($cboName == $kvalue) {
                    for ($i=0; $i < count($arrData); $i++) { 
                        if (!in_array($arrData[$i], $value)) {
                            array_push($value, $arrData[$i]);
                        }
                    }
                    $objCondSelected[$key][$kvalue] = $value;
                }   
            }
        }
    }
    // var_dump($objCondSelected);
    return $objCondSelected;
}

?>

<!-- Condition selected -->
<div class="bl-condition-selected">
    <ul class="lst-condition-selected">
        <?php
            if (isset($_SESSION['COND_SEARCH'])) {
                foreach ($_SESSION['COND_SEARCH'] as $key => $arrCond) {
                    if (is_array($arrCond)) {
                        foreach ($arrCond as $k => $val) {
                            for ($i=0; $i < count($val); $i++) { 
                                echo "<li>".$val[$i]."</li>";
                            }
                        }
                    }
                }
            }
        ?>
    </ul>
</div>

<?php if ($lstConditionFillter != null) :?>
<div style="clear: both;"></div>
<form class="smart-form ng-untouched ng-pristine ng-valid" novalidate="" id="form-search" method="POST" action="">
    <fieldset style="padding-top: 10px;">
        <div class="row more" data-mrc>
            <?php
                $stt=0;
                foreach ($lstConditionFillter as $key => $value) { 
                    $cboName = strtolower(un_unicode($key));
                    if ($stt==0) echo "<div class=\"row\">";
                ?>

                   <section class="col col-2">
                        <label class="label"><strong><?php echo $key;?></strong></label>
                        <label class="select select-multiple">
                            <select class="custom-scroll cbo_search_item" multiple="multiple" name="condition-<?php echo $cboName;?>[]" id="condition-<?php echo $cboName;?>" gr_condition="<?php echo $cboName;?>">
                              <?php
                                    if (is_array($value)) {
                                        for ($i=0; $i < count($value); $i++) {
                                            if (is_object($value[$i])) {
                                                if (isset($value[$i]->name) && !notExistCondSelected($value[$i]->name, $_SESSION['COND_SEARCH'])) {
                                                    $value[$i]->name = str_replace('"', "", $value[$i]->name);
                                                    echo $value[$i]->name != '' ? "<option value=".$value[$i]->name.">".$value[$i]->name."</option>" : '';
                                                }
                                            } else {
                                                if (!notExistCondSelected($value[$i], $_SESSION['COND_SEARCH'])) {
                                                    $value[$i] = str_replace('"', "", $value[$i]);
                                                    echo $value[$i] != '' ? "<option value=\"$value[$i]\">".$value[$i]."</option>" : '';
                                                }
                                            }
                                        }    
                                    }
                                ?>
                            </select>
                        </label>
                        <div class="clear-all-item-selected" id="clear-<?php echo $cboName;?>" onclick="clearItemSelected('<?php echo $cboName;?>')">
                            <span style="color: red"><i class="fa fa-trash-o"></i>&nbsp;Xóa</span>
                        </div>
                    </section>  
            <?php
                $stt++;
                if ($stt%6==0) {
                    echo "</div>";
                    $stt = 0;
                }
            }?>
          
        </div>
         
    </fieldset>
    <footer>
        <input type="hidden" name="submit_form_fillter">
        <button class="btn btn-danger" onclick="clearConditionSearch()" type="button">
            <i class="fa fa-trash-o"></i>
            Xóa điều kiện
        </button>
        <button class="btn btn-primary" type="button" id="btn-search" onclick="submitForm()">
            <i class="fa fa-search"></i>
            Tìm kiếm
        </button>
    </footer>
</form>
<?php endif;?>
