<?php

require_once(__DIR__ . '/../models/Localization.php');

class mode_test extends Controller
{

    function process()
    {
        Localization::init('ru');
        dump(Localization::forceLoad());
        exit;
        dump(123);
        exit;
    }
}