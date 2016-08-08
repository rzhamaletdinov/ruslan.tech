<?php

require_once("Telegram.php");

class Mailer
{
    const EMAIL_TO  = 'info@ruslan.tech';
    const SUBJECT   = 'From site ruslan.tech';

    protected $_subject;
    protected $_message;
    protected $_headers;


    protected function __construct()
    {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $this->_headers = $headers;
    }

    public function send()
    {
        Telegram::send(154647586, $this->_message);
        mail(self::EMAIL_TO, $this->_subject, $this->_message, $this->_headers);
    }

    static public function phone($phone)
    {
        $mailer = new self();
        $mailer->_subject = self::SUBJECT . ". Запрос обратного звонка";

        $message = '
        <html>
            <head>
              <title>' . self::EMAIL_TO . '. Запрос обратного звонка</title>
            </head>
            <body>
                <p>' . self::EMAIL_TO . '. Запрос обратного звонка</p>
                <p><b>' . $phone . '</b></p>
            </body>
        </html>
        ';
        $mailer->_message = $message;

        return $mailer;
    }

    static public function email($contact, $name, $message)
    {
        $mailer = new self();
        $mailer->_subject = self::SUBJECT . ". Запрос через email";

        $message = '
        <html>
            <head>
              <title>' . self::EMAIL_TO . '. Запрос через email</title>
            </head>
            <body>
                <p>' . self::EMAIL_TO . '. Запрос через email</p>
                <p>От абонента:</p>
                <p><b>' . $name . '</b></p>
                <p>Текст сообщения: </p>
                <p><b>' . $message . '</b></p>
                <p>Обратный контакт: </p>
                <p><b>' . $contact . '</b></p>
            </body>
        </html>
        ';
        $mailer->_message = $message;

        return $mailer;
    }
}