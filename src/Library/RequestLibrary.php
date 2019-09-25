<?php

namespace App\Library;

/* @class library request */
class RequestLibrary
{
    public function normalize($response, string $format){
        switch ($format) {
            case 'json':
                return json_decode($response);
                break;
            
            case 'xml':
                # code...
                break;

            case 'soap':
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }
}
