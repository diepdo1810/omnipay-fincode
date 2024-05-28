<?php

namespace Omnipay\Fincode\Message;

use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    public function isRedirect()
    {
        return isset($this->data['status']) && $this->data['status'] === 'CREATED';
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTransactionReference()
    {
        return $this->data['id'] ?? null;
    }

    public function getRedirectUrl()
    {
        return $this->data['link_url'] ?? null;
    }

    public function getTransactionId()
    {
        return $this->data['transaction']['order_id'] ?? null;
    }

    public function isSuccessful()
    {
        // TODO: Implement isSuccessful() method.
    }
}