<?php

 require_once 'Database.php';
 session_start();
 if (!isset($_SESSION['admin'])) {
      header("location: login.php");
  }
  
 $name = $_GET['name']; // get url name subject
 $sql = "select * from subjects where name= '$name'";
 $result = mysqli_query($conn,$sql);
 if(mysqli_num_rows($result)>0){
     $row = mysqli_fetch_assoc($result);
     $sub_name = $row["name"];
     $sub_num = $row["numOfHours"];
 }

 if(isset($_POST['std_update'])){
    $sub_name = $_POST['name'];
    $sub_num = $_POST["num"];
    
     $sql = "update subjects set name = '$sub_name', numOfHours  = ' $sub_num' where name= '$name'";
     if(mysqli_query($conn,$sql)){
        header('Location:show subject.php');
        exit();
     }else
     echo "Error";
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
                        <h3>Update Subject</h3>
                        <p>Fill in the data below.</p>
                        <form class="requires-validation" novalidate action="<?php $_SERVER["PHP_SELF"];?>" method="POST">

                            <div class="col-md-12">
                               <input class="form-control" type="text" name="name" placeholder="Subject Name.." value="<?php echo $sub_name;?>" required>
                               <div class="valid-feedback">Subject name field is valid!</div>
                               <div class="invalid-feedback">Subject name field cannot be blank!</div>
                            </div><br>

                            <div class="col-md-12">
                                <input class="form-control" type="number" name="num" placeholder="Number of Hours" value="<?php echo $sub_num;?>" required>
                                 <div class="valid-feedback">Number of Hours field is valid!</div>
                                 <div class="invalid-feedback">Number of Hours field cannot be blank!</div>
                            </div><br><br>

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
