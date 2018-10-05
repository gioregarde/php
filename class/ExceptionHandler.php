<?php 

require_once 'Logger.php';

/**
 * ExceptionHandler.php
 * 
 * Class for handling exception
 *
 * @author gio regarde <gioregarde@outlook.com>
 */
class ExceptionHandler {

    const DEFAULT_FALLBACK = 'http://localhost/';

    var $logger;
    var $fallback;

    /**
     * initialize variables
     *
     * @param string $log_path - file location path for logging
     * @param string $fallback - fallback url
     * @return null
     */
    function __construct($log_path = null, $fallback = self::DEFAULT_FALLBACK) {
        $this->logger = new Logger($log_path);
        $this->fallback = $fallback;
        set_exception_handler(array($this, 'exception_handler'));
    }

    /**
     * handles all thrown exceptions and redirect to fallback url
     *
     * @param object $exception - thrown exceptions
     * @return null
     */
    function exception_handler($exception) {
        $this->logger->error("Uncaught exception: ".$exception->getMessage());
        header('Location: '.$this->fallback);
        exit;
    }

}

?>