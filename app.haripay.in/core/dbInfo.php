<?php

date_default_timezone_set('Asia/Kolkata');

function connect_database() {
	$fetchType = "array";
	$dbHost    = "localhost";
	$dbLogin   = "haripayi_tajmoney";
	$dbPwd     = "(TQy_hOiH=0O";
	$dbName    = "haripayi_tajmoney";
	$con       = mysqli_connect($dbHost, $dbLogin, $dbPwd, $dbName);
	if (!$con) {
		die("Database Connection failes" . mysqli_connect_errno());
	}
	return ($con);
}

?>
