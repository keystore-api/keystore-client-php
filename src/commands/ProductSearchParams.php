<?php

namespace keystore\commands;


use keystore\helpers\Assert;

/**
 * Поисковые параметры товаров
 *
 * Class ProductSearch
 * @package keystore\commands
 */
class ProductSearchParams extends PaginationParams
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
     * @var string|null
     */
    protected $description;

    /**
     * @var int|null
     */
    protected $groupId;

    /**
     * @var bool|null
     */
    protected $onlyInStock;

    /**
     * @var bool|null
     */
    protected $onlyExclusive;

    /**
     * @param array $ids
     * @return ProductSearchParams
     */
    public function setIds($ids)
    {
        Assert::integers("IDS", $ids);
        $this->ids = $ids;

        return $this;
    }

    /**
     * @param int|null $categoryId
     * @return ProductSearchParams
     */
    public function setCategoryId($categoryId)
    {
        if ($categoryId !== null) {
            Assert::integer("Category ID", $categoryId);
        }
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @param string|null $name
     * @return ProductSearchParams
     */
    public function setName($name)
    {
        if ($name !== null) {
            Assert::string("Name", $name);
        }
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $description
     * @return ProductSearchParams
     */
    public function setDescription($description)
    {
        if ($description !== null) {
            Assert::string("Description", $description);
        }
        $this->description = $description;

        return $this;
    }

    /**
     * @param int|null $groupId
     * @return ProductSearchParams
     */
    public function setGroupId($groupId)
    {
        if ($groupId !== null) {
            Assert::integer("Group ID", $groupId);
        }
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @param bool|null $onlyInStock
     * @return ProductSearchParams
     */
    public function setOnlyInStock($onlyInStock)
    {
        Assert::boolean("Only In Stock", $onlyInStock);
        $this->onlyInStock = $onlyInStock;

        return $this;
    }

    /**
     * @param bool|null $onlyExclusive
     * @return ProductSearchParams
     */
    public function setOnlyExclusive($onlyExclusive)
    {
        Assert::boolean("Only Exclusive", $onlyExclusive);
        $this->onlyExclusive = $onlyExclusive;

        return $this;
    }
}