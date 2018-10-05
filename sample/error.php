<?php

    require_once '../class/ExceptionHandler.php';
    require_once '../class/ErrorHandler.php';

    $exception_handler = new ExceptionHandler($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/php/sample/log/logs.txt', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']);
    $error_handler = new ErrorHandler($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/php/sample/log/logs.txt', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']);

    if (isset($_GET) && !empty($_GET['mode'])) {
        switch ($_GET['mode']) {
            case 'error' : trigger_error("Triggered Error"); break;
            case 'exception' : throw new Exception('Uncaught Exception');; break;
            case 'fatal' : undefinedFunction(); break;
            default: trigger_error("Default Error"); break;
        }
        echo $_GET['mode'];
    } else {
        echo '<h3>Error and Exception handling with logs<h3>';
        echo '<ul>';
        echo '<li><a href="?mode=error">trigger error</a></li>';
        echo '<li><a href="?mode=exception">throw exception</a></li>';
        echo '<li><a href="?mode=fatal">trigger fatal error</a></li>';
        echo '<ul>';
    }



?>