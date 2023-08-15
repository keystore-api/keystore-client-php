<?php

namespace keystore\exceptions;


use Throwable;

/**
 * Ошибка параметров
 *
 * Class InvalidDataException
 * @package keystore\exceptions
 */
class InvalidDataException extends AbstractKeystoreException
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @inheritDoc
     */
    public function __construct($errors = [], $code = 0, Throwable $previous = null)
    {
        parent::__construct("Unprocessable Entity", "", $code, 422, $previous);
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $data)
    {
        return new static($data);
    }
}
