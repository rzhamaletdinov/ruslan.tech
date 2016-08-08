<?php

function dump($arg)
{
    echo '<pre>';
    var_dump($arg);
    echo '</pre>';
}

class helpers
{
    static function validate($data)
    {
        if(is_array($data))
        {
            foreach($data as $key => $value)
            {
                $value = trim($value);
                $value = stripslashes($value);
                $value = strip_tags($value);
                $value = htmlspecialchars($value);
                $format_data[$key] = $value;
            }
            return $format_data;
        }
        else
        {
            $value = trim($data);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
            return $value;
        }
    }
}