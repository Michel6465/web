<?php

function route ($routeName) {
	return "/$routeName";
}

function asset ($assetName) {
	$extension = pathinfo($assetName, PATHINFO_EXTENSION);
	$refresh = in_array($extension, ['css', 'js']);
	
	$result = '../public/'.($refresh?$extension.'/':'').str_replace(' ', '%20', $assetName);
	if ($refresh) $result = $result.'?'.time();
	
	return $result;
}


?>
