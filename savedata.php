<?php

    $stuname = $_POST['sname'];
    $stuaddress = $_POST['saddress'];
    $stuclass = $_POST['class'];
    $stuphone = $_POST['sphone'];

    include 'config.php';

    $sql = "INSERT INTO `student`(`sname`, `saddress`, `sclass`, `sphone`) VALUES ('{$stuname}','{$stuaddress}','{$stuclass}','{$stuphone}')";
    $result = mysqli_query($conn, $sql) or die("Query unsuccessfull !");

    header("Location: http://localhost:8080/php-crud/index.php");

    mysqli_close($conn);
    
?>
