<?php
session_start();

include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
	$_SESSION['user_id'] = $_GET['aid'];
	header("location:../index.php");
} else {
	header("location:team.php?msgiid=4");
}
?>