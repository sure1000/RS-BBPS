<?php
include "include.php";
$mobile = $_POST['mobile'];
if ($mobile){
    $service = $_POST['service'];
      $api_response = get_number_info_planapi($mobile);
      if($api_response['Operator'] == "BSNL"){
        //$api_response['records']['Operator'] = "BSNL (Topup)";
        }
    if($api_response['Operator'] == "Reliance Jio Infocomm Limited"){
        $api_response['Operator'] = "Jio";
    }
    $provider_name = ucfirst(strtolower($api_response['Operator']));
    
    $circle_name = ucfirst($api_response['Circle']);
    
    if($circle_name == "Bihar and Jharkhand"){
        $circle_name = "Bihar Jharkhand";
    }
   else if($circle_name == "MP and Chattisgarh"){
        $circle_name = "Madhya Pradesh Chhattisgarh";
    }
   else if($circle_name == "Delhi"){
        $circle_name = "Delhi Ncr";
    }
else if($circle_name == "UP West and Uttaranchal"){
        $circle_name = "Up West And Uttaranchal";
    }
	else if($circle_name == "UP East"){
		$circle_name = "Up East";
         }
	else if($circle_name == "Maharashtra and Goa"){
		$circle_name = "Maharashtra And Goa";
         }
else if($circle_name == "Jammu and Kashmir"){
		$circle_name = "Jammu And Kashmir";
         }		 
    // if($provider_name == "Vodafone"){
    //     $provider_name = "Vodafone Idea";
    // }
    if($provider_name == "Bsnl gsm"){
        $provider_name = "Bsnl";
    }
            $result['provider_name'] = $provider_name;
            $result['provider_id'] = get_provider_name_by_service($provider_name, $service);
            $result['circle'] = $circle_name;
            $result['api'] = $api_response;
        
    //}
}

echo json_encode($result);
?>