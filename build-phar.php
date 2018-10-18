<?php

    /**
     * Notes :
     *   - set php.ini (phar.readonly = 0)
     *   - execute: php build-phar.php
     *
     * How to Load :
     *   - require_once('phar://../output/php.phar');
     *   - require_once('phar://../output/php.phar.gz');
     */

    $phar_path    = '../output/php.phar';
    $phar_path_gz = $phar_path.'.gz';
    $stub         = 'DefaultStub.php'; // class loader
    $class_path   = '../class/'; // class path

    if (file_exists($phar_path) && !unlink($phar_path)) {
        echo ('Error deleting '.$phar_path);
        exit();
    }
    if (file_exists($phar_path_gz) && !unlink($phar_path_gz)) {
        echo ('Error deleting '.$phar_path_gz);
        exit();
    }

    $phar = new Phar($phar_path);
    $phar->setDefaultStub($stub, $stub);
    $phar->buildFromDirectory($class_path);
    $phar->compress(Phar::GZ);

?>