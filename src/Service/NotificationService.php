<?php

namespace App\Service;

use \Swift_Mailer;
use \Swift_Message;
use \Swift_Attachment;
use Twig\Environment;
use App\Entity\Request;

use App\Service\HttpCurlClientService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/* @class service notification service */
class NotificationService
{

    /** @var CurlService */
    private $curl;

    /** @var ParameterBagInterface */
    private $params;


    /** @var Swift_Mailer */
    private $mailer;

    /** @var Environment */
    private $twig;

     

    public function __construct(Swift_Mailer $mailer, Environment $twig, HttpCurlClientService $curl, ParameterBagInterface $params)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->curl = $curl;
        $this->params = $params;
    }


    public function failedRequest(Request $request)
    {
        $content = "API : ". $request->getApi()->getRef() . 
        "  Origin : ". $request->getOrigin() .
        "  IP Address : ". $request->getIporigin() ;
        $this->mail("tresor.simo@afrikpay.com","Failed Request", $content);
        $this->slack("Failed Request",$content);
    }


    public function mail(string $email, string $object, string $content = "")
    {
        $this->full($email, $object, $content);
    }


    public function slack($object,$message) : bool
    {
        $message = <<<EOF
 
______________________________________________________________________________________________________________________
AFRIKPAY ESB - $object                  
----------------------------------------------------------------------------------------------------------------------
$message
----------------------------------------------------------------------------------------------------------------------
        
EOF;
        $data = [
            "text" => $message,
            "username" => $this->params->get('slack')['sender'],
            "channel" => $this->params->get('slack')['channelcore'],
        ];
        if ($this->curl->push($this->params->get('slack')['url'], $data, 'POST')) {
            return true;
        }

        return false;
    }

    public function full(
        string $email,
        string $object,
        string $content = null,
        array $attach = null,
        string $temp = "emails/base.html.twig"
    ) {
        $message = (new Swift_Message($object))
            ->setFrom(['support@afrikpay.com' => 'MyESB (Afrikpay)'])
            ->setTo($email)
            ->setBody(
                $this->twig->render(
                    // templates/emails/registration.html.twig
                    $temp,
                    ['data' => $content]
                ),
                'text/html'
            )
        ;
        
        if ($attach != null) {
            foreach ($attach as $value) {
                // Code to be executed
                $message->attach(Swift_Attachment::fromPath($value));
            }
        }
        

        $this->mailer->send($message);
    }
   

}
