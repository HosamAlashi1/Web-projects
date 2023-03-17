<?php
require_once('../Database.php');
$std_id = $_GET['id'];
if (isset($_POST['add_image'])) {
    // the path to store the uploaded image 
    $image = $_FILES['image']['name'];

    $ex = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $a = array('png', 'jpg', 'gif', 'jpeg');
    $new_name = uniqid() . "." . $ex;

    // insert name image on DB
    mysqli_query($conn, $sql = "update students set image = '$new_name' where id=" . $std_id);
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' .$new_name);
    header("location: ../login.php?id=".$std_id);
} elseif (isset($_POST['skip'])) {
    header("location: ../login.php?id=".$std_id);
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
    <link rel="icon" href="../images/moodle.png">
    <!-- Css Stylesheet-->
    <link rel="stylesheet" href="../css/form.css">
    <!-- Css Stylesheet-->
    <link rel="stylesheet" href="../css/std.css">
    <link rel="stylesheet" href="../css/nav.css">
</head>

<body style=" padding: 55px; background-color: white; overflow: scroll;">


    <div class="form-body" style="background-color: #3c3838;border-radius: 150px; box-shadow: 20px 10px 10px #1976f3;">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Add Image</h3>
                        <p></p>
                        <form class="requires-validation" enctype="multipart/form-data" novalidate action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                            <div class="col-md-12">
                                <input style="background-color: #6C7576;border-radius: 150px;" class="form-control" type="file" name="image" placeholder="Subject Name.." required>
                            </div><br>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary" name="add_image">Add Image</button>
                            </div>
                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary" name="skip">Skip</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- <script src="../js/form.js"></script> -->
</body>

</html>