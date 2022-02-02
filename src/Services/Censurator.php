<?php

namespace App\Services;

class Censurator
{

    public function purify($string)
    {
        $insulte = array('connard', 'pd', 'salope', 'zemmour');
        $replace = array();
        foreach ($insulte as $key => $value) {
            $replace[$key] = str_repeat("*", strlen($value));;
        }
        
        return str_ireplace($insulte, $replace, $string);

    }
}