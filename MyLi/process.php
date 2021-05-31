<?php
session_start();
// $connection = mysqli_connect("localhost", "root");
// $db = mysqli_select_db($connection, 'myli');

// if (mysqli_connect_errno())
//   {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   }
$mysqli = new mysqli('localhost', 'root', '', 'myli') or die(mysqli_error($mysqli));

if (isset($_POST['add'])) {
    $stdName = $_POST['stdName'];
    $stdMatricId = $_POST['stdMatricId'];
    $stdEmail = $_POST['stdEmail'];
    $stdPhone = $_POST['stdPhone'];
    $stdProg = $_POST['stdProg'];

    $query = "INSERT INTO student (stdName, stdMatricId, stdEmail, stdPhone, stdProg) VALUES('$stdName', '$stdMatricId', '$stdEmail', '$stdPhone', '$stdProg')";
    // $query_run = mysqli_query($connection, $query);

    $mysqli->query($query) or die($mysqli->error);

    $_SESSION['message'] = "New Student has been Added!";
    $_SESSION['msg_type'] = "success";

    header("location: http://localhost:8080/MyLi/sandbox.php");

}

if (isset($_POST['delete'])){
    $id = $_POST['deleteMe'];

    $query = "DELETE FROM student WHERE stdMatricId = '$id'";

    $mysqli->query($query);

    $_SESSION['message'] = "A Student has been Deleted!";
    $_SESSION['msg_type'] = "danger";


    header("location: http://localhost:8080/MyLi/sandbox.php");
}

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