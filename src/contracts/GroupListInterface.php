<?php

namespace keystore\contracts;

use keystore\entities\GroupItem;

/**
 * Список групп
 *
 * Class GroupListInterface
 * @package keystore\contract
 */
interface GroupListInterface extends PaginationInterface, ResultInterface
{
    /**
     * Элементы
     *
     * @return GroupItem[]
     */
    public function getItems();
}
