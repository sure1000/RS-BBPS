<?php
//https://abhipay.net/API/FetchBill?
$post = "http://abhipay.net/API/FetchBill?UserID=106&Token=658ec3ecf693bbea290a124c46c4a550&Account=3000918410&Amount=0&SPKey=330&APIRequestID=1891889&GEOCode=23.8530,87.9727&CustomerNumber=9800855244&Pincode=743329";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  
  curl_close($ch); // Close the connection
  $response = curl_exec($ch);
echo "<pre>";print_r($response);
?>
