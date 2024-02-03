<?php
include "database.php";

$firstName = $_REQUEST['FirstName'];
$lastName = $_REQUEST['LastName'];
$email = $_REQUEST['Email'];
$password = $_REQUEST['Password'];
$telephone = $_REQUEST['Telephone'];
$isA = $_REQUEST['IS_A'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$checkSql = "SELECT * FROM users WHERE Email = '$email'";
$checkResult = $con->query($checkSql);

if ($checkResult->num_rows > 0) {
    echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px;">';
    echo 'The email already exists. Please try logging in.';
    echo '</div>';
    echo "<script>setTimeout(function(){window.location.href='login.html';}, 5000);</script>";
} else {
    $sql = "INSERT INTO users (FirstName, LastName, Email, Password, Telephone, IS_A) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', '$telephone', '$isA')";
    if ($con->query($sql) === true) {
        setcookie("session_cookie", "session_value", time() + 3600, "/");
        session_start();
        $newUserId = mysqli_insert_id($con);
        $_SESSION['firstName'] = $firstName;
        $_SESSION['id'] = $newUserId;
        $_SESSION['ISA'] = $isA;
        header("Location: MARIAMSROURPROJECT.html");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

$con->close();
?>