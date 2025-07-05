 <?php
  $post = ['shiba'=> "technology"];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,'https://partner.abhipay.in/apiservice/call_back.php');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
  $response = curl_exec($ch);
  curl_close($ch); // Close the connection
echo $response;
  ?>