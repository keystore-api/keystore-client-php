<?php

namespace keystore\entities;

/**
 * Элемент атрибута
 *
 * Class AttributeItem
 * @package keystore\entities
 */
class AttributeItem extends AbstractObject
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
    protected $type;

    /**
     * @var string
     */
    protected $filterName;

    /**
     * @var string
     */
    protected $filterDescription;

    /**
     * @var null|array
     */
    protected $items;

    /**
     * @var null|array
     */
    protected $groups;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getFilterName()
    {
        return $this->filterName;
    }

    /**
     * @return string
     */
    public function getFilterDescription()
    {
        return $this->filterDescription;
    }

    /**
     * @return null|array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return null|array
     */
    public function getGroups()
    {
        return $this->groups;
    }
}