<?php
include "database.php";

$eventname = $_POST['event_name'];

$query = "SELECT * FROM events WHERE eventName = '$eventname'";
$result = $con->query($query);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $eventid = $row['id'];
    $maxnbattenders = $row['maxPeople'];
    $nbjoiningnow = $row['numberOfPeople'];
    session_start();
    $userid = $_SESSION['id'];
    $checksql = "SELECT * FROM join_events WHERE user_id = '$userid' AND event_id = '$eventid'";
    $checkresult = $con->query($checksql);

    if ($checkresult->num_rows === 0) {
        if ($maxnbattenders > $nbjoiningnow) {
            $addsql = "INSERT INTO join_events (user_id, event_id) VALUES ('$userid', '$eventid')";
            if ($con->query($addsql) === true) {
                $updatesql = "UPDATE events SET numberOfPeople = numberOfPeople + 1 WHERE id = $eventid";
                if ($con->query($updatesql) === TRUE) {
                    header("Location: MARIAMSROURPROJECT.html");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px;">';
            echo "Sorry, you cannot join. The maximum number of people has already joined the event.";
            echo '</div>';
            echo "<script>setTimeout(function(){window.location.href='MARIAMSROURPROJECT.html';}, 5000);</script>";
        }
    } else {
        echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px;">';
        echo "Sorry, you have already joined this event.";
        echo '</div>';
        echo "<script>setTimeout(function(){window.location.href='MARIAMSROURPROJECT.html';}, 5000);</script>";
    }
} else {
    echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px;">';
    echo "Event not found. Please check the event again.";
    echo '</div>';
    echo "<script>setTimeout(function(){window.location.href='eventspage.php';}, 5000);</script>";
}
$con->close();
?>