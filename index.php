<?php
include('finished_day_crawler.php');

echo json_encode($status,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

