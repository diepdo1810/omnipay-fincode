<?php

namespace Omnipay\Fincode\Tests;

use Omnipay\Fincode\Gateway;
use PHPUnit\Framework\TestCase;

class GatewayTest extends TestCase
{
    protected $gateway;
    protected $orderId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gateway = new Gateway();
        $apiKey = getEnv('FINCODE_API_KEY');
        $this->gateway->setApiKey('m_test_NGE5MDlhZDItOTg4Mi00ZDRiLTk0ODItZWI1MzE3NGE0YzZhN2Q1NGIzZWEtYjg3OS00ZWY0LThjY2EtODdjZTY4MWQ4OTJic18yNDA1MTM0NjU1MA');
        $this->gateway->setTestMode(true);
    }

    public function testPurchase()
    {
        // Step 1: Create a session
        $sessionId = 'o_'.generateCustomId(22);
        $requestParams = [
            "transaction" => [
                "amount" => '1000',
                "currency" => "JPY",
                "order_id" => $sessionId,
            ],
            "success_url" => "https://example.com/success". '?session_id=' . $sessionId,
            "cancel_url" => "https://example.com/cancel",
        ];

        $purchase = $this->gateway->purchase();
        $responsePurchase = $purchase->sendData($requestParams);

        $this->assertInstanceOf('Omnipay\Fincode\Message\PurchaseRequest', $purchase);
        $this->assertNotEmpty($responsePurchase->getData());
        $this->assertNotEmpty($responsePurchase->getTransactionReference());
        $this->assertEquals($sessionId, $responsePurchase->getTransactionId());
        $this->assertNotEmpty($responsePurchase->getRedirectUrl());

        // Step 2: Redirect to the payment page
        // redirect to $responsePurchase->getRedirectUrl(): https://secure.test.fincode.jp/v1/links/lk_EGQAFB1oSyCvOU8MnNjLqQ
        // submit card information


        // Step 3: Complete the purchase, check the payment status
        $completePurchase = $this->gateway->completePurchase();
        $completePurchase->setTransactionId('o_8pVefsqWQ4GGEYXxCb3Mvw');
        $response = $completePurchase->sendData([
            'pay_type' => 'Card'
        ]);

        $this->assertInstanceOf('Omnipay\Fincode\Message\CompletePurchaseRequest', $completePurchase);
        $this->assertNotEmpty($response->getData());
        // $response->isSuccessful() === true if the payment is successful
        $this->assertTrue($response->isSuccessful());
    }
}