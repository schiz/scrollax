<?php
/*
 *
 */
function feedReader($source, $method) {
	if (function_exists('curl_init')) {
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_URL, $source);
		$data = curl_exec($ch);
		curl_close($ch);
	} else {
		$data = file_get_contents($source);
        }
	if ($method == "xml") {
		$resource = new SimpleXMLElement($data, LIBXML_NOCDATA);
	}
	else if ($method == "json") {
		$resource = json_decode($data, true);
        }
	return $resource;
}

?>
