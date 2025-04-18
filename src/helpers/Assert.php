<?php

namespace keystore\helpers;

use InvalidArgumentException;

/**
 * Проверка параметра
 *
 * Class Assert
 * @package \keystore\helpers
 */
class Assert
{
    /**
     * Assert constructor.
     */
    private function __construct()
    {
    }

    /**
     * Число
     *
     * @param $attribute
     * @param $value
     * @return void
     */
    public static function number($attribute, $value)
    {
        if (is_numeric($value) === false) {
            throw new InvalidArgumentException("$attribute must be a number");
        }
    }

    /**
     * Целое число
     *
     * @param $attribute
     * @param $value
     * @return void
     */
    public static function integer($attribute, $value)
    {
        if (is_integer($value) === false) {
            throw new InvalidArgumentException("$attribute must be a integer");
        }
    }

    /**
     * Массив целых чисел
     *
     * @param $attribute
     * @param $value
     * @return void
     */
    public static function integers($attribute, $value)
    {
        if (is_array($value) === false) {
            throw new InvalidArgumentException("$attribute must be a array");
        }
        foreach ($value as $item) {
            self::integer($attribute, $item);
        }
    }

    /**
     * Логическое
     *
     * @param $attribute
     * @param $value
     * @return void
     */
    public static function boolean($attribute, $value)
    {
        if (is_bool($value) === false) {
            throw new InvalidArgumentException("$attribute must be a boolean");
        }
    }

    /**
     * Не строгое логическое
     *
     * @param $attribute
     * @param $value
     * @return void
     */
    public static function unStrictBoolean($attribute, $value)
    {
        if (
            is_bool($value) === false &&
            in_array($value, [0, 1]) === false
        ) {
            throw new InvalidArgumentException("$attribute must be a boolean or integer (1 or 0)");
        }
    }

    /**
     * Строка
     *
     * @param $attribute
     * @param $value
     * @return void
     */
    public static function string($attribute, $value)
    {
        if (is_string($value) === false) {
            throw new InvalidArgumentException("$attribute must be a string");
        }
    }

    /**
     * Диапазон значений
     *
     * @param $attribute
     * @param $value
     * @param int|float $start
     * @param int|float $end
     * @return void
     */
    public static function range($attribute, $value, $start, $end)
    {
        self::number($attribute, $start);
        self::number($attribute, $end);

        if ($value > $end || $value < $start) {
            throw new InvalidArgumentException("$attribute must be between $start and $end");
        }
    }

    /**
     * Массив
     *
     * @param $attribute
     * @param $value
     * @return void
     */
    public static function isArray($attribute, $value)
    {
        if (is_array($value) === false) {
            throw new InvalidArgumentException("$attribute must be an array");
        }
    }

    /**
     * Скалярное значение
     *
     * @param $attribute
     * @param $value
     * @return void
     */
    public static function isScalar($attribute, $value)
    {
        if (is_scalar($value) === false) {
            throw new InvalidArgumentException("$attribute must be a scalar value");
        }
    }

    /**
     * Значение входит в список доступных значений
     *
     * @param string $attribute
     * @param scalar $value
     * @param array $availableValues
     * @return void
     * @throws InvalidArgumentException
     */
    public static function isOneOf($attribute, $value, $availableValues)
    {
        self::isScalar($attribute, $value);
        self::isArray($attribute, $availableValues);

        if (in_array($value, $availableValues, true) === false){
            throw new InvalidArgumentException("Value of $attribute is not in available values");
        }
    }

    /**
     * Значение больше или равно указанному
     * @param string $attribute
     * @param numeric $value
     * @param numeric $min
     * @return void
     */
    public static function greaterOrEqual($attribute, $value, $min)
    {
        self::number($attribute, $value);
        self::number($attribute, $min);

        if ($value < $min) {
            throw new InvalidArgumentException("$attribute must be greater or equal than $min");
        }
    }

    /**
     * Значение меньше или равно указанному
     * @param string $attribute
     * @param numeric $value
     * @param numeric $max
     * @return void
     */
    public static function lessOrEqual($attribute, $value, $max)
    {
        self::number($attribute, $value);
        self::number($attribute, $max);

        if ($value > $max) {
            throw new InvalidArgumentException("$attribute must be less or equal than $max");
        }
    }

    /**
     * @param string $attribute
     * @param array $values
     * @param class-string $class
     * @return void
     */
    public static function allInstanceOf($attribute, $values, $class)
    {
        self::isArray($attribute, $values);
        self::string("Class", $class);

        foreach ($values as $value) {
            if (is_a($value, $class, true) === false) {
                throw new InvalidArgumentException("$attribute must be an instance of $class");
            }
        }
    }
}
