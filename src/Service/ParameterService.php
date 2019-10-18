<?php

namespace App\Service;

use App\Entity\Api;
use App\Manager\ParameterManager;
use App\Manager\RequestManager;
use App\Service\SendRequestService;
use App\Exception\EsbException;
use \StdClass;
use App\Service\ParserService;



/* @class service parameter service */
class ParameterService
{

    /* @var ParameterManager */
    private $paramManager;

     /* @var SendRequestService */
    private $sendRequest;

    private $requestManager;

    private $parser;

    public function __construct(ParameterManager $paramManager,
                                RequestManager $requestManager,
                                ParserService $parser,
                                SendRequestService $sendRequest)
    {
        $this->paramManager = $paramManager;
        $this->sendRequest = $sendRequest;
        $this->requestManager = $requestManager;
        $this->parser = $parser;
    }

    /* @function get parameters from request */
    public function getParams(Api $api, $request, string $flow, $requete){
        $criteria = array('flow' => $flow, 'api' => $api);
        $parameters = $this->paramManager->findBy($criteria);
        $params  = array();
        foreach ($parameters as $param) {
            if($param->getIsStatic()){
                $params[$param->getOutName()] = $param->getValueStatic();
            }elseif($param->getInUrl()){
                $tmp = explode("/", $api->getRef());
                $params[$param->getOutName()] = $tmp[$param->getLevelinUrl() - 1];
            }elseif(true){
                $params[$param->getOutName()] = $request->get($param->getInName());
            }
            
            if($param->getRequired())
            {
                if(!isset($params[$param->getOutName()]) )
                {
                    throw new EsbException(401, "Parameter ". $param->getInName(). " is required");
                }elseif(!preg_match($param->getRegex(), $params[$param->getOutName()])){
                    throw new EsbException(402, "Wrong Parameter ". $param->getInName());
                }
            }
        }
        if($api->getParser()){
            $params = $this->parser->parse($api->getParserPhpOut(),"out", $params);
        }
        $requete->setDumpEntryOut(json_encode($params));
        $response = $this->sendRequest->run($api, $params);
        $requete->setDumpResponseIn(json_encode($response));
        if($api->getParserx()){
            $response = $this->parser->parse($api->getParserPhpIn(),"in", $response);
        }
        $criteria = array('flow' => 'out', 'api' => $api);
        $parameters = $this->paramManager->findBy($criteria);
        $result = new StdClass();
        foreach ($parameters as $param) {
            $result->{$param->getInName()} = $response->{$param->getOutName()} ;
            
        }
        $requete->setDumpResponseOut(json_encode($result));
        $this->requestManager->save($requete);
        return $result;
    }
    
}
