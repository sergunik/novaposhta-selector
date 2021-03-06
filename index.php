<?php
set_time_limit(0);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'conf.php';
require 'vendor/autoload.php';

define('API_URL', 'https://api.novaposhta.ua/v2.0/json/');
define('DIR_JSON', 'json-data');
define('FILE_CITY', 'city.json');
define('FILE_DEPARTMENT', 'department.json');

$aCity = [];
$aDepartment = [];

$start = microtime(true);

$client = new GuzzleHttp\Client();
$crawler = $client->request('POST', API_URL);
$response = $client->post(API_URL, [
    GuzzleHttp\RequestOptions::JSON => [
		'apiKey' => API_KEY,
		'modelName' => 'Address',
		'calledMethod' => 'getCities',
    ]
]);
if (200 == $response->getStatusCode()) {
	$jsonData = $response->getBody();
	$aData = json_decode($jsonData, 1);
	foreach ($aData['data'] as $v) {
		$aCity[ $v['Ref'] ] = $v['Description'];
	}

	if( file_exists( DIR_JSON.'/'.FILE_CITY ) ) {
		unlink(DIR_JSON.'/'.FILE_CITY);
	}
	file_put_contents(DIR_JSON.'/'.FILE_CITY, json_encode($aCity));
} else {
	die("Can't get list of cities from API");
}

foreach ($aCity as $cityRef => $cityName) {
	$crawler = $client->request('POST', API_URL);
	$response = $client->post(API_URL, [
	    GuzzleHttp\RequestOptions::JSON => [
			'apiKey' => API_KEY,
			'modelName' => 'Address',
			'calledMethod' => 'getWarehouses',
			'methodProperties' => [
				'CityRef' => $cityRef
			]
	    ]
	]);
	if (200 == $response->getStatusCode()) {
		$jsonData = $response->getBody();
		$aData = json_decode($jsonData, 1);
		foreach ($aData['data'] as $v) {
			$aDepartment[ $cityRef ][ $v['Ref'] ] = $v['Description'];
		}
	} else {
		die("Can't get list of departments from API");
	}
	
}
if( file_exists( DIR_JSON.'/'.FILE_DEPARTMENT ) ) {
	unlink(DIR_JSON.'/'.FILE_DEPARTMENT);
}
file_put_contents(DIR_JSON.'/'.FILE_DEPARTMENT, json_encode($aDepartment));

print( PHP_EOL . microtime(true) - $start . ' sec' . PHP_EOL);
