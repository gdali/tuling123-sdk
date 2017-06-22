<?php 
/*
 *    适用于tuling123 API V1.0和V2.0
 *
 *    version: 1.5
 *
 *    https://github.com/gdali/tuling123-sdk
 *
 *    update: 2017-06-22
 */

namespace Gdali\Tuling123SDK; 
 
class Tuling123
{
    
    private $apiKey;
    private $secret;
    private $text;
    private $userId = 1;
    private $selfInfo = '';
    
    public function  __construct($apiKey, $secret, $userId, $selfInfo){
        
        $this->apikey = $apiKey;
        $this->secret = $secret;
        $this->userId = md5($userId);
	    $this->selfInfo = $selfInfo; 	    
        $this->timestamp = time();		
        
    }
    
    public function tuling($text, $raw = false){
		
	    $this->text = $text;    
        $iv = '';
        $iv = str_repeat(chr(0),16);
		
        $aesKey = md5($this->secret.$this->timestamp.$this->apikey);
		
        $param = [
            'perception' => [
                'inputText' => [
                    'text' => $this->text,
                ],
                'selfInfo' => $this->selfInfo
            ],
            'userInfo' => [
                'apiKey' => $this->apikey,
                'userId' => $this->userId,
            ]
        ];

        $cipher = base64_encode(openssl_encrypt(json_encode($param), 'aes-128-cbc', hash('MD5', $aesKey, true), OPENSSL_RAW_DATA, $iv));
			
        $postData = [
            'key' => $this->apikey,
            'timestamp' => $this->timestamp,
            'data' => $cipher
        ];
		
        $result = json_decode('['.$this->post('http://openapi.tuling123.com/openapi/api/v2',json_encode($postData)).']',true);
        
        return $raw ? $result : $result[0]['results'][0]['values']['text'];
        
    }
    
    private function post($url,$data){
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = curl_exec($curl);
        curl_close($curl);
		
        return $result;  
        
    }
    
}
?>
