<?php 
session_start();

include "include.php";



$result = mplan_plans("Jio", "Punjab");

pt($result);

?>