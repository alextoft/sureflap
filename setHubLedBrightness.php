<?php

if(!$argv[1]) {
	die("Usage: php ".$_SERVER['PHP_SELF']." [bright|dim|off]\n");
}

switch($argv[1]) {
	case "bright":
		$led = 1;
		break;
	case "dim":
		$led = 4;
		break;
	case "off":
		$led = 0;
		break;
	default:
		die("Usage: php ".$_SERVER['PHP_SELF']." [bright|dim|off]\n");
}

include_once 'getDevices.php';

$json = json_encode(array("led_mode" => $led));
$ch = curl_init($endpoint."/api/device/$hub/control");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Content-Length: ".strlen($json),"Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']['led_mode']==$led) {
	print "Successfully Set $hubname LED Brightness!\n";
} else {
	die("LED Brightness Change Failed!\n");
}

?>
