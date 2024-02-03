<?php
include("database.php");
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM request_admin WHERE userid=$id");
header("Location:administratorseditpage.php");
?>