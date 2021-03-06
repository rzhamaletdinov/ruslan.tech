<?php

require_once(__DIR__ . '/../models/Localization.php');

class mode_test extends Controller
{

    function process()
    {
        $path = 'index';
        $this->set_template($path);

        $args = [
            'title' => 'MyIndexTitle',
            'text'  => 'text text text'
        ];

        Localization::init('en');
        $args = ['locale' => Localization::getVars()];
        return $args;
    }
}