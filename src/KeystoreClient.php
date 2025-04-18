<?php

namespace keystore;


use keystore\commands\GroupSearchParams;
use keystore\commands\OrderCreateParams;
use keystore\commands\ProductSearchParams;
use keystore\contracts\ApiProviderInterface;
use keystore\contracts\AttributeListInterface;
use keystore\contracts\CategoryListInterface;
use keystore\contracts\GroupListInterface;
use keystore\contracts\OrderCreatedInterface;
use keystore\contracts\OrderDetailInterface;
use keystore\contracts\OrderStatusInterface;
use keystore\contracts\ProductDetailInterface;
use keystore\contracts\ProductListInterface;
use keystore\contracts\UserBalanceInterface;

/**
 * Клиент работы с сервисом Keystore
 *
 * Class KeystoreClient
 * @package keystore
 *
 * @method CategoryListInterface categoryList() Список категорий
 * @method AttributeListInterface attributeList() Список атрибутов
 * @method GroupListInterface groupList(GroupSearchParams $search = null) Список групп
 * @method ProductListInterface productList(ProductSearchParams $search = null) Список товаров
 * @method ProductDetailInterface productView(int $id) Просмотр товара
 * @method ProductListInterface productTopList() Топ-100 товаров
 * @method UserBalanceInterface userBalance() Просмотр баланса
 * @method OrderCreatedInterface orderCreate(OrderCreateParams $params) Создание заказа
 * @method OrderDetailInterface orderDownload(int $id) Просмотр заказа
 * @method OrderStatusInterface orderStatus(int $id) Получение статуса заказа
 * @method OrderCreatedInterface|OrderDetailInterface awaitOrderCreate(OrderCreateParams $params) Создание заказа с возможностью просмотра
 */
class KeystoreClient
{
    /**
     * Провайдер данных
     *
     * @var ApiProviderInterface
     */
    private $apiProvider;

    /**
     * KeystoreClient constructor.
     * @param ApiProviderInterface $apiProvider
     */
    public function __construct(ApiProviderInterface $apiProvider)
    {
        $this->apiProvider = $apiProvider;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this
            ->apiProvider
            ->$name(...$arguments);
    }
}
