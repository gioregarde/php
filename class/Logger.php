<?php 

/**
 * Logger.php
 * 
 * Class for logging messages
 * openlog default location /var/log/system.log
 *
 * @author gio regarde <gioregarde@outlook.com>
 */
class Logger {

    const DEBUG_NAME = 'System';
    const DEBUG_LEVEL_ERR = 0;
    const DEBUG_LEVEL_WARN = 1;
    const DEBUG_LEVEL_INFO = 2;
    const DEBUG_LEVEL_DEBUG = 3;
    const DEFAULT_DEBUG_LEVEL = 5;

    var $log_path;
    var $debug_level;

    /**
     * initialize variables
     *
     * @param string $log_path - file location path for logging
     * @param int $debug_level
     * @return null
     */
    function __construct($log_path = null, $debug_level = self::DEFAULT_DEBUG_LEVEL) {
        $this->debug_level = $debug_level;

        if (isset($log_path) && !empty($log_path)) {
            $this->log_path = $log_path;
        } else {
            openlog(self::DEBUG_NAME, LOG_PERROR, LOG_SYSLOG);
            register_shutdown_function('closelog');
        }
    }

    /**
     * write error log
     *
     * @param object $data - data contents
     * @return null
     */
    function error($data) {
        $this->write(self::DEBUG_LEVEL_ERR, $data);
    }

    /**
     * write warning log
     *
     * @param object $data - data contents
     * @return null
     */
    function warning($data) {
        $this->write(self::DEBUG_LEVEL_WARN, $data);
    }

    /**
     * write info log
     *
     * @param object $data - data contents
     * @return null
     */
    function info($data) {
        $this->write(self::DEBUG_LEVEL_INFO, $data);
    }

    /**
     * write debug log
     *
     * @param object $data - data contents
     * @return null
     */
    function debug($data) {
        $this->write(self::DEBUG_LEVEL_DEBUG, $data);
    }

    /**
     * common function that writes to the log path by debug level
     *
     * @param int $level    - log level
     * @param object $data  - data contents
     * @return null
     */
    private function write($level, $data) {
        if ($level <= $this->debug_level) {
            switch ($level) {
                case self::DEBUG_LEVEL_ERR:
                    $priority = LOG_ERR;
                    $priority_message = '[error]';
                    break;
                case self::DEBUG_LEVEL_WARN:
                    $priority = LOG_WARNING;
                    $priority_message = '[warning]';
                    break;
                case self::DEBUG_LEVEL_INFO:
                    $priority = LOG_INFO;
                    $priority_message = '[info]';
                    break;
                case self::DEBUG_LEVEL_DEBUG:
                    $priority = LOG_DEBUG;
                    $priority_message = '[debug]';
                    break;
                default:
                    $priority = LOG_DEBUG;
                    $priority_message = '[debug]';
            }

            if (isset($this->log_path) && !empty($this->log_path)) {
                file_put_contents($this->log_path, date('Y-m-d H:i:s').' '.$priority_message.' '.print_r($data, true).PHP_EOL, FILE_APPEND);
            } else {
                syslog($priority, $data);
            }
        }
    }

}

?>