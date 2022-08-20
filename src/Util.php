<?php

namespace Chapa;

require_once __DIR__ . "/../vendor/autoload.php";

use Chapa\Exceptions\InvalidPostDataException;

class Util
{

    public static function validate($postData)
    {
        if(!preg_match("/^([0-9]{1,3},([0-9]{3},)*[0-9]{3}|[0-9]+)(.[0-9][0-9])?$/", $postData->getAMount())){
            throw new InvalidPostDataException('Invalid amount value. Amount must be in numerical format.');
        }

        if(!preg_match('/^([A-Z]{3})$/', $postData->getCurrency())){
            throw new InvalidPostDataException('Invalid currency value. Currency should match the following regex: ^([A-Z]{3})$');
        }

        $fullname = $postData->getFirstName() . ' ' . $postData->getLastName(); 
        if(!preg_match("/\b([A-ZÀ-ÿa-z][-,a-z. ']+[ ]*)/",  $fullname)){
            throw new InvalidPostDataException('Invalid name format. Name should match the following regex: ' . "\b([A-ZÀ-ÿa-z][-,a-z. ']+[ ]*)" );
        }
        
        if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $postData->getEmail())){
            throw new InvalidPostDataException("Invalid email address.");
        }

        $callBackUrl = $postData->getCallbackUrl();
        if(!is_null($callBackUrl) && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $callBackUrl)){
            throw new InvalidPostDataException("Invalid callback url.");
        }
    }

    public static function generateToken($prefix = 'cp')
    {
        return $prefix . '_' . bin2hex(random_bytes(5)) . '_' .  date('d-m-y_h-i-s');
    }
}
