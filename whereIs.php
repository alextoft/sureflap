<?php
// whereIs.php
// Outputs a JSON formatted message { "location" : "LOCATION STRING" }
// based on a supplied GET paramater called 'name', eg: /whereIs.php?name=CattyMcCatface


// Set $silence_other_functions to true if you want to hide their print output.
$silence_other_functions = true;

include_once 'getPets.php';

print "{ \"location\": \"";

//Must be passed a GET parameter named 'name',
if(isset($_GET['name']) && !empty($_GET['name'])){
    $supplied_pet_name = $_GET['name'];
		$discovered_pet_id = -1;

		// Need to find out if we have a pet by this name
		foreach($pets as $currentpet) {
			$sanitised_supplied_pet_name = strtolower($supplied_pet_name);
			$sanitised_current_pet_name =  strtolower($currentpet->pet_name);
      //print "Checking supplied (" . $supplied_pet_name . ") against current (" . $currentpet->pet_name . ")\n";
			if(strcmp($sanitised_current_pet_name,$sanitised_supplied_pet_name) == 0) {
        //print "match found\n";
				// This is the pet...
				$discovered_pet_id = $currentpet->pet_id;
				// Break out of the foreach loop... we've found our pet
				break 1;
			}
		}

		// Right then, have we got a pet?
		if($discovered_pet_id >= 0) {
			//Yup, so where is the little bugger?
			$ch = curl_init($endpoint."/api/pet/$discovered_pet_id/position");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $token"));
			$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");
			if($result['data']) {
				if($result['data']['where']=="1") {
					print "inside";
				} else {
					print "outside";
				}
			}

		}
		else {
			//print "No pet with that name found";
      print "not found";
		}



} else {
    //print "No pet name supplied.";
    print "not found";
}

print "\" }";

?>
