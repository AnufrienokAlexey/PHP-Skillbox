<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$jsonHtml =  json_decode(file_get_contents('php://input'));
	if(isset($jsonHtml->raw_text)) {
/*		$search = '#<a.*?>(.*?)</a>#i';*/
		$search = '/<a[^>]*>(.*?)<\/a>/s';
		$html = preg_replace($search, '$1', $jsonHtml->raw_text);
		$jsonFormattedHtml = json_encode(['formatted_text' => $html]);
//		header("Content-Type: application/json");
		echo $jsonFormattedHtml;
	} else {
		http_response_code(500);
	}
}
