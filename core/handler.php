<?php

class Handler
{
    static function get_handle()
    {
        if(Config::is_cli())
            return Config::MODE_PREFIX.Config::MODE_INDEX_PAGE;
        $mode = trim($_SERVER['REQUEST_URI'], "/");
        $mode = current(explode("?", $mode));
        if(!$mode)
            $mode = Config::MODE_INDEX_PAGE;
        if(!class_exists(Config::MODE_PREFIX . $mode))
            $mode = Config::MODE_404_PAGE;
        return Config::MODE_PREFIX . $mode;
    }
}