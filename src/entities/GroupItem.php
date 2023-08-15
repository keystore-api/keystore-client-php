<?php

namespace keystore\entities;

/**
 * Элемент группы
 *
 * Class GroupItem
 * @package keystore\entities
 */
class GroupItem extends AbstractObject
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
     * @var int
     */
    protected $categoryId;

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
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }
}