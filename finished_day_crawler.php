<?php

include 'participant_title_crawler.php';


// foreach($web_urls as $web_url){
//     $dom = new DOMDocument;
//     @$dom->loadHTML(crawlPage($web_url));
//     $dom->saveHTML($dom->documentElement);

//     $classname = "pagination";
//     $elements = getElementsByClass($dom, $classname);

//     // foreach ($spaners as $spaner) {
//     $page = ($elements[0]->childNodes->count() / 2) - 2;
//     // }
//     // echo $page;

//     $web_url = $web_url . '?page=' . $page;

//     // echo $url;

//     $dom = new DOMDocument;
//     @$dom->loadHTML(crawlPage($web_url));
//     $dom->saveHTML($dom->documentElement);

//     $classname = 'profile-header__account';
//     $account = getElementsByClass($dom, $classname)[0]->nodeValue; 

//     $classname = "ir-qa-list__status";
//     $elements = getElementsByClass($dom, $classname);

//     $days = ($page - 1) * 10 + count($elements);
    
//     echo $account . ": " . $days . "\n";
// }


foreach($mobile_urls as $mobile_url){
    $json_page = json_decode(crawlPage($mobile_url), true);
    // var_dump($json_page);
    $account = $json_page['data']['user']['account'];
    $days = $json_page['data']['ironman']['topic_count'];
    echo $account . ": " . $days . "\n";
}
   
  
    