
<?php
if (!isset($_SESSION['CACHE_CONDITION']) && !isset($_SESSION['URL_TYPE'])) {
    $_SESSION['CACHE_CONDITION'] = array();
    $_SESSION['URL_TYPE'] = array();
}

// Isset GET searchbytype
if (isset($_GET['searchbytype'])) {
    $urlType = str_replace("@", '/', $_GET['searchbytype']);
    $urlType = 'https://www.digikey.com/products/en/'.$urlType;
    $lstConditionFillter = null;
    // If urlType not exist SESSION then get condition by new url
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
    // var_dump($lstConditionFillter);
}

// innit session if not isset
if (!isset($_SESSION['COND_SEARCH'])) {
    $_SESSION['COND_SEARCH'] = array();
}
// If event POST condition
if (isset($_POST['submit_form_fillter'])) {

    // Create json condition search item
    $jsonFilter = array("type" => $urlType);
    foreach ($lstConditionFillter as $cboName => $value) {
        // check list value condition is array or array object
        $isObject = false;
        for ($i=0; $i < count($value); $i++) {
            if (is_object($value[$i])) {
                $isObject = true;
                break;
            }
        }
        // key condition: Sheilding | Part Status.name is object
        $keyCondition = $isObject ? $cboName.'.name' : $cboName;
        // un unicode
        $cboName = strtolower(un_unicode($cboName));
        // execute data post
        if (isset($_POST['condition-'.$cboName])) {
            $arryPostData = $_POST['condition-'.$cboName];
            if (array_key_exists($keyCondition, $_SESSION['COND_SEARCH'])) {
                $_SESSION['COND_SEARCH'] = addConditionToArray($keyCondition, $arryPostData, $_SESSION['COND_SEARCH']);
            } else {
                $_SESSION['COND_SEARCH'][$keyCondition] = $arryPostData;
            }
        }
    } 
    // assign string condition
    $jsonFilter['conditions'] = $_SESSION['COND_SEARCH'];

    // get total item by condition
    $total_rows = getTotalItemsByConditions(ROOTHOST_API_SEARCH, json_encode($jsonFilter));
    // echo $total_rows;
    // Pagging
    if(isset($_POST["txtCurnpage"]))
        $_SESSION["CUR_PAGE_ACCOUNT"]=$_POST["txtCurnpage"];

    // if($_SESSION['CUR_PAGE_ACCOUNT'] > ceil($total_rows/MAX_ROWS))
        // $_SESSION['CUR_PAGE_ACCOUNT'] = ceil($total_rows/MAX_ROWS);
    
    $cur_page=$_SESSION['CUR_PAGE_ACCOUNT'];
    // echo '---'.$cur_page;
    // Setting offset and limit
    // echo $cur_page;
    $jsonFilter['offset'] = $cur_page > 0 ? ($cur_page - 1) * MAX_ROWS : 1;
    $jsonFilter['limit'] = MAX_ROWS;

    // echo $jsonFilter;
    // Call API search item by condition of type
    $respSearch = searchItemByConditionOfType(ROOTHOST_API_SEARCH , json_encode($jsonFilter));
    $respSearch = json_decode($respSearch);
    $dataHead = $respSearch != NULL ? $respSearch[0] : [];
    
    // var_dump($respSearch);
    // var_dump($_SESSION["COND_SEARCH"]);
}

// Check item combobox is exist or not session conditon before
function notExistCondSelected($item, $objCondSelected) {
    foreach ($objCondSelected as $key => $arr) {
        if (is_array($arr) && in_array($item, $arr)) {
            return true;
            break;
        }
    }
    return false;
}

function addConditionToArray($keyCondition, $arrData, $objCondSelected) {
    foreach ($objCondSelected as $key => $arr) {
        if ($keyCondition == $key) {
            for ($i=0; $i < count($arrData); $i++) { 
                if (!in_array($arrData[$i], $arr)) {
                    array_push($arr, $arrData[$i]);
                }
            }
            $objCondSelected[$key] = $arr;
        }
    }
    return $objCondSelected;
}

?>

<!-- Condition selected -->
<?php if (isset($_SESSION['COND_SEARCH']) && count($_SESSION['COND_SEARCH']) > 0):?>
<div class="bl-condition-selected">
    <ul class="lst-condition-selected">
        <?php
            if (isset($_SESSION['COND_SEARCH'])) {
                foreach ($_SESSION['COND_SEARCH'] as $key => $arrCond) {
                    if (is_array($arrCond)) {
                        foreach ($arrCond as $k => $val) {
                            echo "<li>".$val."</li>";
                        }
                    }
                }
            }
        ?>
    </ul>
</div>
<?php endif;?>

<div class="count-result-search">
    <p><strong>Kết quả: </strong><?php if (is_array($respSearch)) echo count($respSearch); else echo '0';?></p>
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
                    <?php if (is_array($value) && count($value) > 0):?>
                        <section class="col col-2">
                            <label class="label"><strong><?php echo $key;?></strong></label>
                            <label class="select select-multiple">
                                <select class="custom-scroll cbo_search_item" multiple="multiple" name="condition-<?php echo $cboName;?>[]" id="condition-<?php echo $cboName;?>" gr_condition="<?php echo $cboName;?>">
                                <?php
                                    for ($i=0; $i < count($value); $i++) {
                                        if (is_object($value[$i])) {
                                            if (isset($value[$i]->name) && !notExistCondSelected($value[$i]->name, $_SESSION['COND_SEARCH'])) {
                                                $optVal = $value[$i]->name;
                                                if (strpos($value[$i], '"') !== false) {
                                                    echo $value[$i]->name != '' ? "<option value='$optVal'>".$value[$i]->name."</option>" : '';
                                                } else {
                                                    echo $value[$i]->name != '' ? "<option value=\"$optVal\">".$value[$i]->name."</option>" : '';
                                                } 
                                            }
                                        } else {
                                            if (!notExistCondSelected($value[$i], $_SESSION['COND_SEARCH'])) {
                                                if (strpos($value[$i], '"') !== false) {
                                                    echo $value[$i] != '' ? "<option value='$value[$i]'>".$value[$i]."</option>" : '';
                                                } else {
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
                    <?php endif;?>
            <?php
                $stt++;
                if ($stt%6==0) {
                    echo "</div>";
                    $stt = 0;
                }
            }?>
          
        </div>
    </fieldset>
    <fieldset>
        <section>
            <div class="row">
                <div class="col col-2">
                    <label class="label"><strong>Stock status</strong></label>
                    <label class="checkbox">
                        <input name="checkbox" type="checkbox" value="In Stock">
                        <i></i>In Stock</label>
                    <label class="checkbox">
                        <input name="checkbox" type="checkbox" value="Normally Stocking">
                        <i></i>Normally Stocking</label>
                    <label class="checkbox">
                        <input name="checkbox" type="checkbox" value="New Products">
                        <i></i>New Products</label>
                </div>
                <div class="col col-2">
                    <label class="label"><strong>Media Available</strong></label>
                    <label class="checkbox">
                        <input name="checkbox" type="checkbox" value="Datasheet">
                        <i></i>Datasheet</label>
                    <label class="checkbox">
                        <input name="checkbox" type="checkbox" value="Photo">
                        <i></i>Photo</label>
                    <label class="checkbox">
                        <input name="checkbox" type="checkbox" value="EDA / CAD Models">
                        <i></i>EDA / CAD Models</label>
                </div>
                <div class="col col-2">
                    <label class="label"><strong>Environmental</strong></label>
                    <label class="checkbox">
                        <input name="checkbox" type="checkbox" value="RoHS Compliant">
                        <i></i>RoHS Compliant</label>
                    <label class="checkbox">
                        <input name="checkbox" type="checkbox" value="Non-RoHS Compliant">
                        <i></i> Non-RoHS Compliant</label>
                </div>
            </div>
        </section>
    </fieldset>
    <footer style="text-align: left;">
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
