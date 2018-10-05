<?php

    require_once '../class/DBHelper.php';

    echo '<pre>';
    print_r(DBHelper::select("SHOW DATABASES;"));
    echo '</pre>';

?>