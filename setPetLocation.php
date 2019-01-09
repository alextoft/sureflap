<?php

if($argv[1]!="1" && $argv[1]!="2") {
        die("Usage: php ".$_SERVER['PHP_SELF']." location (1 == inside, 2 == outside)\n");
}

include_once 'getPet.php';

$json = json_encode(array("where" => $argv[1], "since" => date("Y-m-d H:i")));	
$ch = curl_init($endpoint."/api/pet/$pet/position");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Content-Length: ".strlen($json),"Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']['where']==$argv[1]) {
	print "Successfully Set Location\n";
} else {
	die("Set Location Failed\n");
}

?>

