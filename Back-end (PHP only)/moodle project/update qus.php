<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
}
require_once('Database.php');
 // get url question
$question = $_GET['question'];
$sql = "select * from questions where question= '$question'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $question = $row["question"];
    $answers = $row["answers"];
    $ansTrue = $row["ansTrue"];
    $idQuize = $row["idQuize"]; // use only url show qustions
}
$arranswers = explode(".", $answers);
$qusA = explode("A- ", $arranswers[0])[1];
$qusB = explode("B- ", $arranswers[1])[1];
$qusC = explode("C- ", $arranswers[2])[1];

if (isset($_POST['update_qustion'])) {
    if (!empty($_POST['qustion'])) { // all fields should be filled
        $qustion = validate($_POST["qustion"]);
        $qusA = validate($_POST["qusA"]);
        $qusB = validate($_POST["qusB"]);
        $qusC = validate($_POST["qusC"]);
        $answers =
            "A- " . $qusA . "." . "\n" .
            "B- " . $qusB . "." . "\n" .
            "C- " . $qusC;

        if (isset($_POST['ansA'])) {
            mysqli_query($conn, "update questions set question = '$qustion', answers  = '$answers' , ansTrue  = '$qusA' where question= '$question'");
        } elseif (isset($_POST['ansB'])) {
            mysqli_query($conn, "update questions set question = '$qustion', answers  = '$answers' , ansTrue  = '$qusB' where question= '$question'");
        } elseif (isset($_POST['ansC'])) {
            mysqli_query($conn, "update questions set question = '$qustion', answers  = '$answers' , ansTrue  = '$qusC' where question= '$question'");
        }
        header('Location:show qus.php?id='.$idQuize);
    }
}

function validate($value)
{
    $value = trim($value);
    $value = strip_tags($value);
    $value = stripcslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Moodle Register</title>
    <!-- Arabic Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="icon" href="images/moodle.png">
    <!-- Css Stylesheet-->
    <link rel="stylesheet" href="css/form.css">
    <!-- Css Stylesheet-->
    <link rel="stylesheet" href="css/std.css">
    <link rel="stylesheet" href="css/nav.css">
</head>

<body style=" padding: 55px; background-color: white; overflow: scroll;">
    <nav class="dropdownmenu">

        <ul>
            <li style="margin-left: 210px;"><a href="show student.php">Students</a></li>
            <li style="margin-left: 160px;"><a href="show subject.php">Subject</a></li>
            <li style="margin-left: 160px;"><a href="show quize.php">Quize</a></li>
            <li style="margin-left: 160px;"><a href="logout.php">logout</a></li>
        </ul>
    </nav><br><br><br><br><br>
    <div class="form-body" style="background-color: #3c3838;border-radius: 150px; box-shadow: 20px 10px 10px #1976f3;">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Update Qustions</h3>
                        <p>Fill in the data below.</p>
                        <form class="requires-validation" novalidate action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="qustion" placeholder="qustion.." value="<?php echo $question; ?>" required>
                                <div class="valid-feedback">qustion field is valid!</div>
                                <div class="invalid-feedback">qustion field cannot be blank!</div>
                            </div><br><br>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="qusA" placeholder="ans .. A" value="<?php echo $qusA; ?>" required>
                                <div class="valid-feedback">ans .. A field is valid!</div>
                                <div class="invalid-feedback">ans .. A field cannot be blank!</div>
                            </div><br>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="qusB" placeholder="ans .. B" value="<?php echo $qusB; ?>" required>
                                <div class="valid-feedback">ans .. B field is valid!</div>
                                <div class="invalid-feedback">ans .. B field cannot be blank!</div>
                            </div><br>

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="qusC" placeholder="ans .. C" value="<?php echo $qusC; ?>" required>
                                <div class="valid-feedback">ans .. C field is valid!</div>
                                <div class="invalid-feedback">ans .. C field cannot be blank!</div>
                            </div><br>
                            <div class="col-md-12">
                                <div class="valid-feedback">quize Id field is valid!</div>
                                <div class="invalid-feedback">quize Id cannot be blank!</div>
                            </div><br><br>

                            <!-- radion buttons-->

                            <div style="font-size: 18px;">
                                <label>Answer ..</label>
                                <input type="checkbox" name="ansA" id="invalidCheck" <?php if ($ansTrue == $qusA) {
                                                                                            echo "checked";
                                                                                        } ?> required>
                                <label>A</label>
                                <input type="checkbox" name="ansB" id="invalidCheck" <?php if ($ansTrue == $qusB) {
                                                                                            echo "checked";
                                                                                        } ?> required> 
                                <label>B</label>
                                <input type="checkbox" name="ansC" id="invalidCheck"<?php if ($ansTrue == $qusC) {
                                                                                            echo "checked";
                                                                                        } ?> required>
                                <label>C</label>
                            </div><br><br><br>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary" name="update_qustion">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    
</body>

</html>