<?php
if (isset($_SESSION['CAT'])) {
	unset($_SESSION['CAT']);
}
if (isset($_SESSION['TYPE_PRO'])) {
	unset($_SESSION['TYPE_PRO']);
}
if (isset($_SESSION['CACHE_CONDITION'])) {
	unset($_SESSION['CACHE_CONDITION']);
}
if (isset($_SESSION['URL_TYPE'])) {
	unset($_SESSION['URL_TYPE']);
}
if (isset($_SESSION['COND_SEARCH'])) {
	unset($_SESSION['COND_SEARCH']);
}

?>