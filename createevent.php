<?php
include "database.php";
$uploadDir = 'C:/xampp/htdocs/PROJECT/';
$eventName = $_POST['theeventname'];
$infoAboutEvent = $_POST['theeventinfo'];
$eventType = $_POST['theeventtype'];
$eventDate = $_POST['theeventdate'];
$eventTime = $_POST['theeventtime'];
$image = $_FILES['image'];
$image_name = $image['name'];
$image_tmp = $image['tmp_name'];
$image_size = $image['size'];
$image_data = addslashes(file_get_contents($image_tmp));
$numberOfPeople = 0;
$maxPeople = $_POST['theeventmaxnbofpeople'];
$checkSql = "SELECT * FROM events WHERE eventName = '$eventName'";
$checkResult = $con->query($checkSql);
if ($checkResult->num_rows > 0) {
    echo "The event name already exists. Please check if it is the same event your adding or change name.";
    echo "<script>setTimeout(function(){window.location.href='addevent.html';}, 10000);</script>";
} else {
    $sql = "INSERT INTO events (eventName, infoAboutEvent, eventType, eventDate, eventTime, numberOfPeople, maxPeople, poster_name, poster_data) VALUES ('$eventName', '$infoAboutEvent', '$eventType', '$eventDate', '$eventTime', '$numberOfPeople', '$maxPeople', '$image_name', '$image_data')";
    if ($con->query($sql) === true) {
        echo $posterImage;
        echo "<script>setTimeout(function(){window.location.href='addevent.html';}, 10000);</script>";
        header("Location: eventspage.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
$con->close();
?>