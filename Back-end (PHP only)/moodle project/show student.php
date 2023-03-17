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
  <style>
        #img {
            width: 80px;
            height: 50px;
        }
    </style>
</head>

<body>
  <nav class="dropdownmenu">
    <ul>
      <li style="margin-left: 210px;"><a href="show student.php">Students</a></li>
      <li style="margin-left: 160px;"><a href="show subject.php">Subject</a></li>
      <li style="margin-left: 160px;"><a href="show quize.php">Quize</a></li>
      <li style="margin-left: 160px;"><a href="logout.php">logout</a></li>
    </ul>
  </nav> <br> <br> <br> <br> <br>

  <div id="wrapper">
    <h1>Students Table</h1>

    <table id="keywords" cellspacing="0" cellpadding="0">
      <thead style="background-color: #30A6E6;">
        <tr>
          <th><span>Image </span></th>
          <th><span>Name</span></th>
          <th><span>Email</span></th>
          <th><span>GPA</span></th>
          <th><span>Delete</span></th>
          <th><span>UPdate</span></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select * from students";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . "<img id ='img' alt='image student' src='std/images/".$row['image'] . "'>" . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['gpa'] . "</td>";
            echo "<td><a href='delete std.php?id=" . $row["id"] . "'><img src=\"images/delete.jpg" . "\" height=\"35px\" width=\"35px\" style=\"border-radius: 390px; box-shadow: 2px 3px 2px #30A6E6;\" />" . "</a></td>";
            echo "<td><a href='update std.php?id=" . $row["id"] . "'><img src=\"images/update.jpg" . "\" height=\"35px\" width=\"35px\" style=\"border-radius: 390px; box-shadow: 2px 3px 2px #30A6E6;\" />" . "</a></td>";
            echo "</tr>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>