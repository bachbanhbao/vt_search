<?php
// @return all category
// @params $hostApi
function getCategoryFilter($rootHostApi) {
    $url = $rootHostApi.'getCategories';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// @return all product of category
// @params $hostApi, $urlCat
function getProductByCategory($rootHostApi, $urlCat) 
{
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
    $url = $rootHostApi.'getItems?type='.$urlType.'&offset=0&limit=30';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// @return all item of type
// @params $hostApi, urlType
function getConditionByType($rootHostApi, $urlType) {
    // $url = $rootHostApi.'getConditionsByTypes?type=Interface%20Boards';
    $url = $rootHostApi.'getConditionsByTypes?type='.$urlType;
    // echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// Sear item by condition type
function searchItemByConditionOfType($rootHostApi, $condition) {
    // $condition = '{"type":"https:\/\/www.digikey.com\/products\/en\/cable-assemblies\/barrel-power-cables\/464","offset":"0","limit":"30","conditions":"{\"Style\":[\"Jack to Plug\",\"Jack to Wire Leads\",\"Jack to Plug, Right Angle\"]}"}';
    $condition = '{"type":"https:\/\/www.digikey.com\/products\/en\/cable-assemblies\/barrel-audio-cables\/464","offset":"0","limit":"30","conditions":"{\"Shielding\":[\"Shielded\"]}"}';
    // echo $condition;
    $url = $rootHostApi.'getItemsByConditions';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $condition);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($condition))                                                                       
    );                                                                                                                   
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}   



?>