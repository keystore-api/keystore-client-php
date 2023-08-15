<?php

namespace keystore;

use keystore\contracts\AuthCredentialsInterface;

/**
 * Авторизация по ключу API
 *
 * Class AuthApiKey
 * @package keystore
 */
class AuthApiKey implements AuthCredentialsInterface
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return $this->apiKey;
    }
}