<?php

namespace keystore\contracts;

use keystore\entities\ProductItem;

/**
 * Список товаров
 *
 * Class ProductListInterface
 * @package keystore\contract
 */
interface ProductListInterface extends PaginationInterface, ResultInterface
{
    /**
     * Элементы
     *
     * @return ProductItem[]
     */
    public function getItems();
}
