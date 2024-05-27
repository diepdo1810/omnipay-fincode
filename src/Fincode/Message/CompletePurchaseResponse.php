<?php

namespace Omnipay\Fincode\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['status']) && $this->data['status'] === 'success';
    }

    public function getTransactionReference()
    {
        return $this->data['id'] ?? 1;
    }

    public function getMessage()
    {
        return $this->data['message'] ?? null;
    }
}