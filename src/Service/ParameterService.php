<?php

namespace App\Service;

use App\Entity\Api;
use Doctrine\ORM\EntityManagerInterface;
use App\Manager\ParameterManager;
use App\Service\SendRequestService;



/* @class service parameter service */
class ParameterService
{

    /* @var ParameterManager */
    private $paramManager;

     /* @var SendRequestService */
     private $sendRequest;

    public function __construct(ParameterManager $paramManager,
                                SendRequestService $sendRequest)
    {
        $this->paramManager = $paramManager;
        $this->sendRequest = $sendRequest;
    }

    /* @function get parameters from request */
    public function getParams(Api $api, $request, string $flow){
        $criteria = array('flow' => $flow, 'api' => $api);
        $parameters = $this->paramManager->findBy($criteria);
        $params  = array();
        foreach ($parameters as $param) {
            if($param->getIsStatic()){
                $params[$param->getOutName()] = $param->getValueStatic();
            }elseif(true){
                $params[$param->getOutName()] = $request->get($param->getInName());
            }    
        }
        $response = $this->sendRequest->run($api, $params);
        return $response;
    }
    
}
