

<?php

session_start();

if(!isset($_SESSION['username']))
{
header("location:login.php");
}

elseif ($_SESSION['usertype']=='student')
{
header("location:login.php");
}


include("./db/db.php");

$sql="SELECT * from admision";

$result=mysqli_query($data, $sql);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>
    <?php 
    include('admin_css.php');
    ?>
</head>
<body>
    <?php
    include('admin_sidebar.php');
    ?>
	<div class="content">
    <center>
		
    <h1>Applied For Admission</h1>
    <br><br>
    
    <table border= "1px">
        <tr>

        <th style="padding:20px; font-size: 15px;">Name</th>
        <th style="padding:20px; font-size:15px;">email</th>
        <th style="padding:20px; font-size:15px;">Phone</th>
        <th style="padding:20px; font-size:15px;">message</th>

        </tr>
        <?php
          while($info=$result->fetch_assoc()) 
          {
        ?>
        <tr>
            <td style="padding: 20px;">
                <?php echo "{$info['Name']}";?>
        </td>
            <td style="padding: 20px;">
                <?php echo "{$info['email']}";?> 
            </td>
            <td style="padding: 20px;">
                <?php echo "{$info['phone']}";?>
            </td>
            <td style="padding: 20px;">
                 <?php echo "{$info['massage']}";?>
            </td>
        </tr>

        <?php
          }
        ?>
    </table>


        </center>
	</div>

</body>
</html>