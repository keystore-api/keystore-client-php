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

    /**
     * Если при создании заказа был передан `idempotence_id`, который уже существует, в ответе вернётся
     * `idempotence: true` и данные существующего заказа.
     *
     * @return boolean
     */
    public function isIdempotence();
}
