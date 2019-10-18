<?php

namespace App\Service;

use Symfony\Component\HttpClient\CurlHttpClient;



/* @class service curl http service */
class HttpCurlClientService
{

    public function push(string $url, $data, string $method = 'GET', $type = 'json', $headers = null) : string
    {
        return $this->{"send$method"}($url, $data, $type, $headers);
    }
    
    public function sendGET(string $url, $data) : string
    { 
        $httpClient = new CurlHttpClient();
        $timeout = 500;

        $response = $httpClient->request('GET', $url, [
            'query' => $data,
            'timeout' => $timeout
        ]);
        return $response->getContent();
    }
    
    // type = "json/xml/raw data"
    public function sendPOST(string $url, $data, $type = 'json', $headers = null, $vHost= true, $vPeer = true) : string
    {
        $httpClient = new CurlHttpClient();
        $response = "";
        $timeout = 500;
        
         $xmldata ='<?xml version="1.0" encoding="UTF-8"?>';
        $xmldata.='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body>';
        $xmldata.='<ns2:creditVendReq xmlns:ns2="http://www.nrs.eskom.co.za/xmlvend/revenue/2.1/schema" ';
        $xmldata.='xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="ns2:CreditVendReq">';
        $xmldata.='<clientID xmlns="http://www.nrs.eskom.co.za/xmlvend/base/2.1/schema" xsi:type="EANDeviceID" ean="';
        $xmldata.='1111111111116';
        $xmldata.='"  /><terminalID xmlns="http://www.nrs.eskom.co.za/xmlvend/base/2.1/schema" xsi:type="GenericDeviceID" id="';
        $xmldata.='1111111111116';
        $xmldata.='" /><msgID xmlns="http://www.nrs.eskom.co.za/xmlvend/base/2.1/schema"  dateTime="';
        $xmldata.='18102019172825';
        $xmldata.='"  uniqueNumber="';
        $xmldata.='123456';
        $xmldata.='"  /><authCred xmlns="http://www.nrs.eskom.co.za/xmlvend/base/2.1/schema"><opName>';
        $xmldata.='AFRIKPAY';
        $xmldata.='</opName><password>';
        $xmldata.='AFP@y1234';
        $xmldata.='</password><newPassword>';
        $xmldata.='AFP@y1234';
        $xmldata.='</newPassword></authCred><resource xmlns="http://www.nrs.eskom.co.za/xmlvend/base/2.1/schema" xsi:type="Electricity"/>';
        $xmldata.='<idMethod xmlns="http://www.nrs.eskom.co.za/xmlvend/base/2.1/schema" xsi:type="VendIDMethod"><meterIdentifier xsi:type="MeterNumber" msno="';
        $xmldata.='014294829149';
        $xmldata.='" /></idMethod><ns2:purchaseValue xsi:type="ns2:PurchaseValueCurrency"><ns2:amt value="';
        $xmldata.='100';
        $xmldata.='" symbol="AZM" /></ns2:purchaseValue><ns2:payType xmlns:ns1="http://www.nrs.eskom.co.za/xmlvend/base/2.1/schema" xsi:type="ns1:Cash"><ns1:tenderAmt value="';
        $xmldata.='100';
        $xmldata.='" symbol="AZM" /></ns2:payType></ns2:creditVendReq></soapenv:Body></soapenv:Envelope>';

        $chp = curl_init($url);
        curl_setopt($chp, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($chp, CURLOPT_POST, 1);
        curl_setopt($chp, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($chp, CURLOPT_URL, $url);
        curl_setopt($chp, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt($chp, CURLOPT_POSTFIELDS, trim($xmldata));
        curl_setopt($chp, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($chp, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($chp);
        curl_error($chp);
        curl_close($chp);
        return $response;

        
    /*    if ($type === 'json') {
            $response = $httpClient->request('POST', $url, [
                $type => $data,
                'headers' => $headers
            ]);
        } elseif (true) {
            $bodyparam = $dataparam = 'body';
            $response = $httpClient->request('POST', $url, [
                $bodyparam => $type,
                $dataparam => $data,
                'headers' => $headers,
                'timeout' => $timeout,
                'verify_host' => $vHost, 
                'verify_peer' => $vPeer
            ]);
        }
        return $response->getContent(); */
    }

    
    
}
