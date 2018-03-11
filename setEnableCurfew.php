<?php

if(!$argv[2]) {
        die("Usage: php ".$_SERVER['PHP_SELF']." lockTime unlockTime (eg. 18:00 06:00)\n");
}

include_once 'getDevices.php';
	
$json = json_encode(array("curfew" => array("enabled" => true, "lock_time" => "$argv[1]", "unlock_time" => "$argv[2]")));
$ch = curl_init($endpoint."/api/device/$flap/control");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Content-Length: ".strlen($json),"Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']['curfew']['enabled']==true) {
	print "Successfully Enabled Curfew For \"$flapname\" Between $argv[1] & $argv[2]\n";
} else {
	die("Enable Curfew Failed!\n");
}

?>
