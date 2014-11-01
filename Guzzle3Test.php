<?php
require_once 'config/config.php';
require 'vendor/autoload.php';

use Guzzle\Http\Client;

$confing = CONFIG::$default;

# Resource Owner Password Credentials Grant
# http://oauthlib.readthedocs.org/en/latest/oauth2/grants/password.html#resource-owner-password-credentials-grant
$client = new Client($confing['base_url'] . '/oauth/token')
