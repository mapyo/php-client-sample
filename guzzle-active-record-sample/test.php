<?php
$loader = require '../vendor/autoload.php';
$loader->add('Mapyo\\', __DIR__);

var_dump(Mapyo\Settings::base_url());

