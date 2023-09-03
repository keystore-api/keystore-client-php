<?php

namespace keystore\contracts;

use keystore\commands\GroupSearchParams;
use keystore\commands\OrderCreateParams;
use keystore\commands\PaginationParams;
use keystore\commands\ProductSearchParams;

/**
 * Провайдер данных
 *
 * Class ApiProviderInterface
 * @package keystore\providers
 */
interface ApiProviderInterface
{
    /**
     * Список категорий
     *
     * @param ProductSearchParams|null $params
     * @return CategoryListInterface
     */
    public function categoryList(PaginationParams $params = null);

    /**
     * Список групп
     *
     * @param GroupSearchParams|null $params
     * @return GroupListInterface
     */
    public function groupList(GroupSearchParams $params = null);

    /**
     * Список товаров
     *
     * @param ProductSearchParams|null $params
     * @return ProductListInterface
     */
    public function productList(ProductSearchParams $params = null);

    /**
     * Просмотр товара
     *
     * @param int $id
     * @return ProductDetailInterface
     */
    public function productView($id);

    /**
     * Топ-100 товаров
     *
     * @param ProductSearchParams|null $params
     * @return ProductTopListInterface
     */
    public function productTopList(PaginationParams $params = null);

    /**
     * Просмотр баланса
     *
     * @return UserBalanceInterface
     */
    public function userBalance();

    /**
     * Создание заказа
     *
     * @param OrderCreateParams $params
     * @return OrderCreatedInterface
     */
    public function orderCreate(OrderCreateParams $params);

    /**
     * Просмотр заказа
     *
     * @param int $id
     * @return OrderDetailInterface
     */
    public function orderDownload($id);

    /**
     * Создание заказа с возможностью просмотра
     *
     * @param OrderCreateParams $params
     * @return OrderCreatedInterface|OrderDetailInterface|OrderDownloadInterface
     */
    public function awaitOrderCreate(OrderCreateParams $params);
}
