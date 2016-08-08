<?php

abstract class Controller
{
    private  $_title = 'MyFuckingTitle';
    private  $_content;
    private  $_tpl_path;

    abstract function process();

    function set_template($path)
    {
        $this->_tpl_path = $path;
    }

    function get_template()
    {
        return $this->_tpl_path;
    }

    function get_title()
    {
        return $this->_title;
    }

    function set_title($title)
    {
        $this->_title = $title;
    }

    function get_content()
    {
        return $this->_content;
    }

    function set_content($content)
    {
        $this->_content = $content;
    }

    function mode()
    {
        $args = explode(Config::MODE_PREFIX, get_called_class());
        return end($args);
    }

    public static function aggregate(array $data_args, Controller $controller)
    {
        foreach ($data_args as $arg)
            $result['args'][] = $arg;
        $result['config']['template_path']  = $controller->get_template();
        $result['config']['title']          = $controller->get_title();
        return $result;
    }
}