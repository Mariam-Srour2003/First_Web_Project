<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title> Happenings Events </title>
</head>

<body>
    <div id="all">
        <iframe id="callednavigationbar2" src="navigationbarpage.php" width="100%" height="60"></iframe>
        <div class="box"></div>
        <button id="sidebar-toggle" class="buttomsfilter"><img src="filter.png" alt="filter icon" width="30px"
                height="30px"></button>
        <p id="filter_choosen"> All Events </p>
        <div class="search-container">
            <form action="searchforeventbyname.php" method="GET">
                <input type="text" placeholder="Search by name" name="search">
                <button type="submit"><img src="search.png" width="30px" height="30px"></button>
            </form>
        </div>
        <nav id="sidebar-nav" class="sidebar-nav">
            <button id="hide-sidebar" class="buttomsfilter"><img src="close.png" alt="close icon" width="30px"
                    height="30px"></button>
            <div class="filter-group">
                <h3>Type</h3>
                <label><input type="checkbox" name="typecampus" value="campus" class="choice"
                        onclick="updateFilterText()">Campus</label>
                <label><input type="checkbox" name="typeonline" value="online" class="choice"
                        onclick="updateFilterText()">Online</label>
                <label><input type="checkbox" name="typehybrid" value="hybrid" class="choice"
                        onclick="updateFilterText()">Hybrid</label>
            </div>
            <div class="filter-group">
                <h3>Time</h3>
                <label><input type="radio" name="time" value="past" class="choice" onclick="updateFilterText()">Past
                    Event</label>
                <label><input type="radio" name="time" value="future" class="choice" onclick="updateFilterText()">Coming
                    Soon</label>
            </div>
            <div class="filter-group">
                <h3>Seats</h3>
                <label><input type="radio" name="seats" value="available" class="choice"
                        onclick="updateFilterText()">Seats Available</label>
                <label><input type="radio" name="seats" value="sold-out" class="choice" onclick="updateFilterText()">No
                    Seats Left</label>
            </div>
            <button id="clear-choices" class="buttomsfilter"><img src="filter-remove-icon.png" alt="close icon"
                    width="30px" height="30px"></button>
        </nav>
        <div id="allevents">
            <?php
            include "database.php";
            if (isset($_GET['typecampus']) or isset($_GET['typeonline']) or isset($_GET['typehybrid'])) {
                $selectedTypes = [];
                if (isset($_GET['typecampus'])) {
                    $selectedTypes[] = $_GET['typecampus'];
                }
                if (isset($_GET['typeonline'])) {
                    $selectedTypes[] = $_GET['typeonline'];
                }
                if (isset($_GET['typehybrid'])) {
                    $selectedTypes[] = $_GET['typehybrid'];
                }
                $selectedTypesStr = implode("','", $selectedTypes);
                $sql = "SELECT * FROM events WHERE eventType IN ('$selectedTypesStr')";
            } else {
                $sql = "SELECT * FROM events";
            }
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $eventName = $row['eventName'];
                    $infoAboutEvent2 = $row['infoAboutEvent'];
                    $eventType = $row['eventType'];
                    $eventDate = $row['eventDate'];
                    $eventTime = $row['eventTime'];
                    $image_name = $row['poster_name'];
                    $image_data = $row['poster_data'];
                    $image_type = getImageTypeFromData($image_data);
                    $eventId = $row['id'];
                    $eventnameshow = substr($eventName, 0, 15) . '...';
                    $infoAboutEvent = substr($infoAboutEvent2, 0, 25) . '...';
                    $acceptedevent = $row['accepted'];
                    if ($acceptedevent == 1) {
                        echo '<div class="event">';
                        echo '<div id="imagesize2">';
                        echo '<img id="imagesize2" src="data:' . $image_type . ';base64,' . base64_encode($image_data) . '">';
                        echo '</div>';
                        echo '<p class="eventname2" id="eventname' . $eventId . '">' . $eventnameshow . '</p>';
                        echo '<div class="eventinfo2-container">';
                        echo '<p class="titlesofeventinfo2">event type:</p>';
                        echo '<p class="eventinfo2">' . $eventType . '</p>';
                        echo '</div>';
                        echo '<div class="eventinfo2-container">';
                        echo '<p class="titlesofeventinfo2">info:</p>';
                        echo '<p class="eventinfo2">' . $infoAboutEvent . '</p>';
                        echo '</div>';
                        echo '<div class="eventinfo2-container">';
                        echo '<p class="titlesofeventinfo2">date & time:</p>';
                        echo '<p class="eventinfo2">' . $eventDate . ' at ' . $eventTime . '</p>';
                        echo '</div>';
                        echo '<a href="joinevent.html"><button id="join" class="buttomsfilter">join now</button></a>';
                        echo '</div>';
                    }
                }
            } else {
                echo '<p>No events found.</p>';
            }
            $con->close();
            function getImageTypeFromData($image_data)
            {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime_type = finfo_buffer($finfo, $image_data);
                finfo_close($finfo);

                switch ($mime_type) {
                    case 'image/jpeg':
                        return 'image/jpeg';
                    case 'image/png':
                        return 'image/png';
                    case 'image/gif':
                        return 'image/gif';
                    default:
                        return $mime_type;
                }
            }
            ?>
        </div>
        <?php
        if (isset($_SESSION['ISA']) && ($_SESSION['ISA'] == 'admin' || $_SESSION['ISA'] == 'faculty member')) {
            echo '<div id="addevent">';
            echo '<a href="addevent.html">';
            echo '<img class="addeventbutton" src="add.png" alt="Add Event" />';
            echo '</a>';
            echo '</div>';
        }
        ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="script.js"></script>
    </div>
</body>

</html>