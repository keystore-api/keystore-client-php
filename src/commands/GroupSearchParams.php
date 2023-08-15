<?php

namespace keystore\commands;


use keystore\helpers\Assert;

/**
 * Поисковые параметры группы
 *
 * Class GroupSearchParams
 * @package keystore\commands
 */
class GroupSearchParams extends PaginationParams
{
    /**
     * @var array|null
     */
    protected $ids;

    /**
     * @var int|null
     */
    protected $categoryId;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @param array $ids
     * @return GroupSearchParams
     */
    public function setIds($ids)
    {
        Assert::integers("IDS", $ids);
        $this->ids = $ids;

        return $this;
    }

    /**
     * @param int $categoryId
     * @return GroupSearchParams
     */
    public function setCategoryId($categoryId)
    {
        Assert::integer("Category ID", $categoryId);
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @param string $name
     * @return GroupSearchParams
     */
    public function setName($name)
    {
        Assert::string("Name", $name);
        $this->name = $name;

        return $this;
    }
}