<?php

namespace keystore\contracts;


/**
 * Созданный заказ
 *
 * Class OrderCreatedInterface
 * @package keystore\contract
 */
interface OrderCreatedInterface extends ResultInterface
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
     * Ссылка на загрузку товара
     *
     * @return string|null
     */
    public function getLink();

    /**
     * Заказ создан
     *
     * @return boolean
     */
    public function isOk();
}
