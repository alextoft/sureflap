<?php
// getPets.php
// A bit like getPet.php, except it can deal with multiple pets.
// Instead of just printing the pets, it turns each one into an instance
// of the new custom object type 'Pet' and adds them to the $pets array

include_once 'getHousehold.php';
include_once 'pet_class.php';

$ch = curl_init($endpoint."/api/household/$household/pet");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

//print "creating array\n";
$pets = array();

if($result['data']) {
	foreach ($result['data'] as $currentpet) {
		// Create a new instance of type 'pet' and populate with returned data
		//print "Found a new pet... creating object\n";
		$pet = new Pet();
		$pet->pet_name = $currentpet['name'];
		$pet->pet_id = $currentpet['id'];
		if(isset($currentpet['comments'])) {
			$pet->pet_description = $currentpet['comments'];
		}
		if(isset($currentpet['date_of_birth'])) {
			$pet->pet_dob = substr($currentpet['date_of_birth'],0,10);
		}
		if(isset($currentpet['weight'])) {
			$pet->pet_weight = $currentpet['weight']." KG";
		}
		if($currentpet['gender']=="0") {
			$pet->pet_gender = "Female";
		} else {
			$pet->pet_gender = "Male";
		}
		if($currentpet['species_id']=="2") {
			$pet->pet_species = "Dog";
		} else {
			$pet->pet_species = "Cat";
		}
		// Add to array of pets
		$pets[] = $pet;
	}

	foreach($pets as $currentpet) {
			print_if_needed($currentpet->pet_id . ": " . $currentpet->pet_name . "\n",$suppression);
	}
	// How many pet objects?
	//print count($pets);




} else {
	die("No Pets!\n");
}

?>
