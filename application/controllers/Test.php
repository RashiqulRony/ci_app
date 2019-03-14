<?php
require APPPATH . '/libraries/ImplementJwt.php';

class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->objOfJwt = new ImplementJwt();
        header('Content-Type: application/json');

    }

    /////////// Generating Token and put user data into  token ///////////

    public function LoginToken()
    {

        $tokenData['id'] = '1';
        $tokenData['name'] = 'alomgir';
        $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
        $tokenPass = password_hash("rasmuslerdorf", PASSWORD_DEFAULT);

        $encData = md5('kdsfjkskdfsdfkjsdf');

        $password = 'abcdefg';
        $salt = 'anythingyouwant_';
        $pw_hash = md5($salt.$password);

        $data = password_hash("rasmuslerdorf", PASSWORD_DEFAULT);

        //echo password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options);

        $jwtToken = $this->objOfJwt->GenerateToken($tokenData);

        $jwtTokenTest = static::encode_token($jwtToken);

        echo json_encode(array('Token'=> $jwtToken));


    }

    public static function decode_jwt(){

        $jwtTokendecodeData = static::decode_token("n5v4u4p2e4x3k4o5j3n5f3u4y3u205a4o3a3e3o594r484f4m3e4j3j3p3q4q424o3i4m3d424c4y4u4y504n4e333i3p5o494u483t4t4y365q2k4g3a4v5g495w3u4p474w3a4g434m5q4p4m3m425w594046565a4r4b3t484m4s4u2r4b4s4v4m335c4s4k383x4r4x4d3f3a4m3d3n3u2h336q403q3g3r5p5d4u324n4i495k3y2d4i516i4z4k3p4t3o4u5k3d3p424a5y346g3c4s2f3q4t414q355k5d3q3w294l4x4x3z4765436");
        echo $jwtTokendecodeData;
        return $jwtTokendecodeData;

    }


    public static function encode_token($value) {
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


    public static function decode_token($value){
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


    //////// get data from token ////////////

    public function GetTokenData()
    {
        $received_Token = $this->input->request_headers('Authorization');
        try
        {
            $jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
            echo json_encode($jwtData);
        }
        catch (Exception $e)
        {
            http_response_code('401');
            echo json_encode(array( "status" => false, "message" => 'Token incorrect'));
            exit;
        }
    }

    function strong_hash($input, $salt = null, $algo = 'sha512', $rounds = 20000) {
        if($salt === null) {
            $salt = crypto_random_bytes(16);
        } else {
            $salt = pack('H*', substr($salt, 0, 32));
        }

        $hash = hash($algo, $salt . $input);

        for($i = 0; $i < $rounds; $i++) {
            // $input is appended to $hash in order to create
            // infinite input.
            $hash = hash($algo, $hash . $input);
        }

        // Return salt and hash. To verify, simply
        // passed stored hash as second parameter.
        return bin2hex($salt) . $hash;
    }

    public function crypto_random_bytes($count) {
        static $randomState = null;

        $bytes = '';

        if(function_exists('openssl_random_pseudo_bytes') &&
            (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN')) { // OpenSSL slow on Win
            $bytes = openssl_random_pseudo_bytes($count);
        }

        if($bytes === '' && is_readable('/dev/urandom') &&
            ($hRand = @fopen('/dev/urandom', 'rb')) !== FALSE) {
            $bytes = fread($hRand, $count);
            fclose($hRand);
        }

        if(strlen($bytes) < $count) {
            $bytes = '';

            if($randomState === null) {
                $randomState = microtime();
                if(function_exists('getmypid')) {
                    $randomState .= getmypid();
                }
            }

            for($i = 0; $i < $count; $i += 16) {
                $randomState = md5(microtime() . $randomState);

                if (PHP_VERSION >= '5') {
                    $bytes .= md5($randomState, true);
                } else {
                    $bytes .= pack('H*', md5($randomState));
                }
            }

            $bytes = substr($bytes, 0, $count);
        }

        return $bytes;
    }


    function old_tiger($data = "", $width=192, $rounds = 3) {
        return substr(
            implode(
                array_map(
                    function ($h) {
                        return str_pad(bin2hex(strrev($h)), 16, "0");
                    },
                    str_split(hash("tiger192,$rounds", $data, true), 8)
                )
            ),
            0, 48-(192-$width)/4
        );
    }

    public function constants(){
       /* // Our password.. the kind of thing and idiot would have on his luggage:
        $password_plaintext = "12345";

        // Hash it up, fuzzball!
        $password_hash = password_hash( $password_plaintext, PASSWORD_DEFAULT);

        // What do we get?

        $records = array(
            array(
                'id' => 2135,
                'first_name' => 'John',
                'last_name' => 'Doe',
            ),
            array(
                'id' => 3245,
                'first_name' => 'Sally',
                'last_name' => 'Smith',
            ),
            array(
                'id' => 5342,
                'first_name' => 'Jane',
                'last_name' => 'Jones',
            ),
            array(
                'id' => 5623,
                'first_name' => 'Peter',
                'last_name' => 'Doe',
            )
        );

        $records2 =
            array(
                'id' => 2135,
                'first_name' => 'John',
                'last_name' => 'Doe',
            );
            array(
                'id' => 3245,
                'first_name' => 'Sally',
                'last_name' => 'Smith',
            );
            array(
                'id' => 5342,
                'first_name' => 'Jane',
                'last_name' => 'Jones',
            );
            array(
                'id' => 5623,
                'first_name' => 'Peter',
                'last_name' => 'Doe',
            );


        $checkarray = $this->array_column($records,'last_name');

        $shirts_on_sale = array('small', 'large');
        echo form_dropdown('shirts', $checkarray, 'large');

       // $first_names = array_column($records, 'first_name','id');

        $stack = array("orange", "banana");
        array_push($records,$records2);

       // $name = array_key_exists($records,5623);
        print_r($password_hash);

        echo "<br>";
        $hash = '$2y$10$rcz6SkTcGWlH8hFftfce2.grI90LJbEIRpBlI8fyvRL4YvdETc9iW';

        if (password_verify('12345', $hash)) {
            echo 'Password is valid!';
        } else {
            echo 'Invalid password.';
        }*/



    }


    function array_column($array, $columnKey, $indexKey = null)
    {
        $result = array();
        foreach ($array as $subArray) {
            if (is_null($indexKey) && array_key_exists($columnKey, $subArray)) {
                $result[] = is_object($subArray)?$subArray->$columnKey: $subArray[$columnKey];
            } elseif (array_key_exists($indexKey, $subArray)) {
                if (is_null($columnKey)) {
                    $index = is_object($subArray)?$subArray->$indexKey: $subArray[$indexKey];
                    $result[$index] = $subArray;
                } elseif (array_key_exists($columnKey, $subArray)) {
                    $index = is_object($subArray)?$subArray->$indexKey: $subArray[$indexKey];
                    $result[$index] = is_object($subArray)?$subArray->$columnKey: $subArray[$columnKey];
                }
            }
        }
        return $result;
    }

}

