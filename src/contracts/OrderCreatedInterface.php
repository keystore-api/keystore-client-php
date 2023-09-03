<?php

namespace keystore\contracts;


/**
 * Созданный заказ
 *
 * Class OrderCreatedInterface
 * @package keystore\contract
 */
interface OrderCreatedInterface extends ResultInterface, OrderDownloadInterface
{
    /** @var string */
    const STATUS_OK = 'ok';

    /** @var string */
    const STATUS_PENDING = 'pending';

    /**
     * Статус заказа
     *
     * @return string
     */
    public function getStatus();

    /**
     * ID заказа
     *
     * @return int
     */
    public function getId();

    /**
     * Заказ создан
     *
     * @return boolean
     */
    public function isOk();
}
