<?php
session_start();
if (!isset($_SESSION['admin'])) {
     header("location: login.php");
 }
require_once('Database.php');
$quize_id = $_GET['idQuize'];

if (isset($_POST['qustion'])) {
    
    if (!empty($_POST['qustion'])) { // all fields should be filled
        $qustion = validate($_POST["qustion"]);
        $qusA = validate($_POST["qusA"]);
        $qusB = validate($_POST["qusB"]);
        $qusC = validate($_POST["qusC"]);
        //$quize_id = validate($_POST["idQuize"]);
        $answers =
            "A- " . $qusA ."." . "\n" .
            "B- " . $qusB ."." . "\n" .
            "C- " . $qusC ;
          
        if (isset($_POST["ansA"])) {
            mysqli_query($conn, "INSERT into `questions`(`question`, `answers`, `ansTrue`, `idQuize`) VALUES ('$qustion','$answers','$qusA','$quize_id')");
        }elseif (isset($_POST["ansB"])) {
            mysqli_query($conn, "INSERT into `questions`(`question`, `answers`, `ansTrue`, `idQuize`) VALUES ('$qustion','$answers','$qusB','$quize_id')");
        }elseif (isset($_POST["ansC"])) {
            mysqli_query($conn, "INSERT into `questions`(`question`, `answers`, `ansTrue`, `idQuize`) VALUES ('$qustion','$answers','$qusC','$quize_id')");
        }

        

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
    <a href="show quize.php"><img id="img" src="images/back.jpg" width="70px" height="70px" style="border-radius: 390px;  box-shadow: 2px 1px 1px gray ; margin: 10px;"></a>
    <div class="form-body" style="background-color: #3c3838;border-radius: 150px; box-shadow: 20px 10px 10px #1976f3;">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Add Qustions</h3>
                        <p>Fill in the data below.</p>
                        <form class="requires-validation" novalidate action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="qustion" placeholder="qustion.." required>
                                <div class="valid-feedback">qustion field is valid!</div>
                                <div class="invalid-feedback">qustion field cannot be blank!</div>
                            </div><br><br>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="qusA" placeholder="ans .. A" required>
                                <div class="valid-feedback">ans .. A field is valid!</div>
                                <div class="invalid-feedback">ans .. A field cannot be blank!</div>
                            </div><br>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="qusB" placeholder="ans .. B" required>
                                <div class="valid-feedback">ans .. B field is valid!</div>
                                <div class="invalid-feedback">ans .. B field cannot be blank!</div>
                            </div><br>

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="qusC" placeholder="ans .. C" required>
                                <div class="valid-feedback">ans .. C field is valid!</div>
                                <div class="invalid-feedback">ans .. C field cannot be blank!</div>
                            </div><br>
                            <div class="col-md-12">
                            <input class="form-control" hidden type="number" name="idQuize" placeholder="quize Id" value="<?php echo $idQuize;?>" required>
                                <div class="valid-feedback">quize Id field is valid!</div>
                                <div class="invalid-feedback">quize Id cannot be blank!</div>
                            </div><br><br>

                            <!-- radion buttons-->

                            <div style="font-size: 18px;">
                                <label>Answer ..</label>
                                <input type="checkbox" name="ansA" id="invalidCheck" required>
                                <label>A</label>
                                <input type="checkbox" name="ansB" id="invalidCheck" required>
                                <label>B</label>
                                <input type="checkbox" name="ansC" id="invalidCheck" required>
                                <label>C</label>
                            </div><br><br><br>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary" name="add_qustion">Add Qustion</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- <script src="js/form.js"></script> -->
</body>

</html>