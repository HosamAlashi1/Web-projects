<?php
require_once('../Database.php');
session_start();
$std_id =0;
$email="";
if (isset($_GET['id'])) {
    $std_id = $_GET['id'];
} elseif (isset($_SESSION['student'])) {
    $email = $_SESSION['student']; // for select image student
}

if (!isset($_SESSION['student'])) {
    header("location: ../login.php");
}

$sql = "select * from students where email='$email' or id=$std_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $image = $row['image'];
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../images/moodle.png">
    <title>Student Moodle</title>
    <!-- Css Stylesheet-->
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/std.css">


</head>

<body>
    <nav class="dropdownmenu">
        <ul>
            <li style="margin-left: 160px;"><a href="../logout.php">logout</a></li>
        </ul>
    </nav><br> <br> <br> <br> <br>

    <div id="wrapper">
        <a><img src="images/<?php echo $image; ?>" width="85px" height="85px" style="border-radius: 390px;  box-shadow: 2px 1px 1px gray ; margin: 10px;"></a>
        <h1>Quizes</h1>

        <table id="keywords" cellspacing="0" cellpadding="0">
            <thead style="background-color: #30A6E6; ">
                <tr>
                    <th><span>Subject--- Name</span></th>
                    <th><span>Start----- Time</span></th>
                    <th><span>END----- Time</span></th>
                    <th><span>Number Qustions</span></th>
                    <th><span>Start</span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "select * from quize";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // for count qustions
                        $sql2 = "select count(*) as num from questions where idQuize=" . $row['id'];
                        $result2 = mysqli_query($conn, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $num_of_qus = $row2['num'];
                            }
                        }
                        echo "<tr>";
                        echo "<td>" . $row['nameSub'] . "</td>";
                        echo "<td>" . $row['startTime'] . "</td>";
                        echo "<td>" . $row['endTime'] . "</td>";
                        echo "<td>" . $num_of_qus . "</td>";
                        echo "<td  id='img'><a href='start quize.php?id=".$row['id']."'><img src=\"images/start.jpg" . "\" height=\"35px\" width=\"45px\" style=\"border-radius: 15px; box-shadow: 2px 3px 2px #30A6E6;\" />" . "</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

    </div>

</body>

<script>
    var a = 0;

    function show_and_hide() {
        if (a == 1) {
            document.getElementById("img").style.display = "inline";
        } else {
            document.getElementById('img').style.display = "none";
        }
    }
</script>
</head>

</html>