<?php
include('../includes/vt-config.php');
include('../api/callApi.php');

if (isset($_POST['url_product'])) {
    $urlProduct = $_POST['url_product'];
    $idxCat = $_POST['idx_cat'];
    $jsonTypeProduct = getTypeByProduct(ROOTHOST_API_SEARCH, $urlProduct);
    $jsonTypeProduct = json_decode($jsonTypeProduct);
    $resp = "";
    foreach($jsonTypeProduct as $key => $value) {
        if ($key%10===0) {
            $resp.="<div class=\"col-lg-3\">
                <ul class=\"list_type_product\" >";
        }
        
        if (strlen($value->name) > 33) {
            $typeName = substr($value->name, 0, 33).'...';
        } else {
            $typeName = $value->name;
        }

        $resp .= "<li onclick=\"getUrlTypeOfProduct('$key', '$urlProduct', '$idxCat')\"><a href=\"#\" title=".$value->name."><i class=\"fa fa-check-square-o\"></i>&nbsp;$typeName</a></li>";
        $next = (int)$key + 1;

        // end uldiv
        if ($next%10===0) {
            $resp.="</ul></div>";
        }
    }
	echo $resp;	
}
?>