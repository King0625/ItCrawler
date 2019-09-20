<?php
include('config.php');

$webhook_url = WEB_HOOK_URL;
// POST 資料
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $webhook_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
curl_setopt($ch, CURLOPT_POST, true);

$json_data = [
    "text" => '<!channel> *_貼心提醒_* : 週末不要忘記發文!! '
];

if(date("H:i") == date("H:i" , strtotime('10:30'))){
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    curl_exec($ch);
}

curl_close($ch);
