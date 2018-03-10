<?php

include_once 'getHousehold.php';

$ch = curl_init($endpoint."/api/household/$household/pet");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']) {
	print "Pet ID: ".$result['data'][0]['id']."\n";
	$pet = $result['data'][0]['id'];
	print "Pet Name: ".$result['data'][0]['name']."\n";
	$petname = $result['data'][0]['name'];
	print "Pet Description: ".$result['data'][0]['comments']."\n";
	print "Pet DOB: ".substr($result['data'][0]['date_of_birth'],0,10)."\n";
	print "Pet Weight: ".$result['data'][0]['weight']." KG\n";
	if($result['data'][0]['gender']=="0") {
		print "Pet Gender: Female\n";
	} else {
		print "Pet Gender: Male\n";
	}
	if($result['data'][0]['species_id']=="2") {
		print "Pet Species: Dog\n";
	} else {
		print "Pet Species: Cat\n";
	}
	$pet = $result['data'][0]['id'];
} else {
	die("No Pet!\n");
}

?>
