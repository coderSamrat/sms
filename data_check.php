<?php
session_start();
include("./db/db.php");

if (isset($_POST['apply'])) {
    $data_name = mysqli_real_escape_string($data, $_POST['name']);
    $data_email = mysqli_real_escape_string($data, $_POST['email']);
    $data_phone = mysqli_real_escape_string($data, $_POST['phone']);
    $data_massage = mysqli_real_escape_string($data, $_POST['massage']);

    $sql = "INSERT INTO admision (name, email, phone, massage) VALUES ('$data_name', '$data_email', '$data_phone', '$data_massage')";

    $result = mysqli_query($data, $sql);

    //have change

    if ($result) {
        $_SESSION["message"] = "Your application was sent successfully";
        header("Location:./index.php");
    } else {
        echo "Apply failed: " . mysqli_error($data);
    }
}
?>
