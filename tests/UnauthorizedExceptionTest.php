<?php


use keystore\AuthApiKey;
use keystore\contracts\HttpClientInterface;
use keystore\exceptions\UnauthorizedException;
use keystore\KeystoreClientFactory;
use PHPUnit\Framework\TestCase;

/**
 * Тест авторизации
 *
 * Class UnauthorizedExceptionTest
 * @package ${NAMESPACE}
 */
class UnauthorizedExceptionTest extends TestCase
{
    /**
     * @return void
     */
    public function testSuccess()
    {
        $this->expectException(UnauthorizedException::class);

        $json = '{
            "success": false,
            "data": {
                "name": "Unauthorized",
                "message" : "Your request was made with invalid credentials",
                "code": 0,
                "status": 401
            }
        }';
        $mockClient = $this
            ->getMockBuilder(HttpClientInterface::class)
            ->getMock();
        $mockClient
            ->method('sendGet')
            ->willReturn(json_decode($json, true));

        $service = KeystoreClientFactory::http($mockClient, new AuthApiKey(""));
        $service->userBalance();
    }
}
