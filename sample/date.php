<?php

    require_once '../class/DateUtil.php';

    echo '<h3>DateUtil Sample</h3>';
    $date = date('Y-m-d H:i:s');
    $date_before = DateUtil::subMonths($date, 3);
    $date_after = DateUtil::addMonths($date, 13);

    echo 'Date : '.$date.'<br>';
    echo 'Before Date : '.$date_before.'<br>';
    echo 'After Date : '.$date_after.'<br>';

    $result = DateUtil::compareDate($date, $date_before);
    if ($result == DateUtil::COMPARE_DATE_BEFORE) {
        echo $date.' < '.$date_before.'<br>';
    } else if ($result == DateUtil::COMPARE_DATE_AFTER) {
        echo $date.' > '.$date_before.'<br>';
    } else if ($result == DateUtil::COMPARE_DATE_EQUAL) {
        echo $date.' = '.$date_before.'<br>';
    }

    $result = DateUtil::compareDate($date, $date_after);
    if ($result == DateUtil::COMPARE_DATE_BEFORE) {
        echo $date.' < '.$date_after.'<br>';
    } else if ($result == DateUtil::COMPARE_DATE_AFTER) {
        echo $date.' > '.$date_after.'<br>';
    } else if ($result == DateUtil::COMPARE_DATE_EQUAL) {
        echo $date.' = '.$date_after.'<br>';
    }

    if (DateUtil::isBetween($date, $date_before, $date_after)) {
        echo $date.' is between '.$date_before.' and '.$date_after.'<br>';
    }
    if (DateUtil::isBetween($date_before, $date, $date_after)) {
        echo $date.' is between '.$date_before.' and '.$date_after.'<br>';
    } else {
        echo $date_before.' is not in between '.$date.' and '.$date_after.'<br>';
    }

    $date_str_nv = "asdf";
    $date_str_v = "2018-01-01";
    $result_nv = DateUtil::isValidDate($date_str_nv) ? $date_str_nv.' is a valid date' : $date_str_nv.' is not a valid date';
    $result_v = DateUtil::isValidDate($date_str_v) ? $date_str_v.' is a valid date' : $date_str_v.' is not a valid date';
    echo $result_nv.'<br>';
    echo $result_v.'<br>';

?>