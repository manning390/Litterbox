<?php

namespace App\Enums;

abstract class Enum {

    private static $constCacheArray = NULL;

    private static function getConstants(){
        if(self::$constCacheArray == NULL)
            self::$constCacheArray = [];

        $calledClass = get_called_class();
        if(!array_key_exists($calledClass, self::$constCacheArray)){
            $reflection = new \ReflectionClass(get_called_class());
            self::$constCacheArray[$calledClass] = $reflection->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    public static function getKeys(){
        return self::getConstants();
    }

    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value, $strict = true) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict);
    }
}