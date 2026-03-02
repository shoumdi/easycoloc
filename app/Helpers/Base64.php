<?php

namespace App\Helpers;

class Base64
{
    static function encode(array $payload)
    {
        $base64 = base64_encode(json_encode($payload));
        return rtrim(strtr($base64, '+/', '-_'), '=');
    }
    static function decode(string $token){
        $base64 = strtr($token,'_-','/+');
        while(strlen($base64)%4) $base64 .= '=';
        return base64_decode($base64);
    }
}
