<?php

include_once 'getHousehold.php';

$ch = curl_init($endpoint."/api/household/$household/device");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $token"));
$result = json_decode(curl_exec($ch),true) or die("Curl Failed\n");

if($result['data']) {
	foreach($result['data'] as $foo) {
		print "Device ID: ".$foo['id']."\n";
		switch($foo['product_id']) {
			case 1:
				print "Device Type: Hub\n";
				$hub = $foo['id'];
				$hubname = $foo['name'];
				break;
                        case 2:
                                print "Device Type: Repeater\n";
                                break;
                        case 3:
                                print "Device Type: Pet Door Connect\n";
				$flap = $foo['id'];
				$flapname = $foo['name'];
                                break;
                        case 4:
                                print "Device Type: Pet Feeder Connect\n";
                                break;
                        case 5:
                                print "Device Type: Programmer\n";
                                break;
                        case 6:
                                print "Device Type: DualScan Cat Flap Connect\n";
				$flap = $foo['id'];
				$flapname = $foo['name'];
                                break;
		}
		print "Device Name: ".$foo['name']."\n";
		print "Device MAC Address: ".$foo['mac_address']."\n";
		if($foo['serial_number']) {
			print "Device Serial Number: ".$foo['serial_number']."\n";
		}
	}
}

?>
