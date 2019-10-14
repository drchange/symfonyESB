<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParamFetcherInterface;
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

use function GuzzleHttp\json_decode;

class EsbController extends AbstractController
{

    /**
    * The construct method
    */
   public function __construct()
   {
       header("Access-Control-Allow-Origin: *");
   }

   
    /**
     * 
     * @Route("/{url}", name="remove_trailing_slash",
     *     requirements={"url" = ".*\/$"}, methods={"GET","POST","PUT"})
     *
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
                            ParamFetcherInterface $paramfetcher,
                            ApiManager $apiMng,
                            RequestManager $requestMng,
                            ParameterService $paramService,
                            NotificationService $notif,
                            string $url)
    {
        $host = $request->getHost();
        $scheme = $request->getScheme();
        $origin = "$scheme://$host";
        $ipadrress = $request->getClientIp();
        $response = null;
        try{
            $requete = new Requete();
            $criteria = array('ref' => $url);
            $api = $apiMng->findOneBy($criteria);
            if($api == null){
                throw new EsbException(404, "API not Found");
            }elseif(!$api->getStatus()){
                throw new EsbException(501, "API unvailable for this moment");
            }elseif($api->getMethodin() != $request->getMethod()){
                throw new EsbException(305, "Method Not Allowed");
            }
            $requete->setOrigin($origin);
            $requete->setIporigin($ipadrress);
            $requete->setApi($api);
            $requete->setDate(new DateTime());
            $requete->setStatus(false);
            $requete = $requestMng->save($requete);

            $response = $paramService->getParams($api, $request, "in");
            $requete->setStatus(true);
            $requete = $requestMng->save($requete);
            /*if(!isset($response->{$api->getDecisionParam()})){
                $notif->failedRequest($requete);
                throw new EsbException(500, "FAILED");
            }*/
            //$result = new ResponseRequest(500, $response->{$api->getMessageParam()});
            //$result->setContent($response);
            /*$decision = $response->{$api->getDecisionParam()};
            $success = explode(",", $api->getValueSuccess());
            if(in_array($decision, $success)){
                $requete->setStatus(true);
                $requete = $requestMng->save($requete);
            }elseif(true){
                $notif->failedRequest($requete);
            }*/
            $data = json_encode($response);
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }catch(EsbException $e){
            $result = new ResponseRequest($e->getCode(), $e->getMessage());
            $data = $this->get('serializer')->serialize($result, 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        
        
         
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
