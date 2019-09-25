<?php

namespace App\Service;

use App\Manager\ParameterManager;
use Symfony\Component\HttpClient\CurlHttpClient;



/* @class service curl http service */
class HttpCurlClientService
{

    public function push(string $url, array $data, string $method = 'GET') : string
    {
        return $this->{"send$method"}($url, $data);
    }
    
    public function sendGET(string $url, array $data) : string
    {
        $httpClient = new CurlHttpClient();
        $response = $httpClient->request('GET', $url, [
            'query' => $data
        ]);

        return $response->getContent();
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
            ]);
        }
        return $response->getContent();
    }

    
    
}
