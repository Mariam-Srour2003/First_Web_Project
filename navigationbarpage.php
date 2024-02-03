<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Happenings</title>
</head>

<body>
    <nav id="NavigationBar">
        <ul class="ulnav">
            <li class="linav"><img id="PageLogo" src="Capturee.PNG"></li>
            <li class="linav" id="Home"><a href="MARIAMSROURPROJECT.html" style="text-decoration:none;"
                    target="_blank">Home</a></li>
            <li class="linav"><a href="eventspage.php" style="text-decoration:none;" target="_blank">Events</a></li>
            <li class="linav"><a href="#">Contact</a></li>
            <?php
            session_start();
            if (isset($_SESSION['ISA']) and $_SESSION['ISA'] == 'admin') {
                echo '<li class="linav"><a href="administratorseditpage.php" style="text-decoration:none;" target="_blank">Admin Edit Page</a></li>';
            }
            if (isset($_SESSION['ISA']) and $_SESSION['ISA'] == 'faculty member') {
                echo '<li class="linav"><a href="requestadmin.php" style="text-decoration:none;" target="_blank">Request Admin</a></li>';
            }
            ?>
            <li id="limargin" class="liname">User is:</li>
            <li id="nameofuserinnav" class="liname">
                <?php echo $_SESSION['firstName'] ?? 'Guest'; ?>
            </li>
            <?php
            if (isset($_SESSION['id'])) {
                echo '<li class="linav"><a href="logout.php">logout</a></li>';
            }
            ?>
        </ul>
    </nav>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>

</html>