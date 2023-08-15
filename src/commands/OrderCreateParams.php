<?php

namespace keystore\commands;

use keystore\helpers\Assert;

/**
 * Параметры создания товара
 *
 * Class OrderCreateParams
 * @package keystore\commands
 */
class OrderCreateParams extends AbstractRequestParams
{
    /**
     * @var int
     */
    protected $product;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var string|null
     */
    protected $promoCode;

    /**
     * @var bool
     */
    protected $sendEmailCopy;

    /**
     * @param int $productId
     * @param int $quantity
     */
    public function __construct($productId, $quantity)
    {
        Assert::integer("Product ID", $productId);
        Assert::integer("Quantity", $productId);

        $this->product = $productId;
        $this->quantity = $quantity;
    }

    /**
     * @param string|null $promoCode
     * @return OrderCreateParams
     */
    public function setPromoCode($promoCode)
    {
        if ($promoCode !== null) {
            Assert::string("Promo Code", $promoCode);
        }
        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * @param bool $sendEmailCopy
     * @return OrderCreateParams
     */
    public function setSendEmailCopy($sendEmailCopy)
    {
        Assert::boolean("Send Email Copy", $sendEmailCopy);
        $this->sendEmailCopy = $sendEmailCopy;

        return $this;
    }
}
