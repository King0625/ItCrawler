<?php
include('finished_day_crawler.php');
include('config.php');

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

$results = array();

foreach($warning_members as $warning_member){
    if(in_array($warning_member, $web_camp)){
        $results['web_camp'][] = $warning_member;
    }elseif(in_array($warning_member, $android_camp)){
        $results['android_camp'][] = $warning_member;
    }elseif(in_array($warning_member, $backend_camp)){
        $results['backend_camp'][] = $warning_member;
    }elseif(in_array($warning_member, $ios_camp)){
        $results['ios_camp'][] = $warning_member;
    }
}

$web_string = " *web camp* : " . implode(', ', $results['web_camp']);
$ios_string = " *ios camp* : " . implode(', ', $results['ios_camp']);
$android_string = " *android camp* : " . implode(', ', $results['android_camp']);
$backend_string = " *backend camp* : " . implode(', ', $results['backend_camp']);


$webhook_url = WEB_HOOK_URL;
// POST 資料
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $webhook_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
curl_setopt($ch, CURLOPT_POST, true);


if(!$results == []){
    if(date("H:i") == date("H:i" , strtotime('21:30'))){
        $json_data = [
            "text" => " :face_with_symbols_on_mouth: *21:30 未發文的同學* : \n " . $web_string . " \n " . $ios_string . " \n " . $android_string . " \n " . $backend_string
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        curl_exec($ch);
    
    }elseif(date("H:i") == date("H:i" , strtotime('21:00'))){
        $json_data = [
            "text" => " :rage: *21:00 未發文的同學* : \n " . $web_string . " \n " . $ios_string . " \n " . $android_string . " \n " . $backend_string
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        curl_exec($ch);
        
    }elseif(date("H:i") == date("H:i" , strtotime('18:00'))){
        $json_data = [
            "text" => " :thinking_face: *18:00 未發文的同學* : \n " . $web_string . " \n " . $ios_string . " \n " . $android_string . " \n " . $backend_string
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        curl_exec($ch);
    }
}


curl_close($ch);

// echo json_encode($json_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);