<?php

namespace keystore\contracts;


use keystore\commands\AbstractRequestParams;

/**
 * HTTP клиент
 *
 * Class HttpClientInterface
 * @package keystore\clients
 */
interface HttpClientInterface
{
    /**
     * Установка данных авторизации
     *
     * @param AuthCredentialsInterface $credentials
     * @return void
     */
    public function setAuth(AuthCredentialsInterface $credentials);

    /**
     * Отправка POST запроса
     *
     * @param $uri
     * @param AbstractRequestParams|array|null $params
     * @return array
     */
    public function sendPost($uri, $params = null);

    /**
     * Отправка GET запроса
     *
     * @param $uri
     * @param AbstractRequestParams|array|null $params
     * @return array
     */
    public function sendGet($uri, $params = null);
}
