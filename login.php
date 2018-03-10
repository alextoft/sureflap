<?php

print "\n";

include_once 'config.php';

if($oldtoken = file_get_contents("token")) {
	print "Found Old Session Token. Attempting Logout... ";
	include 'logout.php';
}

$json = json_encode(array("email_address" => $email_address, "password" => $password, "device_id" => $device_id));

$ch = curl_init($endpoint."/api/auth/login");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Content-Length: ".strlen($json)));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']['token']) {
	print "New Login Successful for ".$result['data']['user']['first_name']." ".$result['data']['user']['last_name']."!\nToken: ".$result['data']['token'];
	$token = $result['data']['token'];
	file_put_contents("token",$token);
} else {
	die("Login Failed!\n");
}

print "\n";

?>
