<?php

include_once 'getPet.php';

$ch = curl_init($endpoint."/api/pet/$pet/position");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']) {
	if($result['data']['where']=="1") {
		print "$petname's Current Location: Inside\n";
	} else {
		print "$petname's Current Location: Outside\n";
	}
}

print "\n";

?>
