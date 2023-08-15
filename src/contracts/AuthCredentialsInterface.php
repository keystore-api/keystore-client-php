<?php

namespace keystore\contracts;

/**
 * Авторизация
 */
interface AuthCredentialsInterface
{
    /**
     * Ключ авторизации
     *
     * @return string
     */
    public function getAuthKey();
}