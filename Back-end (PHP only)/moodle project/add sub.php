<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
}
require_once('Database.php');

if (isset($_POST['add_sub'])) {
    if (!empty($_POST['name']) && !empty($_POST['num'])) { // all fields should be filled
        $sub_name = validate($_POST["name"]);
        $num_of_hours = validate($_POST["num"]);
        mysqli_query($conn, "insert into subjects values ('$sub_name','$num_of_hours')");
    }
    header("location: show subject.php");
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
                        <h3>Add Subject</h3>
                        <p>Fill in the data below.</p>
                        <form class="requires-validation" novalidate action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="name" placeholder="Subject Name.." required>
                                <div class="valid-feedback">Subject name field is valid!</div>
                                <div class="invalid-feedback">Subject name field cannot be blank!</div>
                            </div><br>

                            <div class="col-md-12">
                                <input class="form-control" type="number" name="num" placeholder="Number of Hours" required>
                                <div class="valid-feedback">Number of Hours field is valid!</div>
                                <div class="invalid-feedback">Number of Hours field cannot be blank!</div>
                            </div><br><br>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary" name="add_sub">Add Subject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="js/form.js"></script>
</body>

</html>