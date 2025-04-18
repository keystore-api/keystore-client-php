<?php

namespace keystore\contracts;

use keystore\entities\AttributeItem;

/**
 * Список атрибутов
 *
 * Class AttributeListInterface
 * @package keystore\contract
 */
interface AttributeListInterface extends PaginationInterface, ResultInterface
{
    /**
     * Элементы
     *
     * @return AttributeItem[]
     */
    public function getItems();
}
