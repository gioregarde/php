<?php 

/**
 * ObjectUtil.php
 * 
 * Utility class for object manipulation (uses Reflection)
 * http://php.net/reflection
 *
 * @author gio regarde <gioregarde@outlook.com>
 */
class ObjectUtil {

    const METHOD_GET = 'get';
    const METHOD_SET = 'set';

    /**
     * check if empty object properties
     * TODO method for boolean (is)
     *
     * @param object $object
     * @param boolean $greedy
     * @return boolean $isBlank
     */
    static function isBlank($object, $greedy = true) {
        $isBlank = true;
        if (!is_object($object)) {
            return $isBlank;
        }
        $object_ref = new ReflectionObject($object);

        foreach ($object_ref->getProperties(ReflectionProperty::IS_PUBLIC) as $prop) {
            if (!empty($prop->getValue($object))) {
                if ($greedy && is_object($prop->getValue($object))) {
                    return $isBlank && self::isBlank($prop->getValue($object), $greedy);
                }
                return false;
            }
        }

        foreach ($object_ref->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if (strpos($method->getName(), self::METHOD_GET) === false) {
                 continue;
            }
            $prop = lcfirst(substr($method->getName(), 3));

            if ($object_ref->hasProperty($prop) && $object_ref->getProperty($prop)->isPrivate()) {
                if (!empty($method->invoke($object))) {
                    if ($greedy && is_object($method->invoke($object))) {
                        return $isBlank && self::isBlank($method->invoke($object), $greedy);
                    }
                    return false;
                }
            }
        }

        return $isBlank;
    }

    /**
     * copy object property values
     * TODO method for boolean (is)
     *
     * @param object $dest - object destination
     * @param object $src  - object source
     * @return null
     */
    static function copy(&$dest, $src) {
        if (!is_object($dest) || !is_object($src) ) {
            return;
        }

        $dest_ref = new ReflectionObject($dest);
        $src_ref = new ReflectionObject($src);

        foreach ($src_ref->getProperties(ReflectionProperty::IS_PUBLIC) as $prop) {
            $set_method = self::METHOD_SET.ucfirst($prop->getName());
            if ($dest_ref->hasProperty($prop->getName()) && $dest_ref->getProperty($prop->getName())->isPublic()) {
                $dest->{$prop->getName()} = $prop->getValue($src);
            } else if ($dest_ref->hasMethod($set_method)) {
                $dest->{$set_method}($prop->getValue($src));
            }
        }

        foreach ($src_ref->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if (strpos($method->getName(), self::METHOD_GET) === false) {
                continue;
            }
            $base_method = substr($method->getName(), 3);
            $set_method = self::METHOD_SET.$base_method;
            $prop = lcfirst($base_method);
            if ($dest_ref->hasMethod($set_method) && $dest_ref->getMethod($set_method)->isPublic()) {
                $dest->{$set_method}($method->invoke($src));
            } else if ($dest_ref->hasProperty($prop) && $dest_ref->getProperty($prop)->isPublic()) {
                $dest->{$prop} = $method->invoke($src);
            }
        }
    }

}

?>