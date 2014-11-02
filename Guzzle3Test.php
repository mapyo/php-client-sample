<?php
require 'vendor/autoload.php';

use Guzzle\Http\Client;

$settings = parse_ini_file('config/settings.ini');

# Resource Owner Password Credentials Grant
$client = new Client($settings['base_url']);
$params = array(
    'grant_type'    => 'password',
    'username'      => $settings['username'],
    'password'      => $settings['password'],
    'scope'         => $settings['scope'], // Optional.
);

$data = $client->post('oauth/token', array(), $params)->send()->json();
var_dump($data['access_token']);
