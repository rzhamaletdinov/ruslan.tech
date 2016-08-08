<?php

require_once(__DIR__ . '/../models/Mailer.php');

class mode_email_form extends Controller
{

    const INPUT_NAME        = 'InputName';
    const INPUT_EMAIL       = 'InputEmail';
    const INPUT_MESSAGE     = 'InputMessage';

    function process()
    {
        $this->handleEmail();
        die('OK');
    }

    public function handleEmail()
    {
        if(!isset($_REQUEST[self::INPUT_NAME]) || !isset($_REQUEST[self::INPUT_EMAIL]) || !isset($_REQUEST[self::INPUT_MESSAGE]))
            return;

        $contact    = htmlspecialchars($_REQUEST[self::INPUT_EMAIL]);
        $name       = htmlspecialchars($_REQUEST[self::INPUT_NAME]);
        $message    = htmlspecialchars($_REQUEST[self::INPUT_MESSAGE]);
        Mailer::email($contact, $name, $message)->send();
    }
}