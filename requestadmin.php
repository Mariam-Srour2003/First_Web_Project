<?php
session_start();
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    include "database.php";
    $checkSql = "SELECT * FROM users WHERE ID = $userId";
    $checkResult = $con->query($checkSql);

    if ($checkResult->num_rows > 0) {
        $insertSql = "INSERT INTO request_admin (userid) VALUES ($userId)";
        if ($con->query($insertSql) === true) {
            header("Location: MARIAMSROURPROJECT.html");
            exit();
        } else {
            echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px;">';
            echo "Error: " . mysqli_error($con);
            echo '</div>';
            echo "<script>setTimeout(function(){window.location.href='login.html';}, 5000);</script>";
        }
    } else {
        echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px;">';
        echo "User ID not found in the users table.";
        echo '</div>';
        echo "<script>setTimeout(function(){window.location.href='login.html';}, 5000);</script>";
    }
    $con->close();
} else {
    echo "User ID not available in session.";
}
?>