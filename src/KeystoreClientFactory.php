<?php

namespace keystore;

use keystore\clients\HttpGuzzleClient;
use keystore\contracts\AuthCredentialsInterface;
use keystore\contracts\HttpClientInterface;
use keystore\providers\HttpApiProvider;

/**
 * Создание клиента
 *
 * Class KeystoreClientFactory
 * @package \keystore
 */
class KeystoreClientFactory
{
    /**
     * KeyStoreClientFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * Упрощенное создание клиента на основе HTTP поставщика данных
     *
     * @param string $key
     * @return KeystoreClient
     */
    public static function create($key)
    {
        $auth = new AuthApiKey($key);
        $client = new HttpGuzzleClient();

        return self::http($client, $auth);
    }

    /**
     * Создание клиента на основе HTTP поставщика данных
     *
     * @param HttpClientInterface $httpClient
     * @param AuthCredentialsInterface $auth
     * @return KeystoreClient
     */
    public static function http(
        HttpClientInterface      $httpClient,
        AuthCredentialsInterface $auth
    )
    {
        $provider = new HttpApiProvider($httpClient, $auth);

        return new KeystoreClient($provider);
    }
}
