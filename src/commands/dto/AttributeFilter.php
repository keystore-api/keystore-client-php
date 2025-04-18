<?php

namespace keystore\commands\dto;

use keystore\helpers\Assert;

class AttributeFilter
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var bool|float|int|string
     */
    private $value;
    /**
     * @var string
     */
    private $filter_type;

    /**
     * @param int $id ID атрибута
     * @param scalar $value Значение атрибута
     * @param string $filter_type Тип фильтра: include - включить в выборку товары, имеющие атрибуты с заданным значением
     *                              exclude - исключить из выборки товары, имеющие атрибуты с заданным значением
     */
    public function __construct($id, $value, $filter_type)
    {
        Assert::integer("ID", $id);
        Assert::isScalar("Value", $value);
        Assert::string("Filter Type", $filter_type);
        Assert::isOneOf("Filter Type", $filter_type, ['include', 'exclude']);

        $this->id = $id;
        $this->value = $value;
        $this->filter_type = $filter_type;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool|float|int|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getFilterType()
    {
        return $this->filter_type;
    }


}