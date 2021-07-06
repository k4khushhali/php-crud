<?php 

echo $stuid = $_GET['id'];

include 'config.php';

$sql = "DELETE FROM `student` WHERE sid = {$stuid}";
$result = mysqli_query($conn, $sql) or die("Query unsuccessfull !");

header("Location: http://localhost:8080/crud_html/index.php");

mysqli_close($conn);

?>