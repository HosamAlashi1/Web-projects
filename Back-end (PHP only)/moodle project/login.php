<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("location: show student.php");
}elseif(isset($_SESSION['student'])){
   // header("location: std/show quize.php");
}
require_once('Database.php');

 
if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) { // all fields should be filled
        $email = validate($_POST["email"]);
        $password = validate($_POST["password"]);
        $sql1 = "SELECT * FROM instractor WHERE email= '$email' AND pass= '$password'";
        $data1 = mysqli_query($conn, $sql1);
        $sql2 = "SELECT * FROM students WHERE email = '$email' AND pass= '$password'";
        $data2 = mysqli_query($conn, $sql2);
        // for instractor
        if (mysqli_num_rows($data1) > 0) { // if there's data inside the table >> then do somthing which is validation if the login status was for admin of for a normal user
            while ($row1 = mysqli_fetch_assoc($data1)) {
                $dbemail1 = $row1['email'];
                $dbpassword1 = $row1['pass'];
            }
            if ($email == $dbemail1 && $password == $dbpassword1) {
                session_start();
                $_SESSION['admin'] = $email;
                rememberingMe($email, $password);
                header("location: show student.php");
            }
            // for students
        } elseif (mysqli_num_rows($data2) > 0) {
            while ($row2 = mysqli_fetch_assoc($data2)) {
                $dbemail2 = $row2['email'];
                $dbpassword2 = $row2['pass'];
            }
            if ($email == $dbemail2 && $password == $dbpassword2) {
                session_start();
                $_SESSION['student'] = $email;
                rememberingMe($email, $password);
                header("location: std/show quize.php");
            }
        } else {
            echo "Invalid username/password";
        }
    } else {
        echo "All Fields are Required!";
    }
} elseif (isset($_POST['register'])) {
    header("location: register.php");
}


function rememberingMe($email, $password)
{
    if (isset($_POST['remember'])) {
        setcookie('email', $email, time() + 7200); // for two hours >> just for example we can change it
        setcookie('password', $password, time() + 86400); // for one day (24 hours * 60 * 60)
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
    <link rel="icon" href="images/moodle.png">
    <title>Moodle</title>
    <!-- Arabic Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Css Stylesheet-->
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="images/Preloader.gif" alt="login" class="login-card-img" width="200" height="350">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body" style="margin-left: 110px;">
                            <div class="brand-wrapper">
                            </div>
                            <p class="login-card-description">قم بتسجيل الدخول الى الصفحة الرئيسية</p>
                            <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                                <div class="form-group">
                                    <label for="username" class="sr-only">اسم المستخدم</label>
                                    <input type="username" name="email" id="username" class="form-control" placeholder="اسم المستخدم">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">كلمة المرور </label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                                </div><br><br>
                                <div class="custom-control custom-checkbox login-card-check-box">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                                    <label class="custom-control-label" for="customCheck1">تذكرني</label>
                                </div><br>
                                <input style=" background-color: #2196f3;" name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="دخول">
                                <input style=" background-color: #2196f3;" name="register" id="login" class="btn btn-block login-btn mb-4" type="submit" value="انشاء حساب">
                            </form>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>