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
            throw new InvalidArgumentException("$attribute must be between 1 and 1000");
        }
    }
}
