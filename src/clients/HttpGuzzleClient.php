<?php

namespace keystore\clients;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use keystore\commands\AbstractRequestParams;
use keystore\contracts\AuthCredentialsInterface;
use keystore\contracts\HttpClientInterface;

/**
 * HTTP клиент на основе Guzzle
 *
 * Class HttpGuzzleClient
 * @package keystore\clients
 */
class HttpGuzzleClient extends Client implements HttpClientInterface
{
    /** @var */
    public static $baseUrl;

    /**
     * @var string
     */
    private $authKey;

    /**
     * @inheritDoc
     */
    public function __construct(array $config = [])
    {
        $config = array_merge($config, [
            'base_uri' => self::$baseUrl,
            'verify' => false,
        ]);
        parent::__construct($config);
    }

    /**
     * @inheritDoc
     */
    public function setAuth(AuthCredentialsInterface $credentials)
    {
        $this->authKey = $credentials->getAuthKey();
    }

    /**
     * @inheritDoc
     */
    public function sendData($uri, $params = null)
    {
        $content = $this
            ->get($uri, [
                RequestOptions::QUERY => self::prepareParams($params),
            ])
            ->getBody()
            ->getContents();

        return json_decode($content, true);
    }

    /**
     * Обработка параметров
     *
     * @param AbstractRequestParams|array|null $params
     * @return array
     */
    private function prepareParams($params = null)
    {
        if (($params instanceof AbstractRequestParams) === true) {
            return array_merge($params->toArray(), [
                'key' => $this->authKey,
            ]);
        }

        if (is_array($params) === true) {
            /** @var array $params */
            return array_merge($params, [
                'key' => $this->authKey,
            ]);
        }

        return [
            'key' => $this->authKey,
        ];
    }
}