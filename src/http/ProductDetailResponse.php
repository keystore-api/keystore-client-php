<?php

namespace keystore\http;

use keystore\contracts\ProductDetailInterface;
use keystore\entities\AttributeItem;
use keystore\entities\CategoryItem;
use keystore\entities\GroupItem;
use keystore\entities\ProductAttributeValue;

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
     * @var float
     */
    protected $rating;

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
     * @var int
     */
    protected $isManualOrderDelivery;

    /**
     * @var int
     */
    protected $guaranteeTimeSeconds;

    /**
     * @var int|null
     */
    protected $invalid_items_percent;

    /**
     * @var string
     */
    protected $replacementTermsPublic;

    /**
     * @var ProductAttributeValue[]
     */
    protected $attributes;

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
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
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
     * @return int
     */
    public function getIsManualOrderDelivery()
    {
        return $this->isManualOrderDelivery;
    }

    /**
     * @return int
     */
    public function getGuaranteeTimeSeconds()
    {
        return $this->guaranteeTimeSeconds;
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
     * @param string|float $value
     */
    protected function setRating($value)
    {
        $this->rating = (float)$value;
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

    /**
     * @param AttributeItem[] $value
     */
    protected function setAttributes($value)
    {
        $this->attributes = $value;
    }

    /**
     * @return ProductAttributeValue[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param int|null $value
     */
    public function setIsManualOrderDelivery($value)
    {
        $this->isManualOrderDelivery = $value;
    }

    /**
     * @param int|null $value
     */
    public function setGuaranteeTimeSeconds($value)
    {
        $this->guaranteeTimeSeconds = $value;
    }

    /**
     * @return string
     */
    public function getReplacementTermsPublic()
    {
        return $this->replacementTermsPublic;
    }

    /**
     * @return int|null
     */
    public function getInvalidItemsPercent()
    {
        return $this->invalid_items_percent;
    }

    /**
     * @param int|null $invalid_items_percent
     */
    public function setInvalidItemsPercent($invalid_items_percent)
    {
        $this->invalid_items_percent = $invalid_items_percent;
    }
}
