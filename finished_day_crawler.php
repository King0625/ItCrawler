<?php

include 'participant_title_crawler.php';

header("Content-type:application/json");
/** Sync crawler */
// Web


// $result = array();

// foreach($web_urls as $web_url){
//     $ch = curl_init($web_url);
//     $dom = new DOMDocument;
//     @$dom->loadHTML(crawlOnePage($ch));
//     $dom->saveHTML($dom->documentElement);

//     $classname = "pagination";
//     $elements = getElementsByClass($dom, $classname);

//     // foreach ($spaners as $spaner) {
//     $page = ($elements[0]->childNodes->count() / 2) - 2;
//     // }
//     // echo $page;

//     $web_url = $web_url . '?page=' . $page;

//     // echo $url;
//     $ch = curl_init($web_url);
//     $dom = new DOMDocument;
//     @$dom->loadHTML(crawlOnePage($ch));
//     $dom->saveHTML($dom->documentElement);

//     $classname = 'profile-header__account';
//     $account = getElementsByClass($dom, $classname)[0]->nodeValue; 

//     $classname = "ir-qa-list__status";
//     $elements = getElementsByClass($dom, $classname);

//     $classname = "qa-list__info-time";
//     $date = getElementsByClass($dom, $classname);
//     $datetime = $date[count($date) - 1];
//     $datetime = $datetime->attributes->getNamedItem('title')->nodeValue;
//     // die(var_dump($datetime));

//     $days = ($page - 1) * 10 + count($elements);

//     echo "Datetime: " . date('Y-m-d H:i:s') . "\n";
//     echo $account . ": " . $days . " days ; ";
//     echo "Latest finished datetime" . ": " . $datetime . "\n";
//     echo "Posted today: " . checkToday($datetime) . "\n";

//     array_push($result, ['account' => $account , 'finished_days' => $days , 'latest finished date' => $datetime, 'Finished today' => checkToday($datetime)]);

// }

// $result = array();



// Mobile

// foreach($mobile_urls as $mobile_url){
//     $ch = curl_init($mobile_url);
//     $json_page = json_decode(crawlOnePage($ch), true);
//     // var_dump($json_page);
//     $account = $json_page['data']['user']['account'];
//     $pages = $json_page['paginator']['total_pages'];
//     // die(var_dump($pages));
//     $ch = curl_init($mobile_url . "?page=" . $pages);
//     $json_page = json_decode(crawlOnePage($ch), true);

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


// $dom = new DOMDocument;
// @$dom->loadHTML(crawlPage($web_url));
// $dom->saveHTML($dom->documentElement);



/** Async crawler */
// Web

// $handle_first = multi_crawler_init($web_urls);

// foreach($handle_first as $i => $ch) {
//     $content = curl_multi_getcontent($ch);
//     $dom = new DOMDocument;
//     @$dom->loadHTML($content);
//     $dom->saveHTML($dom->documentElement);

//     $classname = "pagination";
//     $elements = getElementsByClass($dom, $classname);

//     $pages = ($elements[0]->childNodes->count() / 2) - 2;

//     $web_urls[$i] = $web_urls[$i] . "?page=" . $pages;
// }

// $handle_last_page = multi_crawler_init($web_urls);

// $data = array();

// foreach($handle_last_page as $i => $ch){
//     $content = curl_multi_getcontent($ch);
//     $dom = new DOMDocument;
//     @$dom->loadHTML($content);
//     $dom->saveHTML($dom->documentElement);

//     $classname = 'profile-header__account';
//     $account = getElementsByClass($dom, $classname)[0]->nodeValue; 

//     $classname = "ir-qa-list__status";
//     $elements = getElementsByClass($dom, $classname);

//     $classname = "qa-list__title qa-list__title--ironman";
//     $title = getElementsByClass($dom, $classname)[0]->nodeValue;
    
//     $classname = "qa-list__info-time";
//     $date = getElementsByClass($dom, $classname);
//     $datetime = $date[count($date) - 1];
//     $datetime = $datetime->attributes->getNamedItem('title')->nodeValue;

//     $url_parts = parse_url($web_urls[$i]);
//     parse_str($url_parts['query'], $query);
//     $page = $query['page'];
//     $days = ($page - 1) * 10 + count($elements);

//     $data[$i]['account'] = (curl_errno($ch) == 0) ? $account : false;
//     $data[$i]['topic'] = (curl_errno($ch) == 0) ? $title : false;
//     $data[$i]['topic_count'] = (curl_errno($ch) == 0) ? $days : false;
//     $data[$i]['latest_finish_date'] = (curl_errno($ch) == 0) ? $datetime : false;
//     $data[$i]['posted_today'] = (curl_errno($ch) == 0) ? checkToday($datetime) : false;

// }

// // print_r($data);
// echo json_encode($data);



// Mobile

$handle_first = multi_crawler_init($mobile_urls);
// multi_crawler_init($mobile_urls);
// var_dump($handle_first);
// die();
foreach($handle_first as $i => $ch) {
    $content  = curl_multi_getcontent($ch);
    // $json_page  = curl_multi_getcontent($ch);
    $json_page = json_decode($content, true);
    
    $pages = (curl_errno($ch) == 0) ? $json_page['paginator']['total_pages'] : false;
    $mobile_urls[$i] = $mobile_urls[$i] . "?page=" . $pages;
}

$handle_last_page = multi_crawler_init($mobile_urls);

$data = array();

foreach($handle_last_page as $i => $ch) {
    $content  = curl_multi_getcontent($ch);
    
    $json_page = json_decode($content, true);
    
    $data[$i]['link'] = (curl_errno($ch) == 0) ? $web_urls[$i] : false;
    $data[$i]['account'] = (curl_errno($ch) == 0) ? $json_page['data']['user']['account'] : false;
    $data[$i]['nickname'] = (curl_errno($ch) == 0) ? $json_page['data']['user']['nickname'] : false;
    $data[$i]['avatar'] = (curl_errno($ch) == 0) ? $json_page['data']['user']['avatar'] : false;
    $data[$i]['subject'] = (curl_errno($ch) == 0) ? $json_page['data']['ironman']['subject'] : false;
    $data[$i]['topic_count'] = (curl_errno($ch) == 0) ? $json_page['data']['ironman']['topic_count'] : false;

    $articles_count = count($json_page['data']['articles']);
    $created_at = $json_page['data']['articles'][$articles_count - 1]['created_at'];
    $timestamps = preg_replace( '/[^0-9]/', '', $created_at);
    $datetime = date("Y-m-d H:i:s", $timestamps / 1000);
    $data[$i]['latest_finish_date'] = (curl_errno($ch) == 0) ? $datetime : false;
    $data[$i]['posted_today'] = (curl_errno($ch) == 0) ? checkToday($datetime) : false;

}

echo json_encode($data);
// print_r($data);
   
  
    