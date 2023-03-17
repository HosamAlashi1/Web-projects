<?php

require_once 'Database.php';

$std_id = $_GET['id'];

$sql = "delete from students where id='$std_id'";
if(mysqli_query($conn,$sql)){
    //echo "Deleted Successfully";
    header('Location:show student.php');
    exit();
}else
echo "Error";