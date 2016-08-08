<?php
/*namespace API\Custom\Telegram;

use API\Core\APIException;
use API\Core\Logger;
use API\Custom\twofactorauth\Method\Smsgate;
use API\Custom\twofactorauth\Method\Webfin;
use API\Models\User;*/

/**
 * Class Telegram
 * Позволяет отправлять сообщения от имени бота в телеграм
 * @package API\Custom\Telegram
 */
class Telegram
{
    protected static $_token = '261202812:AAGo3TZzm06WJDS6TaqYkHbxRoOGO6cO5EE';

    protected static function _curl($url, $method)
    {
        $domain = "https://api.telegram.org/bot" . static::$_token;

        $request = $domain . $url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data  = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * Послать текст
     * @param $chat_id
     * @param $text
     * @return bool
     */
    public static function send($chat_id, $text)
    {
        $url = '/sendMessage';
        $params = [
            'disable_web_page_preview'  => true,
            'chat_id'                   => $chat_id,
            'text'                      => $text,
        ];
        return static::_curl($url . '?' . http_build_query($params), 'GET');
    }

    public static function getUpdates()
    {
        $url = '/getUpdates';
        return static::_curl($url, 'GET');
    }
}