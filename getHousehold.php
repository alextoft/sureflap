<?php

include_once 'login.php';

$ch = curl_init($endpoint."/api/household");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']) {
	print "Household ID: ".$result['data'][0]['id']."\nHousehold Name: ".$result['data'][0]['name']."\n";
	$household = $result['data'][0]['id'];
} else {
	die("No Household!\n");
}

?>
