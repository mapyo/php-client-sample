<?php
require 'vendor/autoload.php';

use Guzzle\Http\Client;
use CommerceGuys\Guzzle\Plugin\Oauth2\GrantType\PasswordCredentials;

$settings = parse_ini_file('config/settings.ini');

# Resource Owner Password Credentials Grant
$oauth2Client = new Client($settings['base_url'] . '/oauth/token');
$config = array(
    'username'      => $settings['username'],
    'password'      => $settings['password'],
    'client_id'     => $settings['client_id'],
    'client_secret' => $settings['client_secret'],
    // 'client_id'     => null, # null でもよい
    // 'client_secret' => null, # null でもよい
    'scope'         => $settings['scope'], // Optional.
);

$grantType = new PasswordCredentials($oauth2Client, $config);
$tokenData = $grantType->getTokenData();
var_dump($tokenData['access_token']);
