<?php

namespace Find\Model;

abstract class Api{

	public function __construct(){
	}

	public function find($url){

		(function_exists('curl_init')) ? '' : die('cURL Must be installed for geturl function to work. Ask your host to enable it or uncomment extension=php_curl.dll in php.ini');

	    $cookie = tempnam ("/tmp", "CURLCOOKIE");
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; CrawlBot/1.0.0)');
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 5);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	    curl_setopt($ch, CURLOPT_MAXREDIRS, 15);         

		$html = curl_exec($ch);
		$status = curl_getinfo($ch);
		curl_close($ch);

		if($status['http_code']!=200){
		    if($status['http_code'] == 301 || $status['http_code'] == 302) {
		        list($header) = explode("\r\n\r\n", $html, 2);
		        $matches = array();
		        preg_match("/(Location:|URI:)[^(\n)]*/", $header, $matches);
		        $url = trim(str_replace($matches[1],"",$matches[0]));
		        $url_parsed = parse_url($url);
		        return (isset($url_parsed))? geturl($url):'';
		    }
		}
		return $html;
	}
}