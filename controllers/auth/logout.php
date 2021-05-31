<?php
session_start();

include('../../common/db.php');

if (isset($_SESSION['username'])) {

    session_destroy();

    header('Location: http://'.$CONFIGS['HOSTNAME'].$CONFIGS['ROOT_PATH'].'/login.html');
}
