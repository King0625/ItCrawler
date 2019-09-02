<?php

include 'participant_title_crawler.php';

$result = array();

foreach($web_urls as $web_url){
    $dom = new DOMDocument;
    @$dom->loadHTML(crawlPage($web_url));
    $dom->saveHTML($dom->documentElement);

    $classname = "pagination";
    $elements = getElementsByClass($dom, $classname);

    // foreach ($spaners as $spaner) {
    $page = ($elements[0]->childNodes->count() / 2) - 2;
    // }
    // echo $page;

    $web_url = $web_url . '?page=' . $page;

    // echo $url;

    $dom = new DOMDocument;
    @$dom->loadHTML(crawlPage($web_url));
    $dom->saveHTML($dom->documentElement);

    $classname = 'profile-header__account';
    $account = getElementsByClass($dom, $classname)[0]->nodeValue; 

    $classname = "ir-qa-list__status";
    $elements = getElementsByClass($dom, $classname);

    $classname = "qa-list__info-time";
    $date = getElementsByClass($dom, $classname);
    $datetime = $date[count($date) - 1];
    $datetime = $datetime->attributes->getNamedItem('title')->nodeValue;
    // die(var_dump($datetime));

    $days = ($page - 1) * 10 + count($elements);

    echo "Datetime: " . date('Y-m-d H:i:s') . "\n";
    echo $account . ": " . $days . " days ; ";
    echo "Latest finished datetime" . ": " . $datetime . "\n";
    echo "Posted today: " . checkToday($datetime) . "\n";

    array_push($result, ['account' => $account , 'finished_days' => $days , 'latest finished date' => $datetime, 'Finished today' => checkToday($datetime)]);

}

// $result = array();

// foreach($mobile_urls as $mobile_url){

//     $json_page = json_decode(crawlPage($mobile_url), true);
//     // var_dump($json_page);
//     $account = $json_page['data']['user']['account'];
//     $pages = $json_page['paginator']['total_pages'];
//     // die(var_dump($pages));
//     $json_page = json_decode(crawlPage($mobile_url . "?page=" . $pages), true);

//     $days = $json_page['data']['ironman']['topic_count'];
//     $articles_count = count($json_page['data']['articles']);

//     $created_at = $json_page['data']['articles'][$articles_count - 1]['created_at'];
//     $timestamps = preg_replace( '/[^0-9]/', '', $created_at);
//     $datetime = date("Y-m-d H:i:s", $timestamps / 1000);

    
//     echo date('Y-m-d H:i:s') . "\n";

//     // var_dump($created_at);
//     echo $account . ": " . $days . " days ; ";
//     echo "Latest finished date: " . $datetime . "\n";
//     echo "Posted today: " . checkToday($datetime) . "\n";

//     array_push($result, ['account' => $account , 'finished_days' => $days , 'latest finished date' => $datetime, 'Finished today' => checkToday($datetime)]);

// }

// print_r($result);
// echo json_encode($result);
   
  
    