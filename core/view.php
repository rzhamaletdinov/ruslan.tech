<?php

/**
 * Class View
 * Two step templatizer
 *
 * logic_model->view_model
 */

class View
{
    private static $_path;
    private static $_layout;
    private static $_template;
    private static $_theme;
    private static $_loader;
    private static $_instance;
    public  static $vars;

    private function __construct($path = '')
    {
        self::$_path        = $path;
        self::$_loader      = new Twig_Loader_Filesystem(__DIR__.'/..'.$path);
        self::$_instance    = new Twig_Environment(self::$_loader);
        self::$vars         = new View_Variables();
    }

    public static function init($path)
    {
        if (null === self::$_instance)
            new self($path);
        return self::$_instance;
    }

    public static function get_loader()
    {
        if (null === self::$_instance)
            return;
        if (null === self::$_loader)
            return;
        return self::$_loader;
    }

    public static function set_loader($path = '')
    {
        if (null === self::$_instance)
            return;
        if (null === self::$_loader)
            return;
        self::$_path        = $path;
        self::$_loader      = new Twig_Loader_Filesystem(__DIR__.'/..'.$path);
        return self::$_loader;
    }
}

class View_Variables
{
    private static $_vars = null;

    function __construct()
    {
        if(null === self::$_vars)
            self::$_vars = [];
        return self::$_vars;
    }

    public static function set($key, $value)
    {
        self::$_vars[$key] = $value;
    }

    public function __get($key)
    {
        if (isset(self::$_vars[$key]))
            return self::$_vars[$key];
        return null;
    }

    public function all()
    {
        return self::$_vars;
    }
}

