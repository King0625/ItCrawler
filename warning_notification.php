<?php
include('finished_day_crawler.php');

$camps = $status[0];
$warning_members = array();
foreach($camps as $camp){
    foreach($camp as $camp_member){
        if($camp_member['posted_today'] == "No posts today!!!!!!!!!"){
            array_push($warning_members, $camp_member['account']);
        }
    }
}

$backend_camp = ['shivaxsin', 'charleen_xu', 'd44041122', 'kenchen0625', 'louis222220', 'SarahCheng'];
$android_camp = ['Kuroki', 'barnersh', 'larsnoya', 'zoeaeen13', 'jonec76'];
$ios_camp = ['ytyubox', 'gg831006', 'emmatw', 'yuyuma17', 'Jes', 'henryluuu', 'aa08666', 'ablacktaco'];
$web_camp = ['kirayang', 'askie', 'Penghua', 'xsw', 'letterliu', 'tsuifei', 'onlystp417', 'titangene', 'mangosu', 'yachen'];

$result = array();

foreach($warning_members as $warning_member){
    if(in_array($warning_member, $web_camp)){
        $result['web_camp'][] = $warning_member;
    }elseif(in_array($warning_member, $android_camp)){
        $result['android_camp'][] = $warning_member;
    }elseif(in_array($warning_member, $backend_camp)){
        $result['backend_camp'][] = $warning_member;
    }elseif(in_array($warning_member, $ios_camp)){
        $result['ios_camp'][] = $warning_member;
    }
}
// var_dump($warning_list);
echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
