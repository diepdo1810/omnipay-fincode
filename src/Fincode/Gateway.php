<?php

namespace Omnipay\Fincode;

use Omnipay\Common\AbstractGateway;
use Omnipay\Fincode\Message\PurchaseRequest;
use Omnipay\Fincode\Message\CompletePurchaseRequest;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Fincode';
    }

    public function getDefaultParameters()
    {
        return [
            'apiKey' => '',
            'testMode' => false,
        ];
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }


    public function getHeaders()
    {
        return [
            'Authorization' => 'Bearer ' . $this->getApiKey(),
            'Content-Type' => 'application/json',
        ];
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }
}