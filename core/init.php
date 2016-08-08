<?php

final class Application
{
    private static $_instance;

    const VAR_TITLE     = 'title';
    const VAR_CONTENT   = 'content';

    private function __construct()
    {
    }

    private function _init()
    {
        $class_name = Handler::get_handle();
        $controller = new $class_name();
        $data = $controller->process();
        self::_render($data, $controller);
    }

    private function __clone()
    {
    }

    public static function run()
    {
        if (null === self::$_instance)
        {
            self::$_instance = new self();
            self::$_instance->_init();
        }
        return self::$_instance;
    }

    private function _render(array $data_args, Controller $controller)
    {
        $view = View::init(Config::TEMPLATE_PATH);
        $data_view = Controller::aggregate($data_args, $controller);
        $template = $view->loadTemplate('page/' . $data_view['config']['template_path'] . '.twig');
        echo $template->render(['text' => 'Twig, Twig, Twig!', 'title' => $data_view['config']['title']]);
    }
}