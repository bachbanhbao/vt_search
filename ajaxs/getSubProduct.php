<?php
include('../api/callApi.php');
if (isset($_POST['product'])) {
	$product = $_POST['product'];
	
	$data = "";
	$data .= "<li><a href=\"cat-http://themes.semicolonweb.com/html/canvas/index.html-product-1vs\"><i class=\"fa fa-check-square-o\"></i>&nbsp;Accessories (2367 items) (2367 items)</a></li>";
    $data .="<li><a href=\"product-2\"><i class=\"fa fa-check-square-o\"></i>&nbsp;Cam Positioners (16 items) (16 items)</a></li>";
    $data .="<li><a href=\"#\"><i class=\"fa fa-check-square-o\"></i>&nbsp;Controllers - Accessories (1175 items) (1175 items)</a></li>";
    $data .="<li><a href=\"#\"><i class=\"fa fa-check-square-o\"></i>&nbsp;Accessories (2367 items) (2367 items)</a></li>";
    $data .="<li><a href=\"#\"><i class=\"fa fa-check-square-o\"></i>&nbsp;Controllers - Cable Assemblies (2825 items) (2825 items)</a></li>";
	echo $data;	
}

?>