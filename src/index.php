<?php
/**
 * Copyright (c) 2019. aimerforreimu
 * repo: https://github.com/aimerforreimu/auxpi
 */

use Aimer\Auxpi\Api;

include_once "../vendor/autoload.php";


$url = "https://test.demo-1s.com/api/";
$token = "cccebc1e2471aa075576bc729c4752498d5695f121d7c59105116c573bc713c7";
$api = new Api($url, $token);
$v2 = $api->uploadImageV2('123.png');
$v1 = $api->uploadImageV1('sougou', '123.png');

echo 'Version 2 Link:'. $v2['data']['url'] . "\r\n";
echo 'Version 1 Link:'.  $v1['data']['url']. "\r\n";