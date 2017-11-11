<?php
require_once __DIR__."/../config.php";

include_once __DIR__."/".CONFIG_PATH."config.php";
require_once __DIR__."/".SHRUB_PATH."api.php";
require_once __DIR__."/".SHRUB_PATH."node/node.php";
require_once __DIR__."/".SHRUB_PATH."theme/theme.php";

function GetActiveEvent() {
	$root = nodeCache_GetById(1);
	if ( $root && $root['meta'] && $root['meta']['featured'] ) {
		return nodeCache_GetById(intval($root['meta']['featured']));
	}
	return null;
}

api_Exec([
["homework/get", API_GET | API_AUTH, API_CHARGE_1, function(&$RESPONSE) {
	$event = GetActiveEvent();
	$user_id = userAuth_GetID();
	
	$mode = intval($event['meta']['theme-mode']);

	//$RESPONSE['ev'] = $event;
	
	$RESPONSE['homework'] = [];
	
	if ( $mode == 1 ) {
		$RESPONSE['homework'][] = ["Get some fresh air", false];
	}
}],
]);


