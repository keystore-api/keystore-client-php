<?php

namespace keystore\entities;

use keystore\contracts\ArraySerializer;

/**
 * Базовый объект
 *
 * Class AbstractObject
 * @package keystore\entities
 */
abstract class AbstractObject implements ArraySerializer, \ArrayAccess
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
        $property = $this->getPropertyNameByAttribute($attribute);
        $setter = $this->getAttributeSetter($attribute);

        if (method_exists($this, $setter) === true) {
            $this->$setter($value);
        } elseif (property_exists($this, $property) === true) {
            $this->$property = $value;
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

    public function offsetExists($offset)
    {
        return method_exists($this, $this->getAttributeGetter($offset));
    }

    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)){
            throw new \InvalidArgumentException("Unknown offset {$offset}");
        }
        return $this->{$this->getAttributeGetter($offset)}();
    }

    public function offsetSet($offset, $value)
    {
        if (!$this->offsetExists($offset)){
            throw new \InvalidArgumentException("Unknown offset {$offset}");
        }

        $setter = $this->getAttributeSetter($offset);
        if (method_exists($this, $setter) === true) {
            $this->$setter($value);
        } elseif (property_exists($this, $offset) === true) {
            $this->$offset = $value;
        } elseif (is_array($value) === true) {
            $this->_setProperties($value);
        }

        return $this->{$this->getAttributeSetter($offset)}($value);
    }

    public function offsetUnset($offset)
    {
        if (!$this->offsetExists($offset)){
            throw new \InvalidArgumentException("Unknown offset {$offset}");
        }
        return $this->{$this->getAttributeSetter($offset)}(null);
    }

    /**
     * @param string $attribute
     * @return string
     */
    private function getAttributeGetter($attribute)
    {
        return 'get' . ucfirst($this->getPropertyNameByAttribute($attribute));
    }

    /**
     * @param string $attribute
     * @return string
     */
    private function getAttributeSetter($attribute)
    {
        return 'set' . ucfirst($this->getPropertyNameByAttribute($attribute));
    }

    /**
     * @param string $attribute
     * @return string
     */
    private function getPropertyNameByAttribute($attribute)
    {
        $attribute = ucwords(str_replace('_', ' ', $attribute));
        $attribute = str_replace(' ', '', $attribute);
        return lcfirst($attribute);
    }
}