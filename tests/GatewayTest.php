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
        $this->gateway->setApiKey('m_test_NGE5MDlhZDItOTg4Mi00ZDRiLTk0ODItZWI1MzE3NGE0YzZhN2Q1NGIzZWEtYjg3OS00ZWY0LThjY2EtODdjZTY4MWQ4OTJic18yNDA1MTM0NjU1MA');
        $this->gateway->setTestMode(true);
    }

    public function testPurchase()
    {
        $sessionId = 'o_'.generateCustomId(22);
        $requestParams = [
            "transaction" => [
                "amount" => '1000',
                "currency" => "JPY",
                "order_id" => $sessionId,
            ],
            "success_url" => "https://example.com/success",
            "cancel_url" => "https://example.com/cancel",
        ];

        $request = $this->gateway->purchase();
        $response = $request->sendData($requestParams);
        $data = $response->getData();

        $this->orderId = $sessionId;
        $this->assertInstanceOf('Omnipay\Fincode\Message\PurchaseRequest', $request);
        $this->assertNotEmpty($data['id']);
        $this->assertEquals($sessionId, $data['transaction']['order_id']);
        $this->assertNotEmpty($data['link_url']);

    }

    /** TODO: Fix this test
    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase();
        $data = [
            'orderId' => $this->orderId
        ];
        $response = $request->sendData($data);
        $data = $response->getData();

        $this->assertInstanceOf('Omnipay\Fincode\Message\CompletePurchaseRequest', $request);
        $this->assertEmpty($data);
    } */
}