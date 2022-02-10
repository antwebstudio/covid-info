<?php

class Ant {
    public static function bladeOption() {
        return func_get_args();
    }

    public static function setProperty($object, $propertyName, $value) {
  		$class = new \ReflectionClass($object);
  		$property = $class->getProperty($propertyName);
  		$property->setAccessible(true);
  		return $property->setValue($object, $value);
    }

    public static function getProperty($object, $propertyName) {
  		$class = new \ReflectionClass($object);
  		$property = $class->getProperty($propertyName);
  		$property->setAccessible(true);
  		return $property->getValue($object);
    }
}