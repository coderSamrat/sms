<?php

session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] == 'student') {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add_teacher'])) {
    $t_name = $_POST['name'];
    $t_description = $_POST['description'];
    
    $file = $_FILES['image']['name'];
    $dst = "./image/" . $file;
    $dst_db = "image/" . $file;
    move_uploaded_file($_FILES['image']['tmp_name'], $dst);

    $sql = "INSERT INTO teacher (name, description, image) VALUES ('$t_name', '$t_description', '$dst_db')";
    $result = mysqli_query($data, $sql);
    
    if (!$result) {
        echo "Error: " . mysqli_error($data);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <style type="text/css">
        .div_deg {
            background-color: skyblue;
            width: 500px;
            padding-top: 70px;
            padding-bottom: 70px;
            border-radius: 20px;
            height: 230px;
        }
    </style>
    <?php include 'admin_css.php'; ?>
</head>
<body>

<?php include 'admin_sidebar.php'; ?>

<div class="content">
    <center>
        <h1>Add Teacher</h1><br><br>
        <div class="div_deg">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div>
                    <label>Teacher Name:</label> 
                    <input type="text" name="name">
                </div><br>
                <div>
                    <label>Description:</label>
                    <textarea name="description" cols="30" rows="5"></textarea>
                </div>
                <div>
                    <label>Image:</label> 
                    <input type="file" name="image">
                </div>
                <div>
                    <input type="submit" name="add_teacher" value="Add Teacher" class="btn btn-primary">
                </div>
            </form>
        </div>
    </center>
</div>

</body>
</html>
