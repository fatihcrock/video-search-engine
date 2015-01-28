<?php

function truncate($text, $limit = 25, $ending = '...') {

	$text = strip_tags($text);
	
	if (strlen($text) > $limit) {
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, -(strlen(strrchr($text, ' '))));
		$text = $text . $ending;
	}
	
	return $text;
}

function is_ajax(){
	
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		$result=true;
	}else{
		$result =false;
	}
	return $result;
	
}

?>