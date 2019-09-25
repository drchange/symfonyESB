<?php

namespace App\Service;

use App\Entity\Api;
use App\Service\HttpCurlClientService;
use App\Model\ResponseRequest;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Library\RequestLibrary;


/* @class service send request service */
class SendRequestService
{

    /* @var HttpCurlClientService */
    private $http;

    /* @var RequestLibrary */
    private $libRequest;

    public function __construct(HttpCurlClientService $http,
                                RequestLibrary $libRequest)
    {
        $this->http = $http;
        $this->libRequest = $libRequest;
    }

    /* @function send request */
    public function run(Api $api, array $params)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $techno = $api->getTechno()->getName();
        switch ($techno) {
            case 'REST':
                switch ($api->getBodyFormat()) {
                    case 'json':
                        $response = $this->http->push($api->getEndpoint(),$params, $api->getMethod());
                        break;

                    case 'xml':
                        //$response = $this->http->push($api->getEndpoint(),$params, $api->getMethod());
                        break;
                    
                    default:
                        # code...
                        break;
                }
                $response = $this->libRequest->normalize($response, $api->getBodyFormat());   
                break;

            case 'SOAP':
                $soap = $api->getSoapTemplate();
                $soapContent = <<<EOF
$soap
EOF;

                break;
            
            default:
                # code...
                break;
        }

        return $response;
    }
    
}
