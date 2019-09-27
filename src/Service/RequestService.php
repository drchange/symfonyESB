<?php

namespace App\Service;

use App\Entity\Api;
use Doctrine\ORM\EntityManagerInterface;
use App\Manager\RequestManager;
use App\Service\SendRequestService;
use App\Entity\Request;
use \DateTime;

/* @class service request service */
class RequestService
{

    /* @var RequestManager */
    private $requestMng;

    public function __construct(RequestManager $requestMng,
                                SendRequestService $sendRequest)
    {
        $this->requestMng = $requestMng;
        $this->sendRequest = $sendRequest;
    }

    public function run(Request $request){
        var_dump("Cool"); die;
    }

    public function initiate(Api $api) : Request
    {
        $request = new Request();
        $request->setApi($api);
        $request->setDate(new DateTime());
        $request->setStatus(false);
        return $this->requestMng->save($request);
    }
    
}
