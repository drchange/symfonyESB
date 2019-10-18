<?php

namespace App\Service;

use Symfony\Component\HttpClient\CurlHttpClient;
use \Exception;

/* @class service curl http service */
class HttpCurlClientService
{
    public function push(string $url, $data, string $method = 'GET', $type = 'json', array $params=[], array $headers = null) : string
    {
        if (is_string ($data)) {
            $data = str_replace("\n", "", $data);
            $data = str_replace("\r", "", $data);
            $data = str_replace("\t", "", $data);
            $data = str_replace("Huawei123", "ff433006e6aa6d1409a923ccbbc67f3f", $data);
        }

        return $this->{"send$method"}($url, $data, $type, $params, $headers);
    }

    public function sendGET(string $url, $data, string $type = 'json', array $params=[], array $headers = null) : string
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
    public function sendPOST(string $url, $data, string $type = 'json', array $params=[], array $headers = null) : string
    {
        $httpClient = new CurlHttpClient();
<<<<<<< HEAD
        $response = "";
        $timeout = 1000;
=======
        $response = '';
>>>>>>> f1af95f16ba19d2f2e1e42baf7ff548370198495

        if ($type === 'json') {
            $response = $httpClient->request('POST', $url, [
                $type => $data,
                'headers' => $headers,
                'timeout' => $timeout
            ]);
        } elseif (true) {
            $headers = array(
                "Content-type: text/xml;charset=\"utf-8\"",
                "Accept: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                "Content-length: " . strlen($data)
            );
            $bodyparam = $dataparam = 'body';
            $paramsInput =  [
                $bodyparam => $type,
                $dataparam => $data,
                'headers' => $headers,
<<<<<<< HEAD
                'timeout' => $timeout
            ]);
=======
            ];
            $paramData = $paramsInput + $params;
            //dump($paramData, $data);die();
            $response = $httpClient->request('POST', $url, $paramData);
>>>>>>> f1af95f16ba19d2f2e1e42baf7ff548370198495
        }

        return $response->getContent();
    }
}
