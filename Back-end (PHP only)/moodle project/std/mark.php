<?php
require_once('../Database.php');
session_start();
$email_std = "";           // to select id for std  >> by session
$id_std =0;                
$id_quize = $_GET['id'];   // to select all qustions for the quize and store in table

if (!isset($_SESSION['student'])) {
    header("location: ../login.php");
}else{
    $email_std = $_SESSION['student'];
}

$sql = "select * from students where email='$email_std'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id_std = $row['id'];
    }
}

$sql2 = "select count(*) as num from std_qus where idQuize='$id_quize' and idStd='$id_std'";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $num_of_mark = $row2['num'];
    }
}

$sql3 = "select count(*) as numTrue from std_qus where mark = 1 and idQuize='$id_quize' and idStd='$id_std'";
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3) > 0) {
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $num_of_ansTrue = $row3['numTrue'];
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../images/moodle.png">
    <title>Student Moodle</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="icon" href="images/moodle.png">
    <!-- Css Stylesheet-->
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/std.css">
    <link rel="stylesheet" href="../css/form.css">

</head>

<body style="overflow: scroll;">
    <nav class="dropdownmenu">
        <ul>
            <li style="margin-left: 420px;"><a href="show quize.php">Main Page</a></li>
            <li style="margin-left: 320px;"><a href="../logout.php">logout</a></li>
        </ul>
    </nav><br> <br> <br> <br>

    <div class="form-body" style="background-color: #3c3838;border-radius: 150px; box-shadow: 20px 10px 10px #1976f3;">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <form class="requires-validation" novalidate action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">


                            <div>
                                <label class="form-control" style='color: #3c3838;'><?php echo $num_of_ansTrue."/".$num_of_mark ?></label>
                            </div><br><br>


                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>

</body>

</head>

</html>