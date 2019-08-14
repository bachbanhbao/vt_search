<?php
session_start();
if (isset($_SESSION['COND_SEARCH'])) {
	unset($_SESSION['COND_SEARCH']);
}
?>