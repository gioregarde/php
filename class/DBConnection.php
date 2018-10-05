<?php

/**
 * DBConnection.php
 *
 * @author gio regarde <gioregarde@outlook.com>
 */
class DBConnection {

    private static $isTransaction = false;

    const DB_HOST = '';
    const DB_NAME = '';
    const DB_USER = '';
    const DB_PASS = '';

    /**
     * get database connection
     *
     * @return object $con - PDO connection
     */
    private static function getConnection() {
        static $con;
        if (!isset($con)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $con = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME, self::DB_USER, self::DB_PASS, $pdo_options);
        }
        return $con;
    }

    /**
     * executes sql script
     *
     * @return object $ps - sql script result
     */
    public static function sql($statement, $values = null) {
        $ps = self::getConnection()->prepare($statement);
        if ($values) {
            $ps->execute($values);
        } else {
            $ps->execute();
        }
        return $ps;
    }

    /**
     * get id
     *
     * @return int - id
     */
    public static function getInsertedIndex() {
        return self::getConnection()->lastInsertId();
    }

    /**
     * begin database transaction
     *
     * @return null
     */
    public static function beginTransaction() {
        if (!self::$isTransaction) {
            self::getConnection()->beginTransaction();
            self::$isTransaction = true;
        }
    }

    /**
     * end database transaction
     *
     * @return null
     */
    public static function endTransaction() {
        if (self::$isTransaction) {
            try {
                self::getConnection()->commit();
            } catch (Exception $e) {
                self::getConnection()->rollBack();
                error($e);
            }
            self::$isTransaction = false;
        }
    }

}

?>
