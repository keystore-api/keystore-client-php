<?php

namespace keystore\contracts;

use keystore\entities\AttributeItem;
use keystore\entities\CategoryItem;
use keystore\entities\GroupItem;

/**
 * Информация о товаре
 *
 * Class ProductDetailInterface
 * @package keystore\contract
 */
interface ProductDetailInterface extends ResultInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getMiniature();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getManual();

    /**
     * @return float
     */
    public function getPrice();

    /**
     * @return int
     */
    public function getMinimumOrder();

    /**
     * @return int
     */
    public function getQuantity();

    /**
     * @return int|null
     */
    public function getPurchaseCounter();

    /**
     * @return int
     */
    public function getView();

    /**
     * @return GroupItem
     */
    public function getGroup();

    /**
     * @return CategoryItem
     */
    public function getCategory();

    /**
     * @return AttributeItem[]
     */
    public function getAttributes();

    /**
     * @return float
     */
    public function getRating();

    /**
     * @return int
     */
    public function getIsManualOrderDelivery();

    /**
     * @return int
     */
    public function getGuaranteeTimeSeconds();

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return string
     */
    public function getReplacementTermsPublic();

    /**
     * @return int|null
     */
    public function getInvalidItemsPercent();

}
