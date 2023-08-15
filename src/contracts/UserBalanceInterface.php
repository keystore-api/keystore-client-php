<?php

namespace keystore\contracts;


/**
 * Просмотр баланса
 *
 * Class UserBalanceInterface
 * @package keystore\contract
 */
interface UserBalanceInterface extends ResultInterface
{
    /**
     * Баланс пользователя
     *
     * @return float
     */
    public function getBalance();

    /**
     * Валюта
     *
     * @return string
     */
    public function getCurrency();
}
