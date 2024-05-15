<?php

namespace keystore\entities;

use keystore\contracts\ArraySerializer;

/**
 * Базовый объект
 *
 * Class AbstractObject
 * @package keystore\entities
 */
abstract class AbstractObject implements ArraySerializer
{
    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->_setProperties($data);
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $data)
    {
        $data = array_filter($data, static function ($value) {
            return $value !== null;
        });

        return new static($data);
    }

    /**
     * Установка атрибута
     *
     * @param $attribute
     * @param $value
     * @return void
     */
    private function _setProperty($attribute, $value)
    {
        $attribute = ucwords(str_replace('_', ' ', $attribute));
        $attribute = str_replace(' ', '', $attribute);
        $attribute = lcfirst($attribute);
        $setter = 'set' . ucfirst($attribute);

        if (method_exists($this, $setter) === true) {
            $this->$setter($value);
        } elseif (property_exists($this, $attribute) === true) {
            $this->$attribute = $value;
        } elseif (is_array($value) === true) {
            $this->_setProperties($value);
        }
    }

    /**
     * Установка атрибутов
     *
     * @param array $attributes
     * @return void
     */
    private function _setProperties($attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->_setProperty($attribute, $value);
        }
    }
}