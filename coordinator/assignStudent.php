<?php

include('../common/db.php');

$result = $mysqli->query('SELECT * FROM student WHERE supervisorId='.$_GET['id']);

if ($result->num_rows >= 5) {
    echo '403';
} else {
    $mysqli->query('UPDATE student SET supervisorId='.$_GET['id'].' WHERE matricId = "'.$_GET['matricId'].'"');
}