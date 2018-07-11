<?php

include_once 'getDevices.php';

$ch = curl_init($endpoint."/api/household/$household/device?with[]=control");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']) {
	if($result['data'][1]['control']['curfew']['enabled']=="true") {
		print "Curfew for \"$flapname\": Enabled\n";
		print "Curfew Lock Time: ".$result['data'][1]['control']['curfew']['lock_time']."\n";
		print "Curfew Unlock Time: ".$result['data'][1]['control']['curfew']['unlock_time']."\n";
	} else {
		print "Curfew for \"$flapname\": Disabled\n";
	}
}

?>
