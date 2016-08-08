<?php

require_once(__DIR__ . '/../models/Mailer.php');

class mode_callback_form extends Controller
{

    const INPUT_PHONE        = 'callbackPhone';

    function process()
    {
        $this->handleEmail();
        die('OK');
    }

    public function handleEmail()
    {
        if(!isset($_REQUEST[self::INPUT_PHONE]))
            return;

        $phone    = htmlspecialchars($_REQUEST[self::INPUT_PHONE]);
        Mailer::phone($phone)->send();
    }
}