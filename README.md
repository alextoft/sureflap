# SureFlap Cloud API Examples

Linkage: https://www.surepetcare.com/en-gb/pet-doors/microchip-pet-door-connect

I have one of those posh IoT cat flaps, but the provided apps don't always float my boat. With a little tinkering I've managed to document most of the REST API used behind the scenes. This repo provides some very basic examples of how to talk to the API in order to retrieve data and set configuration.

The hub uses the LogMeIn Xively protocol to talk to the cloud, but exposes no open ports whatsoever on the LAN. My plan is to buy a spare, jailbreak it, then modify such as to do push notifications without being dependent on the cloud, but until then it's possible to implement a poor-man's alternative by polling the cloud for events. Push is obviously better, but if you can handle a few seconds lag then IFTTT is a possibility.

You will need: PHP and PHP_CURL.
You will have to: edit the config.php file and enter your own login details.

For sake of example, the scripts assume a single household with a single hub, a single cat flap and a single cat.

The scripts have various dependencies on each other, but you can do the following:

#### php login.php
(does what it says on the tin - does a login and retrieves a session token)

#### php getHousehold.php
(calls login.php, then displays details of the household)

#### php getPet.php
(calls getHousehold.php, then displays details of the pet registered to that household)

#### php getPetLocation.php
(calls getPet.php, then displays the pet's current location)

#### php getDevices.php
(calls getHousehold, then displays information for devices at the household)

#### php getCurfewStatus.php
(calls getDevices.php, then displays current curfew status - with times if enabled)

#### php setLockMode.php in|out|both|none
(calls getDevices.php, then sets the lock mode of the flap)

#### php setHubLedBrightness.php bright|dim|off
(calls getDevices.php, then sets the LED brightness of the "ears" on the hub.

More to come. Please don't piss and moan about the quality of the code - it's a Saturday afternoon hack over a few beers.

