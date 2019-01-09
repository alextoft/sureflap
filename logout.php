<?php

if(!$oldtoken) {
	$oldtoken = file_get_contents("token") or die("No token to logout!\n");
}

$ch = curl_init($endpoint."/api/auth/logout");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer $oldtoken"));
$result = curl_exec($ch);

if(curl_getinfo($ch, CURLINFO_HTTP_CODE)=="200") {
	print "Success!\n";
} else {
	print "Token Invalid/Expired!\n"; // Probably...
}

?>
