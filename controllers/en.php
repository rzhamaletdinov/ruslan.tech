<?php

require_once(__DIR__ . '/../models/Localization.php');

class mode_en extends Controller
{
    function process()
    {
        Localization::init('en');
        dump(Localization::forceLoad());
        exit;
        dump(123);
        exit;
        $path = 'index';
        $this->set_template($path);

        Localization::init('en');
        $args = ['locale' => Localization::forceLoad()];
        return $args;
    }
}