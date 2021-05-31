<?php

include('../../common/db.php');

$username = $_GET['username'];
$password = $_GET['password'];

$hash = password_hash($password, PASSWORD_BCRYPT);

$query = 'INSERT INTO account (username, password) VALUES ("' . $username . '", "' . $hash . '")';

if ($res = $mysqli->query($query)) {
    echo 'done';
}
