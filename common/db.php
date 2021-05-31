<?php
    $CONFIGS = array(
        'ROOT_PATH' => '/sites/my-li',
        'HOSTNAME' => 'localhost',
        'DB_NAME' => 'my-li',
        'USER' => 'root',
        'PASS' => ''
    );

    $mysqli = new mysqli($CONFIGS['HOSTNAME'], $CONFIGS['USER'], $CONFIGS['PASS'], $CONFIGS['DB_NAME']);

    if ($mysqli->errno) {
        echo 'Error connecting to DB: '.$mysqli->error;
    }
?>