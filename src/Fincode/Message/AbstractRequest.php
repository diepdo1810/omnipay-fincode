<?php

namespace Omnipay\Fincode\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;
use GuzzleHttp\Client;

abstract class AbstractRequest extends OmnipayAbstractRequest
{
    protected $liveEndpoint = 'https://api.fincode.jp/v1';
    protected $testEndpoint = 'https://api.test.fincode.jp/v1';

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getEndpoint()
    {
       return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getEndpointPath()
    {
        return $this->getParameter('endpointPath');
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    public function setHttpMethod($value)
    {
        return $this->setParameter('httpMethod', $value);
    }

    public function getHeaders()
    {
        return [
            'Authorization' => 'Bearer ' . $this->getApiKey(),
            'Content-Type' => 'application/json',
        ];
    }

    public function getData()
    {
        return $this->parameters->all();
    }

    protected function sendRequest($method, $url, $data = [])
    {
        $client = new Client();

        $options = [
            'headers' => $this->getHeaders(),
        ];

        if ($method === 'POST') {
            $options['json'] = $data;
        }

        if ($method === 'GET') {
            $options['query'] = $data;
        }

        return $client->request($method, $this->getEndpoint() . $url, $options);
    }

    public function setTransactionId($value)
    {
        return $this->setParameter('session_id', $value);
    }

    public function getTransactionId()
    {
        return $this->getParameter('session_id');
    }
}