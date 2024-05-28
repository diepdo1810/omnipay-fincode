<?php

namespace Omnipay\Fincode\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['status']) && $this->data['status'] === 'AUTHORIZED';
    }

    public function getTransactionReference()
    {
        return $this->data['id'] ?? 1;
    }

    public function getData()
    {
        return $this->data;
    }
}