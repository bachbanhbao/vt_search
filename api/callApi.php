<?php
function callApiCurl($method, $url, $data = false) {
    $curl = curl_init($url);
    switch ($method) {
        case "POST":
            // Thiết lập có return
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
             
            // Thiết lập sử dụng POST
            curl_setopt($curl, CURLOPT_POST, count($param));
             
            // Thiết lập các dữ liệu gửi đi
            curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;

        case "GET":
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            break;
            
        default:
            break;
    }

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function getCategoryFilter() {
    $url = "https://10.55.123.102:5000/getCategories";
    echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

function getProductByCat($catUrl) {
    $url = $catUrl;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

function getSubProduct($productUrl) {
    $url = $productUrl;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

function searchDataByProduct($condition) {
    $url = "";
    $curl = curl_init($url);
    // Thiết lập có return
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     
    // Thiết lập sử dụng POST
    curl_setopt($curl, CURLOPT_POST, count($condition));
     
    // Thiết lập các dữ liệu gửi đi
    curl_setopt($curl, CURLOPT_POSTFIELDS, $condition);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}   



?>