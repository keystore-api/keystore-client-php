<?php

namespace keystore\exceptions;

use keystore\contracts\ArraySerializer;
use keystore\contracts\KeystoreExceptionInterface;
use RuntimeException;
use Exception;

/**
 * Общий класс исключения
 *
 * Class AbstractKeystoreException
 * @package keystore\exceptions
 */
abstract class AbstractKeystoreException extends RuntimeException implements KeystoreExceptionInterface, ArraySerializer
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var int
     */
    protected $status;

    /**
     * @inheritDoc
     */
    public function __construct(
        $name = "",
        $message = "",
        $code = 0,
        $status = 0,
        Exception $previous = null
    )
    {
        parent::__construct($message, $code, $previous);

        $this->name = $name;
        $this->status = $status;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $data)
    {
        $instance = new static();

        foreach ($data as $key => $value) {
            if (property_exists($instance, $key) === true) {
                $instance->$key = $value;
            }
        }

        return $instance;
    }
}
