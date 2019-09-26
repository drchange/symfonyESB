<?php

namespace App\Service;

/* @class service request service */
class ResponseService
{
    public function normalize($response, string $format, string $tagxml = "")
    {
        switch ($format) {
            case 'json':
                return json_decode($response);
                break;

            case 'xml':
                $response = str_replace($tagxml,"", $response);
                $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
                $xml = simplexml_load_string($response);
                $json = json_encode($xml);
                return json_decode($json);
                break;
            
            default:
                # code...
                break;
        }
    }
}
