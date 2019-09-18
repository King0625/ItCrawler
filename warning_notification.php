<?php
include('finished_day_crawler.php');

$camps = $status[0];
$warning_list = array();
foreach($camps as $camp){
    foreach($camp as $camp_member){
        if($camp_member['posted_today'] == "No posts today!!!!!!!!!"){
            array_push($warning_list, $camp_member['account']);
        }
    }
}

// var_dump($warning_list);
echo json_encode($warning_list, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
