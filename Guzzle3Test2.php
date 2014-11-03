<?php
require 'vendor/autoload.php';

use Guzzle\Http\Client;

$settings = parse_ini_file('config/settings.ini');

$client = new Client($settings['base_url']);
$client->setDefaultOption('headers',
    array(
        'Content-Type' => 'application/json',
        'Authorization' => "Bearer ${settings['token']}",
    )
);

# get
$response = $client->get(
    $settings['api_path'],
    null # header だが、setDefaultOptionで既に設定している。
)->send()->json();

var_dump($response);

# 金額を+100円する
$response['product']['price'] += 100;

$response = $client->put(
    $settings['api_path'],
    null, # header だが、setDefaultOptionで既に設定している。
    json_encode($response)
)->send()->json();

var_dump($response);
