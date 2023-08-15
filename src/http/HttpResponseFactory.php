<?php

namespace keystore\http;

use keystore\exceptions\AbstractKeystoreException;
use keystore\exceptions\ExceptionFactory;

/**
 * Создание HTTP ответа
 *
 * Class HttpResponseFactory
 * @package \keystore\http
 */
class HttpResponseFactory
{
    /**
     * HttpResponseFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * Создание запроса из массива
     *
     * @param callable $callback
     * @param array $data
     * @return AbstractHttpResponse
     * @throws AbstractKeystoreException
     */
    public static function fromArray(callable $callback, array $data)
    {
        if (
            array_key_exists('success', $data) === true &&
            $data['success'] === false
        ) {
            throw ExceptionFactory::fromArray($data['data']);
        }

        return call_user_func_array($callback, [$data]);
    }
}
