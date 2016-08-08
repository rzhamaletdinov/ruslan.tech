<?php

class mode_index extends Controller
{
    function process()
    {
        $this->set_title('Главная');
        $this->set_content('Текст на главной');
        $path = 'index';
        $this->set_template($path);

        $args = [
            'title' => 'MyIndexTitle',
            'text'  => 'text text text'
        ];

        return $args;
    }
}