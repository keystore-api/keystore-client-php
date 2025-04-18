<?php

namespace keystore\entities;

/**
 * Значение атрибута товара
 *
 * Class ProductAttributeValue
 * @package keystore\entities
 */
class ProductAttributeValue extends AbstractObject
{
    /**
     * @var int
     */
    protected $attributeId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var scalar
     */
    protected $value;

    /**
     * @var int|null
     */
    protected $valueId;

    /**
     * @return int
     */
    public function getAttributeId()
    {
        return $this->attributeId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return scalar
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int|null
     */
    public function getValueId()
    {
        return $this->valueId;
    }

}