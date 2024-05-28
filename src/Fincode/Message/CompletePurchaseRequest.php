<?php

namespace Omnipay\Fincode\Message;

class CompletePurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        return [];
    }

    public function sendData($data)
    {
        $sessionId = $this->getTransactionId();
        $response = $this->sendRequest('GET', '/payments/' . $sessionId, $data);

        return $this->response = new CompletePurchaseResponse($this, json_decode($response->getBody()->getContents(), true));
    }
}