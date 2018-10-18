<?php

    // autoLoad all classes inside phar
    $archive = new Phar(substr(__DIR__, 7));
    foreach (new RecursiveIteratorIterator($archive) as $file) {
        if (strpos($file, __FILE__) !== false) {
            continue;
        }
        $class_name = str_replace(__DIR__.'/', '', $file);
        require_once($class_name);
    }

?>