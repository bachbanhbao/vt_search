<?php
// @return all category
// @params $hostApi
function getCategoryFilter($rootHostApi) {
    $url = $rootHostApi.'getCategories';
    // echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// @return all product of category
// @params $hostApi, $urlCat
function getProductByCategory($rootHostApi, $urlCat) {
    $url = $rootHostApi.'getProductsByCategory?category='.$urlCat;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// @return all type of product
// @params $hostApi, $urlPro
function getTypeByProduct($rootHostApi, $urlPro) {
    $url = $rootHostApi.'getTypesByProduct?product='.$urlPro;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// @return all item of type
// @params $hostApi, urlType, $offset, $limit
function getItemsByType($rootHostApi, $urlType, $offset, $limit) {
    $url = $rootHostApi.'getItems?type='.$urlType.'&offset='.$offset.'&limit='.$limit;
    // echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// get all total Item by type
function getTotalItems($rootHostApi, $urlType) {
    $url = $rootHostApi.'getTotalItems?type='.$urlType;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// @return list condition filter
// @params $hostApi, urlType
function getConditionByType($rootHostApi, $urlType) {
    $url = $rootHostApi.'getConditionsByTypes?type='.$urlType;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// @return list condition
// @params $hostApi, urlType
function getCondByTypesAndCond($rootHostApi, $jsonCond) {
    $jsonCond = str_replace(array("\/", '\"', '"{', '"}', '")'), array('/', '"', "{", "}", '\")'), $jsonCond);
    // echo $jsonCond;

    $url = $rootHostApi.'getConditionsByTypesAndConditions';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonCond);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($jsonCond))                                                                       
    );                                                                                                                   
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// Sear item by condition type
function searchItemByConditionOfType($rootHostApi, $jsonCond) {
    $jsonCond = str_replace(array("\/", '\"', '"{', '"}', '")'), array('/', '"', "{", "}", '\")'), $jsonCond);
    // echo $jsonCond;
    $url = $rootHostApi.'getItemsByConditions';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonCond);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($jsonCond))                                                                       
    );                                                                                                                   
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}   

function getTotalItemsByConditions($rootHostApi, $jsonCond) {
    $jsonCond = str_replace(array("\/", '\"', '"{', '"}', '")'), array('/', '"', "{", "}", '\")'), $jsonCond);
    // echo $jsonCond;
    $url = $rootHostApi.'getTotalItemsByConditions';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonCond);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($jsonCond))                                                                       
    );                                                                                                                   
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
} 

?>