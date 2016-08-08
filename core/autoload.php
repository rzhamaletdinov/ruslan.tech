<?php

class Load
{
    static function controller($class_name)
    {
        $args = explode(Config::MODE_PREFIX, $class_name);
        $mode = end($args);
        $url = __DIR__.'/../'.Config::MODE_DIR.'/'.$mode.'.php';
        if (is_readable($url))
            require_once($url);
    }

    static function composer()
    {
        require_once (__DIR__.'/../vendor/autoload.php');
    }

}
Load::composer();
spl_autoload_register('Load::controller');;