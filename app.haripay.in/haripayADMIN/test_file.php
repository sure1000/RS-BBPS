<?php
$id =4;
$myfile = "../callback_apis$id.php";
//echo $myfile; die;
copy('../callback_roundpay1.php', $myfile);

file_put_contents($myfile,str_replace('SSS','STATUS',file_get_contents($myfile)));
file_put_contents($myfile,str_replace('RRR','AGENTID',file_get_contents($myfile)));
file_put_contents($myfile,str_replace('OOO','LIVEID',file_get_contents($myfile)));
file_put_contents($myfile,str_replace('SUCCC','2',file_get_contents($myfile)));
file_put_contents($myfile,str_replace('FADDD','3',file_get_contents($myfile)));
file_put_contents($myfile,str_replace('$_METHOD','$_GET',file_get_contents($myfile)));
?>