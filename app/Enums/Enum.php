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

    public static function getKeysInverse(){
        return array_flip(self::getKeys());
    }

    public static function getKey(string $enum, callable $callback = null){
        if(!self::isvalidValue($enum, true)) throw new EnumException(get_class($this)." doesn't contain $enum as valid value.");
        $key = array_search($enum, self::getKeys());
        return is_callable($callback)? $callback($key) : $key;
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

    public static function validate($attribute, $value, $parameters, $validator){
        $class = 'App\\Enums\\'.$parameters[0];
        return collect(call_user_func($class, 'getKeys'))->contains($value);
    }
}