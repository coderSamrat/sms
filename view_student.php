<?php
session_start();


error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'admin') {
    header("Location: login.php");
    exit();
}


include 'C:\xampp\htdocs\project\db\db.php'; 


$sql = "SELECT * FROM user WHERE usertype='student'";
$result = mysqli_query($data, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($data));
}


$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include 'admin_css.php'; ?>
    <style>
        .table_th {
            padding: 20px;
            font-size: 20px;
            text-align: center;
        }
        .table_td {
            padding: 20px;
            background-color: skyblue;
            text-align: center;
        }
        .delete-link {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <center>
            <h1>Student Data</h1>
            <?php if ($message): ?>
                <div class="message"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <br><br>
            <table border="1">
                <tr>
                    <th class="table_th">Username</th>
                    <th class="table_th">Phone</th>
                    <th class="table_th">Email</th>
                    <th class="table_th">Actions</th>
                </tr>
                <?php while ($info = $result->fetch_assoc()): ?>
                <tr>
                    <td class="table_td"><?php echo htmlspecialchars($info['username']); ?></td>
                    <td class="table_td"><?php echo htmlspecialchars($info['phone']); ?></td>
                    <td class="table_td"><?php echo htmlspecialchars($info['email']); ?></td>
                    <td class="table_td">
                        <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?');" href="delete.php?student_id=<?php echo urlencode($info['id']); ?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </center>
    </div>
</body>
</html>
