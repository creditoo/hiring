<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("allow_url_fopen", 1);

$url = "https://api.github.com/users/willangelico";

// function get_content_from_github($url) {
// 	$ch = curl_init();
// 	curl_setopt($ch,CURLOPT_URL,$url);
// 	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
// 	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,1);
// 	$content = curl_exec($ch);
// 	curl_close($ch);
// 	return $content;
// }


// var_dump(get_content_from_github("//localhost:8000/teste.json"));

// try {
// 	$curl = curl_init();

// 	if (FALSE === $curl)
// 	        throw new Exception('failed to initialize');

// 	curl_setopt_array($curl, array(
// 	  CURLOPT_URL => $url,
// 	  CURLOPT_RETURNTRANSFER => true
// 	  // CURLOPT_TIMEOUT => 30,
// 	  // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	  // CURLOPT_CUSTOMREQUEST => "GET",
// 	  // CURLOPT_HTTPHEADER => array(
// 	  //   "cache-control: no-cache"
// 	  // ),
// 	));
	
	
// 	$response = curl_exec($curl);
// 	if (FALSE === $response)
//         throw new Exception(curl_error($curl), curl_errno($curl));

//   print_r(curl_getinfo($curl));
// 	$err = curl_error($curl);

// 	curl_close($curl);
// 	  var_dump($response);

// } catch(Exception $e) {

//     trigger_error(sprintf(
//         'Curl failed with error #%d: %s',
//         $e->getCode(), $e->getMessage()),
//         E_USER_ERROR);

// }	




function geturl($url){

(function_exists('curl_init')) ? '' : die('cURL Must be installed for geturl function to work. Ask your host to enable it or uncomment extension=php_curl.dll in php.ini');

    $cookie = tempnam ("/tmp", "CURLCOOKIE");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; CrawlBot/1.0.0)');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    //curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    # required for https urls
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


$teste = json_decode(geturl($url));
var_dump($teste->company);

?>