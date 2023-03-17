<?php
require_once('Database.php');
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/moodle.png">
    <title>instractor Moodle</title>
    <!-- Css Stylesheet-->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/std.css">


</head>

<body>
    <nav class="dropdownmenu">
        <ul>
            <li style="margin-left: 210px;"><a href="show student.php">Students</a></li>
            <li style="margin-left: 160px;"><a href="show subject.php">Subject</a></li>
            <li style="margin-left: 160px;"><a href="show quize.php">Quize</a></li>
            <li style="margin-left: 160px;"><a href="logout.php">logout</a></li>
        </ul>
    </nav><br> <br> <br> <br> <br>

    <div id="wrapper" style="overflow: hidden; width: 1000px;">
        <a href="create quize.php"><img id="img" src="images/plus.jpg" width="50px" height="50px" style="border-radius: 390px;  box-shadow: 2px 1px 1px gray ; margin: 10px;"></a>
        <h1>Quize Table</h1>

        <table id="keywords" cellspacing="0" cellpadding="0">
            <thead style="background-color: #30A6E6; ">
                <tr>
                    <th><span>Subject--- Name</span></th>
                    <th><span>Start----- Time</span></th>
                    <th><span>END----- Time</span></th>
                    <th><span>Delete</span></th>
                    <th><span>UPdate</span></th>
                    <th><span>show</span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "select * from quize";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['nameSub'] . "</td>";
                        echo "<td>" . $row['startTime'] . "</td>";
                        echo "<td>" . $row['endTime'] . "</td>";
                        echo "<td><a href='delete quize.php?id=" . $row["id"] . "'><img src=\"images/delete.jpg" . "\" height=\"35px\" width=\"35px\" style=\"border-radius: 390px; box-shadow: 2px 3px 2px #30A6E6;\" />" . "</a></td>";
                        echo "<td><a href='update quize.php?id=" . $row["id"] . "'><img src=\"images/update.jpg" . "\" height=\"35px\" width=\"35px\" style=\"border-radius: 390px; box-shadow: 2px 3px 2px #30A6E6;\" />" . "</a></td>";
                        echo "<td><a href='show qus.php?id=" . $row["id"] . "'><img src=\"images/show.jpg" . "\" height=\"35px\" width=\"35px\" style=\"border-radius: 60%; box-shadow: 2px 3px 2px #30A6E6;\" />" . "</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

    </div>

</body>

</head>

</html>