<?php

namespace Omnipay\Fincode\Message;


use Omnipay\Common\Http\ClientInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class PurchaseRequest extends AbstractRequest
{
    public function __construct(ClientInterface $httpClient, HttpRequest $httpRequest)
    {
        parent::__construct($httpClient, $httpRequest);
    }

    public function getData()
    {
        return $this->parameters->all();
    }

    public function sendData($data)
    {
        $response = $this->sendRequest('POST', '/sessions', $data);
        $this->setTransactionId($data['transaction']['order_id']);

        return $this->response = new PurchaseResponse($this, json_decode($response->getBody()->getContents(), true));
    }
}