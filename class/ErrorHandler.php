<?php 

require_once 'Logger.php';

/**
 * ErrorHandler.php
 *
 * Class for handling errors
 * 
 * @author gio regarde <gioregarde@outlook.com>
 */
class ErrorHandler {

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
        set_error_handler(array($this, 'error_handler'));
        register_shutdown_function(array($this, 'fatal_error_handler'));
    }

    /**
     * handles all errors and redirect to fallback url
     *
     * @param int $error_level      - error report level
     * @param string $error_message - error message
     * @param string $error_file    - filename in which the error occurred
     * @param int $error_line       - line number in which the error occurred
     * @return boolean true
     */
    function error_handler($error_level, $error_message, $error_file, $error_line) {
        if (error_reporting() & $error_level) {
            $this->logger->error($error_message);
            header('Location: '.$this->fallback);
            exit;
        }
        return true;
    }

    /**
     * handles all fatal errors and redirect to fallback url
     *
     * @return null
     */
    function fatal_error_handler() {
        $last_error = error_get_last();
        $this->logger->error($last_error);
        if ($last_error['type'] === E_ERROR) {
            header('Location: '.$this->fallback);
            exit;
        }
    }

}

?>