<?php

namespace keystore\contracts;

use keystore\entities\CategoryItem;

/**
 * Список категорий
 *
 * Class CategoryListInterface
 * @package keystore\contract
 */
interface CategoryListInterface extends PaginationInterface, ResultInterface
{
    /**
     * Элементы
     *
     * @return CategoryItem[]
     */
    public function getItems();
}
