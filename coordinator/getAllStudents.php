<?php

include('../common/db.php');

$query = 'SELECT * FROM student';
if (isset($_GET['filter'])) {
    if ($_GET['filter'] == 'freeonly') {
        $query = 'SELECT * FROM student WHERE supervisorId = -1';
    }
}


$list = array();
if ($res = $mysqli->query($query)) {
    if ($res->num_rows > 0) {
        while ($student = $res->fetch_assoc()) {
            array_push($list, $student['matricId'].'|'.$student['stdName']);
        }

        echo join(',', $list);
    }
}