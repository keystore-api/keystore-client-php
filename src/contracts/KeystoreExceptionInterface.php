<?php

namespace keystore\contracts;


/**
 * Общий интерфейс исключений
 *
 * Class KeystoreExceptionInterface
 * @package keystore\contracts
 */
interface KeystoreExceptionInterface
{
    /**
     * @return string|null
     */
    public function getName();

    /**
     * @return int
     */
    public function getStatus();
}