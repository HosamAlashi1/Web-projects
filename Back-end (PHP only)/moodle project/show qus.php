<?php
require_once('Database.php');
session_start();
if (!isset($_SESSION['admin'])) {
     header("location: login.php");
 }
$quize_id = null;
if (isset($_GET['id'])) {
    $quize_id= $_GET['id'];
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
        <?php
            echo "<a href='add qus.php?idQuize=" . $quize_id . "'><img src=\"images/plus.jpg" . "\" height=\"50px\" width=\"50px\" style=\"border-radius: 390px; box-shadow: 2px 3px 2px #30A6E6;\" />" . "</a>";
        ?>
        <h1>Qustions Table</h1>

        <table id="keywords" cellspacing="0" cellpadding="0">
            <thead style="background-color: #30A6E6; ">
                <tr>
                <th><span>Question</span></th>
                    <th><span>Answers</span></th>
                    <th><span>Answers - True</span></th>
                    <th><span>delete</span></th>
                    <th><span>update</span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "select * from questions where idQuize = '$quize_id'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['question'] . "</td>";
                        echo "<td>" . $row['answers'] . "</td>";
                        echo "<td>" . $row['ansTrue'] . "</td>";
                        echo "<td><a href='delete qus.php?question=" . $row["question"] . "'><img src=\"images/delete.jpg" . "\" height=\"35px\" width=\"35px\" style=\"border-radius: 390px; box-shadow: 2px 3px 2px #30A6E6;\" />" . "</a></td>";
                        echo "<td><a href='update qus.php?question=" . $row["question"] . "'><img src=\"images/update.jpg" . "\" height=\"35px\" width=\"35px\" style=\"border-radius: 390px; box-shadow: 2px 3px 2px #30A6E6;\" />" . "</a></td>";
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