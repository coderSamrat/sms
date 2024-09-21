<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] == 'student') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_student'])) {
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "schoolproject";

    $data = mysqli_connect($host, $user, $password, $db);

    if (!$data) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = mysqli_real_escape_string($data, $_POST['name']);
    $user_email = mysqli_real_escape_string($data, $_POST['email']);
    $user_phone = mysqli_real_escape_string($data, $_POST['phone']);
    $user_password = mysqli_real_escape_string($data, $_POST['password']);
    $usertype = "student";

    $sql = "INSERT INTO user (username, phone, email, usertype, password) VALUES ('$username', '$user_phone', '$user_email', '$usertype', '$user_password')";

    if (mysqli_query($data, $sql)) {
        echo "<script type='text/javascript'>alert('Data upload success');</script>";
    } else {
        echo "Upload Failed: " . mysqli_error($data);
    }
    

    mysqli_close($data);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <style type="text/css">
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: -10px;
            padding-bottom: 10px;
        }

        .div_deg {
            background-color: skyblue;
            width: 500px;
            padding: 20px;
            border: 1px solid rgb(89, 40, 138);
            margin-top: 40px;
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
            <h1>Add student</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>Username</label>
                        <input type="text" name="name">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="number" name="phone">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" name="add_student" value="Add Student">
                    </div>
                </form>
            </div>
        </center>
    </div>
</body>
</html>
