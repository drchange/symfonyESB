<?php

namespace App\Service;

use Symfony\Component\HttpClient\CurlHttpClient;



/* @class service curl http service */
class HttpCurlClientService
{

    public function push(string $url, $data, string $method = 'GET', $type = 'json', $headers = null, $vHost= true, $vPeer = true, int $timeout = 300) : string
    {
        return $this->{"send$method"}($url, $data, $type, $headers, $vHost, $vPeer, $timeout);
    }
    
    public function sendGET(string $url, $data, $type, $headers, $vHost, $vPeer, $timeout) : string
    { 
        $httpClient = new CurlHttpClient();
        $timeout = 500;

        $response = $httpClient->request('GET', $url, [
            'query' => $data,
            'timeout' => $timeout,
            'headers' => $headers,
            'verify_host' => $vHost, 
            'verify_peer' => $vPeer
        ]);
        return $response->getContent();
    }
    
    // type = "json/xml/raw data"
    public function sendPOST(string $url, $data, $type = 'json', $headers = null, $vHost= true, $vPeer = true, $timeout) : string
    {
        $httpClient = new CurlHttpClient();
        $response = "";
        $timeout = 500;

        
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
                'verify_host' => $vHost, 
                'verify_peer' => $vPeer
            ]);
        }
        return $response->getContent(); 
    }

    
    
}
