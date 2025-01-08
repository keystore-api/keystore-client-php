<?php

namespace keystore\contracts;

/**
 * Информация о статусе заказе
 *
 * Class OrderStatusInterface
 * @package keystore\contract
 */
interface OrderStatusInterface
{

    const STATUS_UNPAID = 'unpaid';
    const STATUS_IN_PROCESS = 'in_process';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';
    const STATUS_ERROR = 'error';
    const STATUS_REFUND = 'refund';


    /**
     * Статус заказа
     * @return string
     */
    public function getStatus();

}
