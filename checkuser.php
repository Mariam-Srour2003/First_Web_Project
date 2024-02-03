<?php
include "database.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE Email = '$email'";
$result = $con->query($query);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['Password'];
    if (password_verify($password, $hashedPassword)) {
        setcookie("session_cookie", "session_value", time() + 3600, "/");

        session_start();
        $_SESSION['firstName'] = $row['FirstName'];
        $_SESSION['id'] = $row['ID'];
        $_SESSION['ISA'] = $row['IS_A'];
        header("Location: MARIAMSROURPROJECT.html");
        exit();
    } else {
        echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px;">';
        echo "Incorrect password. Please try again.";
        echo '</div>';
        echo "<script>setTimeout(function(){window.location.href='login.html';}, 5000);</script>";
    }
} else {
    echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px;">';
    echo "User not found. Please check your email and try again.";
    echo '</div>';
    echo "<script>setTimeout(function(){window.location.href='login.html';}, 5000);</script>";
}

$con->close();
?>