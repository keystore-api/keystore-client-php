<?php

namespace keystore\contracts;

/**
 * Результат команды
 *
 * Class ResultInterface
 * @package keystore\contract
 */
interface ResultInterface
{
    /**
     * Результат запроса
     *
     * @return bool
     */
    public function getSuccess();
}