<?php

namespace keystore\exceptions;

/**
 * Создание исключения
 *
 * Class ExceptionFactory
 * @package \keystore\exceptions
 */
class ExceptionFactory
{
    /**
     * ExceptionFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * Из массива
     *
     * @param array $data
     * @return AbstractKeystoreException
     */
    public static function fromArray(array $data)
    {
        switch ($data['status']) {
            case 401:
                return UnauthorizedException::fromArray($data);
            case 400:
                return BadRequestException::fromArray($data);
            case 422:
            default:
                return InvalidDataException::fromArray($data);
        }
    }
}
