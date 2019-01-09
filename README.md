# SureFlap Cloud API Examples

Linkage: https://www.surepetcare.com/en-gb/pet-doors/microchip-pet-door-connect

I have one of those posh IoT cat flaps, but the provided apps don't always float my boat. With a little tinkering I've managed to document most of the REST API used behind the scenes. This repo provides some very basic examples of how to talk to the API in order to retrieve data and set configuration.

The hub uses the LogMeIn Xively protocol over HTTPS to talk to the cloud, but is not [obviously] vulnerable to any kind of MiTM attack and exposes no open ports whatsoever on the LAN. I've managed to get hold of a spare hub, but not done anything with it yet. It's all Microchip stuff, based around a 32bit/80MHz PIC32MX695F MIPS SoC with 512KB flash, 128KB RAM, 10/100 Ethernet and USB2 OTG. Also on the board are a WRF24J48MA 2.4GHz wireless module (to communicate with the flap) and obligatory ENC424J600 Ethernet controller to manage it. The PCB appears to have an 8-pin FPC serial connector and JTAG interface which both look promising. Having said that, if it's possible to discover details of the wireless connection between hub and flap then a pure software implementation of the hub could be achievable.

You will need: PHP and PHP_CURL.
You will have to: copy config.php.dist file to config.php and enter your own login details.

For sake of example, the scripts assume a single household with a single hub, a single flap and a single cat (or dog).

The scripts have various dependencies on each other, but you can do the following:

#### php login.php
(does what it says - logs in and retrieves a session token)

#### php getHousehold.php
(calls login.php, then displays details of the household)

#### php getPet.php
(calls getHousehold.php, then displays details of the pet registered to that household)

#### php getPetLocation.php
(calls getPet.php, then displays the pet's current location)

#### php setPetLocation.php 1|2 (1 == inside, 2 == outside)
(calls getPet.php, then updates location with current timestamp)

#### php getDevices.php
(calls getHousehold.php, then displays information for devices at the household)

#### php getCurfewStatus.php
(calls getDevices.php, then displays current curfew status - with times if enabled)

#### php setLockMode.php in|out|both|none
(calls getDevices.php, then sets the lock mode of the flap. NB: manually changing the lock state may disable curfew mode!)

#### php setHubLedBrightness.php bright|dim|off
(calls getDevices.php, then sets the LED brightness of the "ears" on the hub)

#### php setEnableCurfew.php lockTime unlockTime (eg. 18:00 06:30)
(calls getDevices.php, then enables curfew mode between the lockTime and unlockTime specified - NB: if you change the curfew times when a curfew is in force and the flap is locked, the flap will unlock if the current time is outside those specified)

Plenty more to come, but please don't piss and moan about the quality of the code - it was a Saturday afternoon hack over a few beers.

I have no connection with SureFlap except for having used their products for a very long time; they do what it says on the tin and the after-sales support is exceptional. My old, non-IoT cat flap developed a fault after years of weather exposure and abuse by a pair of nutter cats, but after one phone call they sent me a part with idiot-proof fitting instructions and it was good as new. Difficult to fault that level of service.
