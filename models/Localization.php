<?php

class Localization
{
    const DEFAULT_LANG          = 'ru'; //unused p.s. maybe unused =)
    static $LANG_AVAILABLE      = ['ru', 'en'];

    private static $_storage    = NULL;
    private static $_curr_lang  = NULL;

    public static function get($var_name)
    {
        if(!isset(self::$_storage[$var_name]))
            return;
        return self::$_storage[$var_name];
    }

    public static function setLang($lang)
    {
        //TODO::if lang availibale
        setcookie(md5('Lang'), base64_encode($lang), time()+(60*60*24*30*12), '/');
        self::$_curr_lang = $lang;
    }

    public static function init($lang = false)
    {
        if(!$lang)
            $lang = self::getCurrentLang();
        $data = [];
        $url = __DIR__ . "/../translations/" . $lang . ".csv";
        if(!file_exists($url))
            die("Translation file error");$handle = fopen($url, "r");
        while($line = fgets($handle)){
            $data[] = str_getcsv($line, ',');
        }
        fclose($handle);
        foreach ($data as $item)
            self::$_storage[$item[0]] = $item[1];
        unset(self::$_storage["KEY"]);
        unset(self::$_storage["BLOCK"]);
    }

    public static function getVars()
    {
        return self::$_storage;
    }

    public static function forceLoad()
    {
        self::init(self::getDefaultLang());
        self::init();
        $locale = [];
        foreach (self::$_storage as $key => $value)
            $locale[$key] = $value;
        return $locale;
//        ci()->smrt->append("locale", $locale, true);
    }

    public static function getAvailableLang()
    {
        return self::$LANG_AVAILABLE;
    }

    public static function getDefaultLang()
    {
//        return Settings::get('locale.default');
        return 'ru';
    }

    public static function getCurrentLang()
    {
        if(self::$_curr_lang)
            return self::$_curr_lang;
        if(isset($_COOKIE[md5('Lang')]))
            return base64_decode($_COOKIE[md5('Lang')]);
        if(self::getFromBrowser())
            return self::getFromBrowser();
        return self::DEFAULT_LANG;
    }

    public static function routeProcess(&$route)
    {
        $path = $_SERVER['REQUEST_URI'];
        $chunk_path = explode('/', $path);
        if(in_array($chunk_path[1], self::$LANG_AVAILABLE))
            $lang = $chunk_path[1];
        else
        {
            $lang = self::getCurrentLang();
            $chunk_path[0] = $lang;
            $link = implode('/', $chunk_path);
            header('Location: /' . $link);
            exit();
        }
        $new_route = [];
        foreach($route as $key => $value)
            $new_route[$lang. '/' .$key] = $value;
        $new_route[$lang] = 'indexpage';
        $route = $new_route;
        self::setLang($lang);
    }

    public static function getFromBrowser()
    {
        $brows_langs = array(
            'ru'=>array('ru','be','uk','ky','ab','mo','et','lv'),
        );


        if (($list = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']))) {
            if (preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', $list, $list)) {
                $language = array_combine($list[1], $list[2]);
                foreach ($language as $n => $v)
                    $language[$n] = $v ? $v : 1;
                arsort($language, SORT_NUMERIC);
            }
        } else return false;

        foreach ($brows_langs as $lang => $alias) {
            if (is_array($alias)) {
                foreach ($alias as $alias_lang) {
                    $languages[strtolower($alias_lang)] = strtolower($lang);
                }
            }else $languages[strtolower($alias)]=strtolower($lang);
        }

        foreach ($language as $l => $v) {
            $s = strtok($l, '-'); // убираем то что идет после тире в языках вида "en-us, ru-ru"
            if (isset($languages[$s]))
                return $languages[$s];
        }
        return false;
    }
}