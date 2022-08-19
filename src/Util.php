<?php

namespace Chapa;

class Util{

    public static function validate(){

    }

    public static function generateToken($prefix = 'cp'){
       return $prefix . '_' . bin2hex(random_bytes(5)) . '_' .  date('d-m-y_h-i-s');
    }
}


