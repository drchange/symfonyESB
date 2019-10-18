<?php

namespace App\Service;

use App\Entity\Api;
use App\Service\HttpCurlClientService;
use App\Service\ResponseService;



/* @class service send request service */
class SendRequestService
{

    /* @var HttpCurlClientService */
    private $http;

    /* @var ResponseService */
    private $responseService;

    public function __construct(HttpCurlClientService $http,
                                ResponseService $responseService)
    {
        $this->http = $http;
        $this->responseService = $responseService;
    }

    /* @function send request */
    public function run(Api $api, array $params, array $headers, array $soapheaders = [])
    {
        $techno = $api->getTechno()->getName();
        if($api->getMethod() == "GET")
        {
            $response = $this->http->push($api->getEndpoint(),$params, $api->getMethod() );
        }elseif(true){
            switch ($techno) {
                case 'REST':
                    switch ($api->getBodyFormat()) {
                        case 'json':
                            $response = $this->http->push($api->getEndpoint(),$params, $api->getMethod(), 'json', $headers);
                            break;
    
                        case 'xml':
                            $xml = null;
                            if($api->getSoapTemplate() != null){
                                $xml = trim($api->getSoapTemplate());
                                $parameters = $api->getParameters();
                                foreach ($params as $param) {
                                    ${$param->getOutName()} = $params[$param->getOutName()];
                                    $search = '$' . $param->getOutName();
                                    $replace =  ${$param->getOutName()};
                                    $xml = str_replace($search, $replace, $xml);
                                }
                            }
        
                            $response = $this->http->push($api->getEndpoint(), $xml, $api->getMethod(), 'xml', $headers);
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                    break;
    
                case 'SOAP':
                    if($api->getHaveWSDL()){
                        $wsdl= $api->getWsdl();
                        $service = $api->getSoapservice();
                        $client = new \SoapClient($wsdl, $soapheaders);
                        $response = $client->call($service, $params);
                    }elseif(true)
                    {
                        $xml = trim($api->getSoapTemplate());
                        $parameters = $api->getParameters();
                        foreach ($parameters as $param) {
                            ${$param->getOutName()} = $params[$param->getOutName()];
                            $search = '$' . $param->getOutName();
                            $replace =  ${$param->getOutName()};
                            $xml = str_replace($search, $replace, $xml);
                        }

                        $response = $this->http->sendPOST($api->getEndpoint(),$xml,'xml', $headers, false, false);
    
                    }
                    
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        
        $response = $this->responseService->normalize($response, $api->getBodyFormat(), $api->getXmltagversion());  
        
        return $response;
    }
    
}
