<?php
session_start();
include('../includes/vt-config.php');
include('../api/apiFuncCallBackend.php');

if (isset($_POST['idxType'])) {
    $idxType = $_POST['idxType'];
    $urlProduct = $_POST['urlPro'];
    
    // get type of pro
    $jsonTypeProduct = getTypeByProduct(ROOTHOST_API_SEARCH, $urlProduct);
    $jsonTypeProduct = json_decode($jsonTypeProduct);

    if (is_array($jsonTypeProduct)) {
        // have record -> return url type of product
    	$urlType = $jsonTypeProduct[$idxType]->url;
        $urlType = str_replace('https://www.digikey.com/products/en/', '', $urlType);
        $urlType = str_replace('/', '@', $urlType); 
        echo $urlType;
    } else {
    	echo 'no_record';
    }
}
?>