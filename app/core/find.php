<?php


$url = "https://api.github.com/users/".$_POST['user_account'];

function geturl($url){

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


$user = json_decode(geturl($url));
?>
    <div id="account" class="row">
        <div class="account-info col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="account-img">
                <img src="<?=$user->avatar_url;?>" alt="<?=$user->name;?>" class="img-responsive img-circle" />
            </div>                          
        </div>
        <div class="account-bio col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <h3 class='account-name'>
                <a href="<?=$user->html_url;?>" target="_blank">
                    <?=$user->name;?>
                </a>
            </h3>
            <div class="account-location">
                <?=$user->location;?>
            </div>
            <div class="account-follows">
                <div class="account-followers">
                    <strong>Followers</strong>
                    <span><?=$user->followers;?></span>
                </div>
                <div class="account-following">
                    <strong>Following</strong>
                    <span><?=$user->following;?></span>
                </div>
            </div>
            <div class="account-publics">
                <div class="account-public-repos">
                    <strong>Repositories</strong>
                    <span><?=$user->public_repos;?></span>
                </div>
                <div class="account-public-gists">
                    <strong>Gists</strong>
                    <span><?=$user->public_gists;?></span>
                </div>
            </div>
            <div class="account-company">
                <strong>Company: </strong>
                <span><?=$user->company;?></span>
            </div>
            <div class="account-company">
                <strong>Site: </strong>
                <a href="<?=$user->blog;?>" target="_blank"><?=$user->blog;?></a>
            </div>
            <div class="account-bio">
                <p>"<?=$user->bio;?>"</p>
            </div>
        </div>
    </div>
