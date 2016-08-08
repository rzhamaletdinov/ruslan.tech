<?php

class mode_404 extends Controller
{
    function process()
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: http://ruslan.tech");
        exit();
        $this->set_title('Страница не найдена');
    }
}