<?php

include 'include.php';


if(isset($_POST)){

	$sql ="Select * from pincode where district_name ='".$_POST['district']."' and pincode ='".$_POST['pincode']."'";
	$res = getXbyY($sql);
	$rows =count($res);

if($rows > 0){

for($i=0; $i< $rows; $i++){
	 $results[$i]['post_office'] = ucwords(strtolower($res[$i]['post_office']));


}
$result['Postoffice_list']=$results;
	$result['error_msg'] ="PostOffices List";
}else{
$result['Postoffice_list']=[];
	$result['error_msg'] ="No Data Found";
}


$result['error'] ='0';

	
}else{
	$result['error'] ='1';
	$result['error_msg'] ="Something Went Wrong";
}

echo json_encode($result);

?>