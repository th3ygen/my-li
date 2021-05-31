<?php

include('../common/db.php');

$query = 'UPDATE student SET supervisorId=-1 WHERE matricId NOT IN ('.$_GET['ids'].')';

$mysqli->query($query);