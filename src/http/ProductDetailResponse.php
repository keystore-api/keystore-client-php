<?php

namespace keystore\http;

use keystore\contracts\ProductDetailInterface;
use keystore\entities\CategoryItem;
use keystore\entities\GroupItem;

/**
 * @inheritDoc
 *
 * Class ProductDetailResponse
 * @package keystore\http
 */
class ProductDetailResponse extends AbstractHttpResponse implements ProductDetailInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $miniature;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $manual;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var int
     */
    protected $minimumOrder;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var int
     */
    protected $purchaseCounter;

    /**
     * @var int
     */
    protected $view;

    /**
     * @var GroupItem
     */
    protected $group;

    /**
     * @var CategoryItem
     */
    protected $category;

    /**
     * @var string
     */
    protected $url;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getMiniature()
    {
        return $this->miniature;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getManual()
    {
        return $this->manual;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getMinimumOrder()
    {
        return $this->minimumOrder;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getPurchaseCounter()
    {
        return $this->purchaseCounter;
    }

    /**
     * @return int
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @return GroupItem
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @return CategoryItem
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param array $data
     */
    protected function setGroup($data)
    {
        $this->group = GroupItem::fromArray($data);
    }

    /**
     * @param array $data
     */
    protected function setCategory($data)
    {
        $this->category = CategoryItem::fromArray($data);
    }

    /**
     * @param string|float $value
     */
    protected function setPrice($value)
    {
        $this->price = (float)$value;
    }

    /**
     * @param int|null $value
     */
    protected function setPurchaseCounter($value)
    {
        $this->purchaseCounter = $value ?: 0;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
