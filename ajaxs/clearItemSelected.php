<?php
session_start();
include('../includes/vt-function.php');
if (isset($_SESSION['COND_SEARCH']) && $_POST['clear_item']) {
	var_dump($_SESSION['COND_SEARCH']);
	$groupConditon = $_POST['clear_item'];
	foreach ($_SESSION['COND_SEARCH'] as $key => $arrCond) {
		if (is_array($arrCond)) {
			foreach ($arrCond as $k => $val) {
				$grep_key = strtolower(un_unicode($k));
				echo $grep_key."<br/>";
				if ($grep_key === $groupConditon) {
					echo 'here..';
		        	unset($_SESSION['COND_SEARCH'][$key]);
		        	break;
		        }	
			}
		}
    }
}
?>