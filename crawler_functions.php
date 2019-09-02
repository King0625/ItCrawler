<?php

function crawlPage($url){
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

function getElementsByClass($dom, $classname){
    $finder = new DomXPath($dom);
    $elements = $finder->query("//*[@class='$classname']");
    return $elements;
}

function checkToday($datetime){
    if(date('Y-m-d') != date('Y-m-d', strtotime($datetime))){
        return "No posts today";
    }
    return "Finished";
}