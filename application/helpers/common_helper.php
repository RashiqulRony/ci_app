<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('pr'))
{
    function pr($var = '')
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
        exit();
        return $var;
    }
}

//Generate custom encode token for jwt
if (! function_exists('encode_token'))
{
    function encode_token($value){
        $key = sha1('EnCRypT10nK#Y!RiSRNnqwrytuioljahagsfdzvbnm/321457896');
        if (!$value) {
            return false;
        }
        $strLen = strlen($value);
        $keyLen = strlen($key);
        $j = 0;
        $crypttext = '';
        for ($i = 0; $i < $strLen; $i++) {
            $ordStr = ord(substr($value, $i, 1));
            if ($j == $keyLen) {
                $j = 0;
            }
            $ordKey = ord(substr($key, $j, 1));
            $j++;
            $crypttext .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
        }
        return $crypttext;
    }
}

//Generate custom encode token for jwt
if (! function_exists('decode_token')) {
    function decode_token($value)
    {
        if (!$value) {
            return false;
        }
        $key = sha1('EnCRypT10nK#Y!RiSRNnqwrytuioljahagsfdzvbnm/321457896');
        $strLen = strlen($value);
        $keyLen = strlen($key);
        $j = 0;
        $decrypttext = '';
        for ($i = 0; $i < $strLen; $i += 2) {
            $ordStr = hexdec(base_convert(strrev(substr($value, $i, 2)), 36, 16));
            if ($j == $keyLen) {
                $j = 0;
            }
            $ordKey = ord(substr($key, $j, 1));
            $j++;
            $decrypttext .= chr($ordStr - $ordKey);
        }

        return $decrypttext;
    }
}
