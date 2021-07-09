<?php

    $stuid = $_POST['sid'];
    $stuname = $_POST['sname'];
    $stuaddress = $_POST['saddress'];
    $stuclass = $_POST['sclass'];
    $stuphone = $_POST['sphone'];

    include 'config.php';

    $sql = "UPDATE `student` SET `sname`='{$stuname}',`saddress`='{$stuaddress}',`sclass`='{$stuclass}',`sphone`='{$stuphone}' WHERE `sid` = {$stuid}";
    $result = mysqli_query($conn, $sql) or die("Query unsuccessfull !");

    header("Location: http://localhost:8080/php-crud/index.php");

    mysqli_close($conn);
    
?>
