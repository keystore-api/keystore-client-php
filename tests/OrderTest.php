<?php


use keystore\AuthApiKey;
use keystore\commands\OrderCreateParams;
use keystore\contracts\HttpClientInterface;
use keystore\contracts\OrderCreatedInterface;
use keystore\contracts\OrderDetailInterface;
use keystore\KeystoreClientFactory;
use PHPUnit\Framework\TestCase;

/**
 * Заказ
 *
 * Class OrderTest
 */
class OrderTest extends TestCase
{
    /**
     * @return void
     */
    public function testCreateSuccess()
    {
        $json = '{
          "success": true,
          "data":     {
              "status": "ok",
              "id" : 1458,
              "link" : "http://mock/storage/f2024b14e467833028fc1d198637c015f457de113a45e7e9c867a46c59ad1cfe.txt"
            }
        }';
        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendData')
            ->willReturn(json_decode($json, true));

        $params = new OrderCreateParams(1, 5);
        $service = KeystoreClientFactory::http($mockClient, new AuthApiKey(""));
        $result = $service->orderCreate($params);

        $this->assertInstanceOf(OrderCreatedInterface::class, $result);
        $this->assertEquals(1458, $result->getId());
        $this->assertEquals("ok", $result->getStatus());
    }

    /**
     * @return void
     */
    public function testViewSuccess()
    {
        $json = '{
          "success": true,
          "data": {
              "link": "http://mock/storage/f2024b14e467833028fc1d198637c015f457de113a45e7e9c867a46c59ad1cfe.txt"
            }
        }';
        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendData')
            ->willReturn(json_decode($json, true));

        $service = KeystoreClientFactory::http($mockClient, new AuthApiKey(""));
        $result = $service->orderDownload(1458);

        $this->assertInstanceOf(OrderDetailInterface::class, $result);
    }
}
