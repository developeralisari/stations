<?php

function myurl($add)
{
    $url = url()->full() . "/" . $add;
    if(env('APP_ENV') != "local"){
        if(strpos($url, 'https') == null)
        {
            $url = str_replace("http","https",$url);
        }
    }
    
    return $url;
}