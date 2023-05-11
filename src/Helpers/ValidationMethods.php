<?php
/**
 * Validation methods
 *
 * @since 1.0.0
 */

namespace Svorm\Helpers;

class ValidationMethods
{
    /**
     * Is value of type string?
     * 
     * @param mixed $value Value which have to be checked.
     * 
     * @return boolean True if is of type string, false if not.
     * 
     * @since 1.0.0
     */
    public static function isString($value)
    {
        return is_string($value);
    }

    /**
     * Is value containing only letters?
     * 
     * @param mixed $value Value which have to be checked.
     * 
     * @return boolean True if is only containing letters, false if not.
     * 
     * @since 1.0.0
     */
    public static function letters($value)
    {
        return ctype_alpha($value);
    }

    /**
     * Is value of type int?
     * 
     * @param mixed $value Value which have to be checked.
     * 
     * @return boolean True if is of type int, false if not.
     * 
     * @since 1.0.0
     */
    public static function isInt($value)
    {
        return is_int($value);
    }

    /**
     * Is value of type number?
     * 
     * @param mixed $value Value which have to be checked.
     * 
     * @return boolean True if is of type number, false if not.
     * 
     * @since 1.0.0
     */
    public static function isNumber($value)
    {
        return is_numeric(str_replace(',', '.', $value));
    }

    /**
     * Is value of type string?
     * 
     * @param mixed $value Value which have to be checked.
     * 
     * @return boolean True if is of type string, false if not.
     * 
     * @since 1.0.0
     */
    public static function isEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Is number not under min?
     * 
     * @param int|float $value Value which have to be checked.
     * @param int|float $min   Min number.
     * 
     * @return boolean True if number not under min.
     * 
     * @since 1.0.0
     */
    public static function min($value, $min)
    {
        return $value >= $min;
    }

    /**
     * Is number not over max?
     * 
     * @param int|float $value Value which have to be checked.
     * @param int|float $max   Max number.
     * 
     * @return boolean True if number not over max.
     * 
     * @since 1.0.0
     */
    public static function max($value, $max)
    {
        return $value <= $max;
    }

    /**
     * Is string not under min length?
     * 
     * @param string $value Value which have to be checked.
     * @param int    $min   Min number of chars.
     * 
     * @return boolean True if string length is not under min length.
     * 
     * @since 1.0.0
     */
    public static function minLength($value, $min)
    {
        return strlen($value) >= $min;
    }

    /**
     * Is string not over max length?
     * 
     * @param string $value Value which have to be checked.
     * @param int    $max   Max number of chars.
     * 
     * @return boolean True if string length is not over max length.
     * 
     * @since 1.0.0
     */
    public static function maxLength($value, $max)
    {
        return strlen($value) <= $max;
    }

    /**
     * Is value empty?
     * 
     * @param  mixed $value Value which have to be checked.
     * 
     * @return boolean True if is empty, false if not.
     * 
     * @since 1.0.0
     */
    public static function isEmpty($value)
    {
        return trim($value) === '';
    }

    /**
     * Is value in array?
     * 
     * @param mixed $value  Needle.
     * @param array $values Haystack.
     * 
     * @return boolean True if found, false if not.
     * 
     * @since 1.0.0
     */
    public static function inArray($value, $values)
    {
        return in_array($value, $values, true);
    }

    /**
     * Checks if value is checked
     * 
     * @param mixed $value Value of the field.
     * 
     * @return boolean True if is checked, false if not.
     * 
     * @since 1.0.0
     */
    public static function isChecked($value)
    {
        return $value == true;
    }
}
