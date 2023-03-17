<?php
require_once 'Database.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
}

$std_id = $_GET['id'];
$sql = "select * from students where id=" . $std_id;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $std_name = $row["name"];
    $std_email = $row["email"];
    $std_gpa = $row["gpa"];
}

if (isset($_POST['std_update'])) {
    $std_name = validate($_POST['name']);
    $std_email = validate($_POST["email"]);
    $std_gpa = validate($_POST["gpa"]);

    $sql = "update students set name = '$std_name', email = ' $std_email', gpa = '$std_gpa' where id=" . $std_id;
    if (mysqli_query($conn, $sql)) {
        header('Location:show student.php');
        exit();
    } else
        echo "Error";
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
    <link rel="icon" href="images/moodle.png">
    <title>Moodle Register</title>
    <!-- Arabic Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Css Stylesheet-->
    <link rel="stylesheet" href="css/form.css">
</head>

<body style=" padding: 55px; background-color: white; ">
    <div class="form-body" style="background-color: #1976f3;border-radius: 150px; box-shadow: 20px 10px 10px black;">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Update Student</h3>
                        <p>Fill in the data below.</p>
                        <form class="requires-validation" novalidate action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="name" placeholder="Full Name" value="<?php echo $std_name; ?>" required>
                                <div class="valid-feedback">Username field is valid!</div>
                                <div class="invalid-feedback">Username field cannot be blank!</div>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="email" name="email" placeholder="E-mail Address" value="<?php echo $std_email; ?>" required>
                                <div class="valid-feedback">Email field is valid!</div>
                                <div class="invalid-feedback">Email field cannot be blank!</div>
                            </div><br>

                            <div class="col-md-12">
                                <input class="form-control" type="number" name="gpa" placeholder=" gpa" value="<?php echo $std_gpa; ?>">
                            </div><br> <br>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary" name="std_update">Update</button>
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