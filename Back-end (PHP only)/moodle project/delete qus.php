<?php

require_once 'Database.php';

$question  = $_GET['question'];

$sql = "select * from questions where question = '$question'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $idQuize = $row['idQuize'];
    }
}

$sql = "delete from questions where question='$question'";
if (mysqli_query($conn, $sql)) {
    //echo "Deleted Successfully";
    header('Location:show qus.php?id='.$idQuize);
    exit();
} else
    echo "Error";
