<?php
namespace GuzzleActiveSample;

class Settings
{
    public static function __callStatic($name, $arguments)
    {
        $settings = parse_ini_file( __DIR__ . '/../../config/settings.ini');
        return $settings[$name];
    }
}
