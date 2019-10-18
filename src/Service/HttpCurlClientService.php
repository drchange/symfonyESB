<?php

namespace App\Service;

use Symfony\Component\HttpClient\CurlHttpClient;



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
        $timeout = 500;

        $response = $httpClient->request('GET', $url, [
            'query' => $data,
            'timeout' => $timeout
        ]);
        return $response->getContent();
    }
    
    // type = "json/xml/raw data"
    public function sendPOST(string $url, $data, $type = 'json', $headers = null, $vHost= true, $vPeer = true) : string
    {
        $httpClient = new CurlHttpClient();
        $response = "";
        $timeout = 500;

        $chp = curl_init($url);
        curl_setopt($chp, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($chp, CURLOPT_POST, 1);
        curl_setopt($chp, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($chp, CURLOPT_URL, $url);
        curl_setopt($chp, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt($chp, CURLOPT_POSTFIELDS, $data);
        curl_setopt($chp, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($chp, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($chp);
        curl_error($chp);
        curl_close($chp);
        return $response;

        
    /*    if ($type === 'json') {
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
                'timeout' => $timeout,
                'verify_host' => $vHost, 
                'verify_peer' => $vPeer
            ]);
        }
        return $response->getContent(); */
    }

    
    
}
