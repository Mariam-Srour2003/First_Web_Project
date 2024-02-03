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
        <p id="filter_choosen"> All Events </p>
        <div class="search-container">
            <form action="searchforeventbyname.php" method="GET">
                <input type="text" placeholder="Search by name" name="search">
                <button type="submit"><img src="search.png" width="30px" height="30px"></button>
            </form>
        </div>
        <div id="allevents">
            <?php
            require_once "database.php";
            $searchQuery = $_GET['search'];
            $stmt = $pdo->prepare("SELECT * FROM events WHERE eventName LIKE :searchQuery");
            $stmt->execute([':searchQuery' => '%' . $searchQuery . '%']);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
                echo '<button id="join" class="buttomsfilter">join now</button>';
                echo '</div>';
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
    </div>
</body>

</html>