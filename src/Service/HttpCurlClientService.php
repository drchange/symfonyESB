<?php

namespace App\Service;

use Symfony\Component\HttpClient\CurlHttpClient;
use \Exception;


/* @class service curl http service */
class HttpCurlClientService
{

    public function push(string $url, $data, string $method = 'GET', $type = 'json') : string
    {
        return $this->{"send$method"}($url, $data, $type);
    }
    
    public function sendGET(string $url, $data) : string
    {
        $httpClient = new CurlHttpClient();
        $response = $httpClient->request('GET', $url, [
            'query' => $data
        ]);
        
        try{
            return $response->getContent();
        }catch(Exception $e){
            return $response;
        }
        
    }
    
    // type = "json/xml/raw data"
    public function sendPOST(string $url, $data, $type = 'json', $headers = null) : string
    {
        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($data)
        );
        $httpClient = new CurlHttpClient();
        $response = "";

        
        if ($type === 'json') {
            $response = $httpClient->request('POST', $url, [
                $type => $data,
                'headers' => $headers
            ]);
        } elseif (true) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
            curl_setopt($ch, CURLOPT_TIMEOUT, 150);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($ch);
        }

        return $response->getContent();
    }

    
    
}
