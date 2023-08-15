<?php

namespace keystore\contracts;

/**
 * Информация о заказе
 *
 * Class OrderDetailInterface
 * @package keystore\contract
 */
interface OrderDetailInterface extends ResultInterface
{
    /**
     * @return string
     */
    public function getLink();
}
