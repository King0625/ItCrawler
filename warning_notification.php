<?php
include('finished_day_crawler.php');

$camps = $status[0];
$warning_list = array();
// var_dump($camps);
foreach($camps as $camp){
    // echo $camp;
    foreach($camp as $camp_member){
        if($camp_member['posted_today'] == "No posts today!!!!!!!!!"){
            array_push($warning_list, $camp_member['account']);
        }
    }
}

var_dump($warning_list);
