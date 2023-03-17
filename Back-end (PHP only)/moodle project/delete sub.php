<?php

require_once 'Database.php';

$sub_name = $_GET['name'];

$sql = "delete from subjects where name='$sub_name'";
if(mysqli_query($conn,$sql)){
    //echo "Deleted Successfully";
    header('Location:show subject.php');
    exit();
}else
echo "Error";