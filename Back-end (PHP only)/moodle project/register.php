<?php

require_once('Database.php');

if (isset($_POST['registerInstractor'])) { // create instractor 
    if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['email'])) { // all fields should be filled
        $username = validate($_POST["name"]);
        $password = validate($_POST["password"]);
        $email = validate($_POST["email"]);
        mysqli_query($conn, "insert into instractor(name,email,pass) values ('$username','$email','$password')");
    }
    header("location: login.php");
} elseif (isset($_POST['registerStudent'])) { // create student
    if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['email'])) { // all fields should be filled
        $username = validate($_POST["name"]);
        $password = validate($_POST["password"]);
        $email = validate($_POST["email"]);
        mysqli_query($conn, "insert into students(name,email,pass) values ('$username','$email','$password')");
    }
    // for sent id std in url to add image to this std
    $sql = "select * from students where name='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id_std =  $row['id'];
        }
    }
    header("location: std/uplode img.php?id=".$id_std);// url with id std 
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
    <link rel="stylesheet" href="css/std.css">
</head>

<body style=" padding: 55px; background-color: white; ">
    <div class="form-body" style="background-color: #1976f3;border-radius: 150px; box-shadow: 6px 2px 2px black;">
        <div class="row" >
            <div class="form-holder" >
                <div class="form-content">
                    <div class="form-items" >
                        <h3>Register Today</h3>
                        <p>Fill in the data below.</p>
                        <form  class="requires-validation" novalidate action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                                <div class="valid-feedback">Username field is valid!</div>
                                <div class="invalid-feedback">Username field cannot be blank!</div>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                                <div class="valid-feedback">Email field is valid!</div>
                                <div class="invalid-feedback">Email field cannot be blank!</div>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="password" name="password" placeholder="Password" required>
                                <div class="valid-feedback">Password field is valid!</div>
                                <div class="invalid-feedback">Password field cannot be blank!</div>
                            </div><br> <br>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary" name="registerStudent">Register Student</button>
                                <button id="submit" type="submit" class="btn btn-primary" name="registerInstractor">Register Instractor</button>
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