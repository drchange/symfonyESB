<?php

namespace App\Service;

use Symfony\Component\HttpClient\CurlHttpClient;
use \Exception;


/* @class service curl http service */
class HttpCurlClientService
{

    public function push(string $url, $data, string $method = 'GET', $type = 'json', $headers = null) : string
    {
        return $this->{"send$method"}($url, $data, $type, $headers);
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
        $httpClient = new CurlHttpClient();
        $response = "";

        
        if ($type === 'json') {
            $response = $httpClient->request('POST', $url, [
                $type => $data,
                'headers' => $headers
            ]);
        } elseif (true) {
            $bodyparam = $dataparam = 'body';
            $response = $httpClient->request('POST', $url, [
                $bodyparam => $type,
                $dataparam => $data,
                'headers' => $headers,
                'verify' => false
            ]);
        }
        return $response->getContent();
    }

    
    
}
