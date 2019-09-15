<?php
date_default_timezone_set('Asia/Taipei');

function crawlOnePage($ch){
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);

    return $result;
}

function multi_crawler_init($urls){
    $mh = curl_multi_init();
    $handle = array();
    $i = 0;
    $running = 0;
    curl_multi_setopt($mh, CURLMOPT_MAX_PIPELINE_LENGTH, 20);
    foreach($urls as $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return don't print
        curl_multi_add_handle($mh, $ch);
        
        $handle[$i++] = $ch;
    }
    
    do {
        curl_multi_exec($mh, $running);
        curl_multi_select($mh);
    } while ($running > 0);

    // curl_multi_exec($mh, $running);
    // do{
    //     if (curl_multi_select($mh, 99) === -1)
    //     {
    //         usleep(1);
    //         continue;
    //     }
    //     curl_multi_exec($mh, $running);
    // } while ($running);
    

    foreach($handle as $i => $c){
        curl_multi_remove_handle($mh, $c);
    }
    curl_multi_close($mh);
    
    return $handle;
}

function getElementsByClass($dom, $classname){
    $finder = new DomXPath($dom);
    $elements = $finder->query("//*[@class='$classname']");
    return $elements;
}

function checkToday($datetime){
    if(date('Y-m-d') != date('Y-m-d', strtotime($datetime))){
        return "No posts today!!!!!!!!!";
    }
    return "Finished~";
}
