<?php

// $connection = mysqli_connect("localhost", "root");
// $db = mysqli_select_db($connection, 'myli');

// if (mysqli_connect_errno())
//   {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   }
$mysqli = new mysqli('localhost', 'root', '', 'myli') or die(mysqli_error($mysqli));

if (isset($_POST['update'])) {

    $stdMatricId = $_POST['stdMatricId'];

    $stdName = $_POST['stdName'];
    $stdEmail = $_POST['stdEmail'];
    $stdPhone = $_POST['stdPhone'];
    $stdProg = $_POST['stdProg'];

    $query = "UPDATE student SET stdName = '$stdName', stdEmail = '$stdEmail', stdPhone = '$stdPhone', stdProg = '$stdProg' WHERE stdMatricId = '$stdMatricId'"; 

    $mysqli->query($query) or die($mysqli->error);

    header("location: http://localhost:8080/MyLi/sandbox.php");

}

?>



