<?php
require_once('../Database.php');
session_start();
$email_std = "";           // to select id for std  >> by session
$id_std =0;                
$id_quize = $_GET['id'];   // to select all qustions for the quize and store in table
$num = $_POST['num'] ?? 0;
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

$sql = "select * from questions where idQuize = '$id_quize'";
$result = mysqli_query($conn, $sql);
$qustions = [];
$ansTrue = [];
$ansA = [];
$ansB = [];
$ansC = [];

if(isset($_GET['i'])){
   $i =   $_GET['i'];
   
}else{
$i=0;
}
//echo $i;
$x=0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $qustions[$x] = $row['question'];
        $ansTrue[$x] = $row["ansTrue"];
        $answers = $row['answers'];
        $arranswers = explode(".", $answers);
        $ansA[$x] = explode("A- ", $arranswers[0])[1];
        $ansB[$x] = explode("B- ", $arranswers[1])[1];
        $ansC[$x] = explode("C- ", $arranswers[2])[1];
        $x++;
    }
}

if (isset($_POST['next'])) {
   
    if(count($qustions)> ($i+1)){
        $qustion = $qustions[$i];
        $aTrue = $ansTrue[$i];
            $ans = $_POST['ans'];
            if ($aTrue == $ans) {
               mysqli_query($conn, "INSERT into `std_qus`(`idStd`, `question`, `mark`, `idQuize`) VALUES ('$id_std','$qustion',1,'$id_quize')");
            }else{
                mysqli_query($conn, "INSERT into `std_qus`(`idStd`, `question`, `mark`, `idQuize`) VALUES ('$id_std','$qustion',0,'$id_quize')");
            }
        ++$i;
        header('Location:start quize.php?id='.$id_quize."&i=".$i);
    }else{
        $qustion = $qustions[$i];
        $aTrue = $ansTrue[$i];
        
            $ans = $ansA[$i];
            if ($aTrue == $ans) {
               mysqli_query($conn, "INSERT into `std_qus`(`idStd`, `question`, `mark`, `idQuize`) VALUES ('$id_std','$qustion',1,'$id_quize')");
            }else{
                mysqli_query($conn, "INSERT into `std_qus`(`idStd`, `question`, `mark`, `idQuize`) VALUES ('$id_std','$qustion',0,'$id_quize')");
            }
        header('Location:mark.php?id='.$id_quize);
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
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/std.css">


</head>

<body style="overflow: scroll;">

    <div id="wrapper">
        <h1>Quize</h1>
        <table id="keywords" cellspacing="0" cellpadding="0">
            <thead style="background-color: #30A6E6; ">

            </thead>
            <tbody>
                <div class="form-body" style="background-color: #3c3838;border-radius: 150px; box-shadow: 20px 10px 10px #1976f3;">
                    <div class="row">
                        <div class="form-holder">
                            <div class="form-content">
                                <div class="form-items">
                                    <form class="requires-validation" novalidate action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">

                                        <div>
                                            <label class='form-control' style='color: #3c3838;'><?php echo $qustions[$i]; ?> </label>
                                        </div><br><br>

                                        <div style='font-size: 18px;'>
                                            <input id="input1" type='radio' name='ans' value="<?php echo $ansA[$i]; ?>" id='invalidCheck' required>
                                            <label for="input1"><?php echo $ansA[$i]; ?> </label><br><br>
                                            <input id="input2" type='radio' name='ans' value="<?php echo $ansB[$i]; ?>" id='invalidCheck' required>
                                            <label for="input2"><?php echo $ansB[$i]; ?></label><br><br>
                                            <input id="input3" type='radio' name='ans' value="<?php echo $ansC[$i]; ?>" id='invalidCheck' required>
                                            <label for="input3"><?php echo $ansC[$i]; ?></label><br><br>
                                        </div><br><br><br>


                                        <div class="form-button mt-3">
                                            <button id="submit" type="submit"  class="btn btn-primary" name="next">Next</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </tbody>
        </table>

    </div>

</body>

</head>

</html>