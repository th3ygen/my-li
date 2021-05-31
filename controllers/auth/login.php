<?php
session_start();

include('../../common/db.php');

$username = $_POST['username'];
$password = $_POST['password'];

$query = 'SELECT * FROM account WHERE username = "' . $username . '"';

if ($res = $mysqli->query($query)) {
    if ($res->num_rows > 0) {
        if ($user = $res->fetch_assoc()) {
            
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['userRole'];

                header('Location: http://'.$CONFIGS['HOSTNAME'].$CONFIGS['ROOT_PATH'].'/sandbox.php');
            } else {
                header('Location: http://'.$CONFIGS['HOSTNAME'].$CONFIGS['ROOT_PATH'].'/login.html?error=401');
            }
        } else {
            header('Location: http://'.$CONFIGS['HOSTNAME'].$CONFIGS['ROOT_PATH'].'/login.html?error=401');
        }
    } else {
        header('Location: http://'.$CONFIGS['HOSTNAME'].$CONFIGS['ROOT_PATH'].'/login.html?error=401');
    }
} else {
    header('Location: http://'.$CONFIGS['HOSTNAME'].$CONFIGS['ROOT_PATH'].'/login.html?error=401');
}




