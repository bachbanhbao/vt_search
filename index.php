<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
// include config
define('incl_path','includes/');
define('libs_path','libs/');
define('api_path','api/');

require_once(incl_path.'simple_html_dom.php');
require_once(incl_path.'vt-config.php');
require_once(incl_path.'vt-function.php');
require_once(api_path.'callApi.php');
require_once(libs_path.'cls.template.php');

$tmp = new CLS_TEMPLATE();
$tmp_name = $tmp->loadDefaultTemplate();
$this_tem_path = TEM_PATH.$tmp_name.'/';
define('ISHOME',true);
define('THIS_TEM_PATH',$this_tem_path);
$tmp->wapperTemplate();



// $condition = '{"type":"https://www.digikey.com/products/en/cable-assemblies/coaxial-cables-rf/456","offset":"0","limit":"30","conditions":"{"Impedance":["50 Ohms"]}';
// $condition = '{"type":"https://www.digikey.com/products/en/cable-assemblies/coaxial-cables-rf/456", "offset":"0","limit":"10","conditions":{"Impedance":["50 Ohms"]}}';

// $rs = getTotalPoint();
// $rs = json_decode($rs);
// var_dump($rs);


?>

