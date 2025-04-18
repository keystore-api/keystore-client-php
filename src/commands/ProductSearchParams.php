<?php

namespace keystore\commands;


use keystore\commands\dto\AttributeFilter;
use keystore\helpers\Assert;

/**
 * Поисковые параметры товаров
 *
 * Class ProductSearch
 * @package keystore\commands
 */
class ProductSearchParams extends PaginationParams
{
    const DELIVERY_TYPE_AUTO = 'auto';
    const DELIVERY_TYPE_MANUAL = 'manual';

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
     * @var string|null
     */
    protected $deliveryType;

    /**
     * @var integer|null
     */
    protected $minimumOrderFrom;

    /**
     * @var integer|null
     */
    protected $minimumOrderTo;

    /**
     * @var float|null
     */
    protected $priceFrom;

    /**
     * @var float|null
     */
    protected $priceTo;

    /**
     * @var float|null
     */
    protected $ratingFrom;

    /**
     * @var float|null
     */
    protected $ratingTo;

    /**
     * @var int|null
     */
    protected $quantityFrom;

    /**
     * @var int|null
     */
    protected $quantityTo;

    /**
     * @var array|null
     */
    protected $filterAttributes;

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
     * @param bool|int $onlyInStock
     * @return ProductSearchParams
     */
    public function setOnlyInStock($onlyInStock)
    {
        Assert::unStrictBoolean("Only In Stock", $onlyInStock);
        $this->onlyInStock = (bool)$onlyInStock;

        return $this;
    }

    /**
     * @param bool|int $onlyExclusive
     * @return ProductSearchParams
     */
    public function setOnlyExclusive($onlyExclusive)
    {
        Assert::unStrictBoolean("Only Exclusive", $onlyExclusive);
        $this->onlyExclusive = (bool)$onlyExclusive;

        return $this;
    }

    /**
     * @param string|null $deliveryType Одно из значений auto|manual
     * @return ProductSearchParams
     */
    public function setDeliveryType($deliveryType)
    {
        if ($deliveryType !== null) {
            Assert::string("Delivery Type", $deliveryType);
            $deliveryType = strtolower($deliveryType);
            Assert::isOneOf("Delivery Type", $deliveryType, [self::DELIVERY_TYPE_AUTO, self::DELIVERY_TYPE_MANUAL]);
        }
        $this->deliveryType = $deliveryType;

        return $this;

    }

    /**
     * Фильтр по полю "minimum_order" (минимальное количество к заказу)
     * @param int|null $minimumOrderFrom
     * @param int|null $minimumOrderTo
     * @return $this
     */
    public function setOrderCountRange($minimumOrderFrom , $minimumOrderTo = null)
    {
        if ($minimumOrderFrom !== null) {
            Assert::integer("Minimum Order From", $minimumOrderFrom);
            Assert::greaterOrEqual("Minimum Order From", $minimumOrderFrom, 1);
        }
        if ($minimumOrderTo !== null) {
            Assert::integer("Minimum Order To", $minimumOrderTo);
            Assert::greaterOrEqual("Minimum Order To", $minimumOrderTo, 1);
        }
        if($minimumOrderFrom !== null && $minimumOrderTo !== null){
            Assert::greaterOrEqual("Minimum Order To", $minimumOrderTo, $minimumOrderFrom);
            Assert::range("Order Count Range", $minimumOrderFrom, $minimumOrderFrom, $minimumOrderTo);
        }
        $this->minimumOrderFrom = $minimumOrderFrom;
        $this->minimumOrderTo = $minimumOrderTo;

        return $this;
    }

    /**
     * Фильтр по полю "price" (цена)
     * @param float|null $priceFrom
     * @param float|null $priceTo
     * @return $this
     */
    public function setPriceRange($priceFrom , $priceTo = null)
    {
        if ($priceFrom !== null) {
            Assert::number("Price From", $priceFrom);
            Assert::greaterOrEqual("Price From", $priceFrom, 0.01);
        }
        if ($priceTo !== null) {
            Assert::number("Price To", $priceTo);
            Assert::greaterOrEqual("Price To", $priceTo, 0.01);
        }
        if($priceFrom !== null && $priceTo !== null){
            Assert::greaterOrEqual("Price To", $priceTo, $priceFrom);
            Assert::range("Price Range", $priceFrom, $priceFrom, $priceTo);
        }
        $this->priceFrom = (float)$priceFrom;
        $this->priceTo = (float)$priceTo;

        return $this;
    }

    /**
     * Фильтр по полю "rating" (рейтинг товара от 1 до 5)
     * @param float|null $priceFrom
     * @param float|null $priceTo
     * @return $this
     */
    public function setRatingRange($ratingFrom , $ratingTo = null)
    {
        if ($ratingFrom !== null) {
            Assert::number("Rating From", $ratingFrom);
            Assert::greaterOrEqual("Rating From", $ratingFrom, 1);
            Assert::lessOrEqual("Rating From", $ratingFrom, 5);
        }
        if ($ratingTo !== null) {
            Assert::number("Rating To", $ratingTo);
            Assert::greaterOrEqual("Rating To", $ratingTo, 1);
            Assert::lessOrEqual("Rating To", $ratingTo, 5);
        }
        if($ratingFrom !== null && $ratingTo !== null){
            Assert::greaterOrEqual("Rating To", $ratingTo, $ratingFrom);
            Assert::range("Rating Range", $ratingFrom, $ratingFrom, $ratingTo);
        }
        $this->ratingFrom = (float)$ratingFrom;
        $this->ratingTo = (float)$ratingTo;

        return $this;
    }

    /**
     * Фильтр по полю "quantity" (количество товара, доступное к заказу)
     * @param int|null $minimumOrderFrom
     * @param int|null $minimumOrderTo
     * @return $this
     */
    public function setQuantityRange($quantityFrom , $quantityTo = null)
    {
        if ($quantityFrom !== null) {
            Assert::integer("Quantity From", $quantityFrom);
            Assert::greaterOrEqual("Quantity From", $quantityFrom, 1);
        }
        if ($quantityTo !== null) {
            Assert::integer("Quantity To", $quantityTo);
            Assert::greaterOrEqual("Quantity To", $quantityTo, 1);
        }
        if($quantityFrom !== null && $quantityTo !== null){
            Assert::greaterOrEqual("Quantity To", $quantityTo, $quantityFrom);
            Assert::range("Quantity Range", $quantityFrom, $quantityFrom, $quantityTo);
        }
        $this->quantityFrom = (float)$quantityFrom;
        $this->quantityTo = (float)$quantityTo;

        return $this;
    }

    /**
     * Установить фильтр по атрибутам товара
     * @param AttributeFilter[] $filterAttributes
     * @return $this
     */
    public function setFilterAttributes($filterAttributes)
    {
        if(empty($filterAttributes)) {
            $this->filterAttributes = null;
            return $this;
        }

        Assert::allInstanceOf("Filter Attributes", $filterAttributes, AttributeFilter::class);

        $this->filterAttributes = array_map(
            /**
             * @param AttributeFilter $attributeFilter
             * @return array
             */
            static function($attributeFilter){
                return [
                    'id' => $attributeFilter->getId(),
                    'value' => $attributeFilter->getValue(),
                    'filter_type' => $attributeFilter->getFilterType(),
                ];
            },
            $filterAttributes
        );
        return $this;
    }
}