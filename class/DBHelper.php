<?php

require_once 'DBConnection.php';

/**
 * DBHelper.php
 *
 * @author gio regarde <gioregarde@outlook.com>
 */
class DBHelper {

    /**
     * execute select statement
     *
     * @param string $statement - select query
     * @param array $values
     * @return array            - returns query result
     */
    static function select($statement, $values = null) {
        return DBConnection::sql($statement, $values)->fetchAll();
    }

    /**
     * execute select statement, returns 1 result
     *
     * @param string $statement - select query
     * @param array $values
     * @return array            - returns query result
     */
    static function selectOne($statement, $values = null) {
        return DBConnection::sql($statement, $values)->fetch();
    }

    /**
     * execute insert statement
     *
     * @param string $statement - insert query
     * @param array $values
     * @return int              - returns id
     */
    static function insert($statement, $values) {
        DBConnection::sql($statement, $values);
        return DBConnection::getInsertedIndex();
    }

    /**
     * execute update statement
     *
     * @param string $statement - update query
     * @param array $values
     * @return int              - returns number of rows  affected
     */
    static function update($statement, $values) {
        return DBConnection::sql($statement, $values)->rowCount();
    }

    /**
     * execute delete statement
     *
     * @param string $statement - delete query
     * @param array $values
     * @return int              - returns number of rows  affected
     */
    static function delete($statement, $values) {
        return DBConnection::sql($statement, $values)->rowCount();
    }

}

?>