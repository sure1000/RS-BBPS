<?php
	
	$o1->provider_id = $_POST['dish'];

	if ($o1->provider_id == "" || $o1->provider_id == "0") {
		$result['error'] = 1;
		$result['error_msg'] = "Something went wrong. Please try again";
	} else {
		$o1 = $factory->get_object($o1->provider_id, "providers", "provider_id");

		$result['error'] = 0;
		if ($o1->logo == "") {
			$result['logo'] = "<img src='img/logo.png' width='100' class='img-rounded' />";
		} else {
			$result['logo'] = "<img src='provider_logos/thumbs/" . $o1->logo . "' width='100' class='img-rounded' />";
		}
echo json_encode($result);
}
?>