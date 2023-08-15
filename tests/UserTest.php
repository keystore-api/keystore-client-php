<?php


use keystore\AuthApiKey;
use keystore\contracts\HttpClientInterface;
use keystore\contracts\UserBalanceInterface;
use keystore\KeystoreClientFactory;
use PHPUnit\Framework\TestCase;

/**
 * Пользователь
 *
 * Class UserTest
 */
class UserTest extends TestCase
{
    /**
     * @return void
     */
    public function testBalanceSuccess()
    {
        $json = '{
          "success": true,
          "data": {
              "balance": 455,
              "currency" : "RUB"
            }
        }';
        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendData')
            ->willReturn(json_decode($json, true));

        $service = KeystoreClientFactory::http($mockClient, new AuthApiKey(""));
        $result = $service->userBalance();

        $this->assertInstanceOf(UserBalanceInterface::class, $result);
        $this->assertEquals(455, $result->getBalance());
        $this->assertEquals("RUB", $result->getCurrency());
    }
}
