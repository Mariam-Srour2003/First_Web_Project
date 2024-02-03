<?php
include("database.php");
$id = $_GET['id'];
$result = mysqli_query($con, "UPDATE events SET accepted = true WHERE id = $id");
if ($result) {
    header("Location: administratorseditpage.php");
    exit();
} else {
    echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px;">';
    echo "Error updating record: " . mysqli_error($con);
    echo '</div>';
    echo "<script>setTimeout(function(){window.location.href='administratorseditpage.php';}, 5000);</script>";
}
mysqli_close($con);
?>