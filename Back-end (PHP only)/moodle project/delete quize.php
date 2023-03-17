<?php

require_once 'Database.php';

$quize_id = $_GET['id'];

$sql1 = "delete from quize where id=". $quize_id;
$sql2 = "delete from questions where idQuize=". $quize_id;
if(mysqli_query($conn,$sql2) && mysqli_query($conn,$sql1)){
    //echo "Deleted Successfully";
    header('Location:show quize.php');
    exit();
}else
echo "Error";