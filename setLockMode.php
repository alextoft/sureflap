<?php

if(!$argv[1]) {
	die("Usage: php ".$_SERVER['PHP_SELF']." [in|out|both|none]\n");
}

switch($argv[1]) {
	case "in":
		$lock = 2;
		break;
	case "out":
		$lock = 1;
		break;
	case "both":
		$lock = 3;
		break;
	case "none":
		$lock = 0;
		break;
	default:
		die("Usage: php ".$_SERVER['PHP_SELF']." [in|out|both|none]\n");
}

include_once 'getDevices.php';

$json = json_encode(array("locking" => "$lock"));
$ch = curl_init($endpoint."/api/device/$flap/control");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Content-Length: ".strlen($json),"Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']['locking']==$lock) {
	print "Successfully Set \"$flapname\" Lock Mode!\n";
} else {
	die("Lock Mode Change Failed!\n");
}

?>
