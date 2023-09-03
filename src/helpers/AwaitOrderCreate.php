<?php

namespace keystore\helpers;

use keystore\commands\OrderCreateParams;
use keystore\contracts\ApiProviderInterface;
use keystore\contracts\OrderCreatedInterface;
use keystore\contracts\OrderDetailInterface;
use keystore\contracts\OrderDownloadInterface;
use keystore\exceptions\BadRequestException;

/**
 * Создание и получение информации по заказу
 *
 * Class AwaitOrderCreate
 * @package keystore\helpers
 */
class AwaitOrderCreate
{
    /**
     * Провайдер данных
     *
     * @var ApiProviderInterface
     */
    private $apiProvider;

    /**
     * Созданный заказ
     *
     * @var OrderCreatedInterface|null
     */
    private $orderCreated;

    /**
     * @param ApiProviderInterface $apiProvider
     */
    public function __construct(ApiProviderInterface  $apiProvider)
    {
        $this->apiProvider = $apiProvider;
    }

    /**
     * Получение информации по заказу
     * 
     * @return OrderCreatedInterface|OrderDetailInterface|OrderDownloadInterface
     */
    public function createByParams(OrderCreateParams $params)
    {
        $this->orderCreate($params);
        $orderCreated = $this->orderCreated;

        if (
            $orderCreated->getStatus() === $orderCreated::STATUS_PENDING &&
            ($orderDetail = $this->awaitFetchOrderDetail()) !== null
        ) {
            return $orderDetail;
        }

        return $orderCreated;
    }

    /**
     * Получение информации по заказу
     *
     * @return OrderDetailInterface|null
     */
    private function awaitFetchOrderDetail()
    {
        sleep(1);
        $orderDetail = $this->fetchOrderDetail();

        if ($orderDetail === null) {
            sleep(3);

            return $this->fetchOrderDetail();
        }

        return $orderDetail;
    }

    /**
     * Получение информации по заказу
     *
     * @return OrderDetailInterface|null
     */
    private function fetchOrderDetail()
    {
        $orderCreated = $this->orderCreated;
        $apiProvider = $this->apiProvider;
        $orderId = $orderCreated->getId();

        try {
            return $apiProvider->orderDownload($orderId);
        } catch (BadRequestException $exception) {
            return null;
        }
    }

    /**
     * Создание заказа
     *
     * @param OrderCreateParams $params
     * @return void
     */
    private function orderCreate(OrderCreateParams $params)
    {
        $apiProvider = $this->apiProvider;
        $this->orderCreated = $apiProvider->orderCreate($params);
    }
}
