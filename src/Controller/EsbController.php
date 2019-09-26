<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Manager\ApiManager;
use App\Manager\RequestManager;
use App\Service\ParameterService;
use App\Service\NotificationService;
use App\Entity\Request as Requete;
use App\Exception\EsbException;
use \DateTime;
use App\Model\ResponseRequest;
use \Exception;

class EsbController extends AbstractController
{
    /**
     * @Rest\Post("/api/{apiref}/run")
     * @Rest\View
     * @SWG\Response(
     *     response=200,
     *     description="Returns the result",
     * )
     *
     * 
     * @SWG\Parameter(
     *     name="account",
     *     in="formData",
     *     type="string",
     *     description="Account"
     * )
     * 
     * @SWG\Parameter(
     *     name="amount",
     *     in="formData",
     *     type="string",
     *     description="Amount"
     * )
     * 
     * @SWG\Parameter(
     *     name="serviceid",
     *     in="formData",
     *     type="string",
     *     description="Service Id"
     * )
     *
     */
    public function runPost(Request $request,
                            ApiManager $apiMng,
                            RequestManager $requestMng,
                            ParameterService $paramService,
                            NotificationService $notif,
                            string $apiref)
    {
        $host = $request->getHost();
        $scheme = $request->getScheme();
        $origin = "$scheme://$host";
        $ipadrress = $request->getClientIp();
        try{
            $requete = new Requete();
            $api = $apiMng->findOneByRef($apiref);
            if($api == null || !$api->getStatus()){
                throw new EsbException(404, "API not Found");
            }
            $requete->setOrigin($origin);
            $requete->setIporigin($ipadrress);
            $requete->setApi($api);
            $requete->setDate(new DateTime());
            $requete->setStatus(false);
            $requete = $requestMng->save($requete);

            /* Get In parameters */
            $response = $paramService->getParams($api, $request, "in");
            if(!isset($response->{$api->getDecisionParam()})){
                $notif->failedRequest($requete);
                throw new EsbException(500, "FAILED");
            }
            $result = new ResponseRequest(500, $response->{$api->getMessageParam()});
            $result->setContent($response);
            $decision = $response->{$api->getDecisionParam()};
            $success = explode(",", $api->getValueSuccess());
            $info = explode(",", $api->getValueInfo());
            $failed = explode(",", $api->getValueFailed());
            if(in_array($decision, $success)){
                $requete->setStatus(true);
                $requete = $requestMng->save($requete);
                $result->setCode(200);
            }else if(in_array($decision, $info)){
                $requete->setStatus(true);
                $requete = $requestMng->save($requete);
                $result->setCode(201);
            }else if(!in_array($decision, $failed)){
                $notif->failedRequest($requete);
            }
        }catch(EsbException $e){
            $result = new ResponseRequest($e->getCode(), $e->getMessage());
        }catch(Exception $e){
            $notif->failedRequest($requete);
            $result = new ResponseRequest(500, "FAILED");
        }
        

        $data = $this->get('serializer')->serialize($result, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
         
    }

     /**
     * @Rest\Get("/api/{apiref}/run")
     * @Rest\View
     * @SWG\Response(
     *     response=200,
     *     description="Returns the result",
     * )
     *
     *
     */
    public function runGet()
    {
        return $this->render('esb/index.html.twig', [
            'controller_name' => 'EsbController',
        ]);
    }
}
