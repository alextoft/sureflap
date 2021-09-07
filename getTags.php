<?php

include_once 'getDevices.php';

$ch = curl_init($endpoint."/api/device/$flap/tag");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']) {
	foreach($result['data'] as $foo) {
		print "Tag ID: ".$foo['id']."\n";
		$profilename = "Unknown";
		switch($foo['profile']) {
			case 2:
				$profilename = "Outdoor";
				break;
			case 3:
				$profilename = "Indoor";
				break;
			case 5:
				$profilename = "Intruder";
				break;
		}
		print "Profile: ".$foo['profile']." (".$profilename.")\n";
	}
}

?>
