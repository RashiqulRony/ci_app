<?php
require APPPATH . '/libraries/JWT.php';


class ImplementJwt
{


    //////////The function generate token/////////////
    PRIVATE $key = "qwertyuiopasdfghjklzxcvbnm123456789";

    public function GenerateToken($data)
    {
        $encode_data = $this->encode($data);
        /*$decode_data = $this->decode("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.IiI.4Ip4jUmVbQXadzr47LRbMJrNiD6ZzmnoAexQ5OPKIJ4");
        print_r($decode_data);*/
        $jwt = JWT::encode($data, $this->key);
        return $jwt;
    }



    //////This function decode the token////////////////////
    public function DecodeToken($token)
    {
        $decoded = JWT::decode($token, $this->key, array('HS256'));
        $decodedData = (array) $decoded;
        return $decodedData;
    }


    public function encode($value)
    {
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

    public function decode($value){
        if(!$value){return false;}
        $key = sha1('EnCRypT10nK#Y!RiSRNnqwrytuioljahagsfdzvbnm/321457896');
        $strLen = strlen($value);
        $keyLen = strlen($key);
        $j=0;
        $decrypttext= '';
        for ($i = 0; $i < $strLen; $i+=2) {
            $ordStr = hexdec(base_convert(strrev(substr($value,$i,2)),36,16));
            if ($j == $keyLen) { $j = 0; }
            $ordKey = ord(substr($key,$j,1));
            $j++;
            $decrypttext .= chr($ordStr - $ordKey);
        }

        return $decrypttext;
    }
}
?>