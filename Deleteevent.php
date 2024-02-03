<?php
include("database.php");
$id = $_GET['id'];
$result = mysqli_query($con, "DELETE FROM events WHERE id=$id");
header("Location:administratorseditpage.php");
?>