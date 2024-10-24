<?php

ini_set("soap.wsdl_cache_enabled", "0");
ini_set("soap.wsdl_cache", "0");
ini_set("error_reporting", -1);
ini_set("display_errors", 'On');

$store_url = 'http://127.0.0.1/';
$wsdl_url = $store_url . 'api/v2_soap/?wsdl';
$api_user = 'magenteiro';
$api_key = 'porcaria123';

echo "<p>WSDL url:" . $wsdl_url . "</p>";
$timer_start = microtime(true);

$proxy = new SoapClient($wsdl_url, ['soap_version' => SOAP_1_1]);

$sessionId = $proxy->login(['username'=>$api_user, 'apiKey'=>$api_key]);
var_dump($sessionId);

echo sprintf("<p>Session ID: %s</p>", $sessionId->result);
echo sprintf("<p>Time %s\n</p>", microtime(true) - $timer_start);