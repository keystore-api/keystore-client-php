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
    /**
     * @var string
     */
    private $authKey;

    /**
     * @param $baseUrl
     * @inheritDoc
     */
    public function __construct($baseUrl, array $config = [])
    {
        $config = array_merge($config, [
            'base_uri' => $baseUrl,
            'verify' => false,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            ],
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
    public function sendPost($uri, $params = null)
    {
        $content = $this
            ->post($uri, [
                RequestOptions::JSON => self::prepareParams($params),
            ])
            ->getBody()
            ->getContents();

        return json_decode($content, true);
    }

    /**
     * @inheritDoc
     */
    public function sendGet($uri, $params = null)
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