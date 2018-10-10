<?php

/** 
 * DateUtil.php
 * 
 * Class for date manipulation
 * 
 * @author gio regarde <gioregarde@outlook.com>
 * 
 * Format Reference
 * ╔════════╦════════════════════════════════════════════════════════════════╗
 * ║ Format ║            Description                                         ║
 * ╠════════╬════════════════════════════════════════════════════════════════╣
 * ║   a    ║ 'am' or 'pm' lowercase                                         ║
 * ║   A    ║ 'AM' or 'PM' uppercase                                         ║
 * ║   s    ║ seconds                                                        ║
 * ║   i    ║ Minutes(0-59)                                                  ║
 * ║   h    ║ Hour (12-hour format-leading zeroes)                           ║
 * ║   H    ║ Hour (24-hour format-leading zeroes)                           ║
 * ║   g    ║ Hour (12-hour format-no leading zeroes)                        ║
 * ║   G    ║ Hour (24-hour format-no leading zeroes)                        ║
 * ║   d    ║ Day of the month (leading zeroes)                              ║
 * ║   j    ║ Day of the month (no leading zeroes)                           ║
 * ║   l    ║ Day of the week                                                ║
 * ║   D    ║ Day of the week (three letters)                                ║
 * ║   z    ║ Day of the year (0-365)                                        ║
 * ║   m    ║ Month of the year (leading zeroes)                             ║
 * ║   n    ║ Month of the year (no leading zeroes)                          ║
 * ║   M    ║ Month of the year (three letters)                              ║
 * ║   F    ║ Month name January                                             ║
 * ║   y    ║ Year (two digits)                                              ║
 * ║   Y    ║ Year (four digits)                                             ║
 * ║   L    ║ Leap year ('1' for yes, '0' for no)                            ║
 * ║   U    ║ Time stamp                                                     ║
 * ║   r    ║ The RFC 2822 formatted date (Thu, 21 Dec 2000 16:01:07 +0200)  ║
 * ║   Z    ║ Offset in seconds from GMT +5                                  ║
 * ╚════════╩════════════════════════════════════════════════════════════════╝
 */
class DateUtil {

    const COMPARE_DATE_ERROR  = 0;
    const COMPARE_DATE_EQUAL  = 1;
    const COMPARE_DATE_AFTER  = 2;
    const COMPARE_DATE_BEFORE = 3;

    const MODE_ADD_DAYS       = 1;
    const MODE_SUB_DAYS       = 2;
    const MODE_ADD_MONTHS     = 3;
    const MODE_SUB_MONTHS     = 4;
    const MODE_ADD_YEARS      = 5;
    const MODE_SUB_YEARS      = 6;
    const MODE_ADD_HOURS      = 7;
    const MODE_SUB_HOURS      = 8;
    const MODE_ADD_MINUTES    = 9;
    const MODE_SUB_MINUTES    = 10;
    const MODE_ADD_SECONDS    = 11;
    const MODE_SUB_SECONDS    = 12;

    const DEFAULT_FORMAT      = 'Y-m-d H:i:s';

    /**
     * check if date is valid
     *
     * @param string $date  - date to validate
     * @return boolean      - is valid result
     */
    static function isValidDate($date) {
        $value = strtotime($date);
        return !empty($value);
    }

    /**
     * compare two valid dates (int)
     *
     * @param int $date1
     * @param int $date2
     * @return int returns COMPARE_DATE constant
     */
    private static function compare($date1, $date2) {
        $compare = self::COMPARE_DATE_EQUAL;
        if ($date1 < $date2) {
            $compare = self::COMPARE_DATE_BEFORE;
        } else if ($date1 > $date2) {
            $compare = self::COMPARE_DATE_AFTER;
        }
        return $compare;
    }

    /**
     * compare two valid dates (string)
     *
     * @param int $date1_str
     * @param int $date2_str
     * @return int returns COMPARE_DATE constant
     */
    static function compareDate($date1_str, $date2_str) {
        if (!self::isValidDate($date1_str) || !self::isValidDate($date2_str)) {
            return self::COMPARE_DATE_NULL;
        }

        $date1 = strtotime($date1_str);
        $date2 = strtotime($date2_str);

        return self::compare($date1, $date2);
    }

    /**
     * check if between given dates
     *
     * @param string $date_str
     * @param string $date_before_str
     * @param string $date_after_str
     * 
     * @return int returns COMPARE_DATE constant
     */
    static function isBetween($date_str, $date_before_str, $date_after_str) {
        if (!self::isValidDate($date_str) || !self::isValidDate($date_before_str) || !self::isValidDate($date_after_str)) {
            return self::COMPARE_DATE_ERROR;
        }

        return self::compareDate($date_str, $date_before_str) == self::COMPARE_DATE_AFTER && self::compareDate($date_str, $date_after_str) == self::COMPARE_DATE_BEFORE;
    }

    /**
     * gets the difference for two dates
     *
     * @param string $date1_str
     * @param string $date2_str
     * @param string $format
     *
     * @return string returns date difference
     */
    static function dateDifference($date1_str, $date2_str, $format = '%R%a days') {
        if (!self::isValidDate($date1_str) || !self::isValidDate($date2_str)) {
            return self::COMPARE_DATE_NULL;
        }
        $date1 = new DateTime($date1_str);
        $date2 = new DateTime($date2_str);
        $interval = $date1->diff($date2);
        return $interval->format($format);
    }

    /**
     * add days
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function addDays($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_ADD_DAYS, $modification, $format);
    }

    /**
     * subtract days
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function subDays($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_SUB_DAYS, $modification, $format);
    }

    /**
     * add months
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function addMonths($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_ADD_MONTHS, $modification, $format);
    }

    /**
     * subtract months
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function subMonths($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_SUB_MONTHS, $modification, $format);
    }

    /**
     * add years
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function addYears($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_ADD_YEARS, $modification, $format);
    }

    /**
     * substact years
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function subYears($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_SUB_YEARS, $modification, $format);
    }

    /**
     * add hours
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function addHours($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_ADD_HOURS, $modification, $format);
    }

    /**
     * substract hours
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function subHours($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_SUB_HOURS, $modification, $format);
    }

    /**
     * add minutes
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function addMinutes($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_ADD_MINUTES, $modification, $format);
    }

    /**
     * substract minutes
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function subMinutes($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_SUB_MINUTES, $modification, $format);
    }

    /**
     * add seconds
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function addSeconds($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_ADD_SECONDS, $modification, $format);
    }

    /**
     * substract seconds
     *
     * @param string $date
     * @param string $modification
     * @param string $format
     *
     * @return string returns modified date
     */
    static function subSeconds($date, $modification, $format = self::DEFAULT_FORMAT) {
        return self::modifyDate($date, self::MODE_SUB_SECONDS, $modification, $format);
    }

    /**
     * function to modify date
     * 
     * @param string $date       - date to modify
     * @param string $mode       - modify mode
     * @param int $modification  - modification value
     * @param string $format     - date format
     *
     * @return string            - result date
     */
    private static function modifyDate($date, $mode, $modification = 0, $format = self::DEFAULT_FORMAT) {
        switch ($mode) {
            case self::MODE_ADD_DAYS :
                $time = strtotime($date.' +'.$modification.' days');
                return date($format, $time);
                break;
            case self::MODE_SUB_DAYS :
                $time = strtotime($date.' -'.$modification.' days');
                return date($format, $time);
                break;
            case self::MODE_ADD_MONTHS :
                $time = strtotime($date.' +'.$modification.' months');
                return date($format, $time);
                break;
            case self::MODE_SUB_MONTHS :
                $time = strtotime($date.' -'.$modification.' months');
                return date($format, $time);
                break;
            case self::MODE_ADD_YEARS :
                $time = strtotime($date.' +'.$modification.' years');
                return date($format, $time);
                break;
            case self::MODE_SUB_YEARS :
                $time = strtotime($date.' -'.$modification.' years');
                return date($format, $time);
                break;
            case self::MODE_ADD_HOURS :
                $time = strtotime($date.' +'.$modification.' hours');
                return date($format, $time);
                break;
            case self::MODE_SUB_HOURS :
                $time = strtotime($date.' -'.$modification.' hours');
                return date($format, $time);
                break;
            case self::MODE_ADD_MINUTES :
                $time = strtotime($date.' +'.$modification.' minutes');
                return date($format, $time);
                break;
            case self::MODE_SUB_MINUTES :
                $time = strtotime($date.' -'.$modification.' minutes');
                return date($format, $time);
                break;
            case self::MODE_ADD_SECONDS :
                $time = strtotime($date.' +'.$modification.' seconds');
                return date($format, $time);
                break;
            case self::MODE_SUB_SECONDS :
                $time = strtotime($date.' -'.$modification.' seconds');
                return date($format, $time);
                break;
            default :
                $time = strtotime($date);
                return date($format, $time);
        }
    }

}

?>