<?php
include "crawler_functions.php";


$url = 'https://ithelp.ithome.com.tw/2018ironman/signup/team/17';

$dom = new DOMDocument;
@$dom->loadHTML(crawlPage($url));
$dom->saveHTML($dom->documentElement);
// echo $result;

$classname = "contestants-list__title";

$elements = getElementsByClass($dom, $classname);

$web_urls = array();
$mobile_urls = array();

foreach($elements as $element){
    $participant_and_title = $element->attributes->getNamedItem('href')->nodeValue;

    // Web url
    array_push($web_urls, $participant_and_title);

    // Mobile url
    $parsed_url = explode('/', $participant_and_title);
    array_splice($parsed_url , 3, 0, 'm/api');
    $mobile_url = implode('/', $parsed_url);
    array_push($mobile_urls, $mobile_url);
}

print_r($web_urls);
print_r($mobile_urls);

