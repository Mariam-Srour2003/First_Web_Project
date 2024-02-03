<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title> Happenings Events </title>
    <style>
        table,
        td,
        th {
            text-align: center;
            border: 2px solid;
            background-color: #aea1ea;
        }

        p {
            margin-left: 20px;
            font-size: 50px;
            color: #2f0542;
        }

        table {
            margin-left: 2%;
            width: 96%;
            border-collapse: collapse;
        }

        th {
            background-color: #2f0542;
            color: #aea1ea;
        }
    </style>
</head>

<body>
    <div id="all">
        <iframe id="callednavigationbar2" src="navigationbarpage.php" width="100%" height="60"></iframe>
        <div class="box"></div>
        <p>Users:</p>
        <?php
        include "database.php";
        $sql = "SELECT * FROM users";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Email</th>";
            echo "<th>Telephone</th>";
            echo "<th>Is a</th>";
            echo "<th>Delete?</th>";
            echo "</tr>";

            while ($res = mysqli_fetch_array($result)) {
                $id = $res['ID'];
                echo "<tr>";
                echo "<td>" . $res['FirstName'] . "</td>";
                echo "<td>" . $res['LastName'] . "</td>";
                echo "<td>" . $res['Email'] . "</td>";
                echo "<td>" . $res['Telephone'] . "</td>";
                echo "<td>" . $res['IS_A'] . "</td>";
                echo "<td><a href=\"deleteuser.php?id=$id\" onClick=\"return confirm('Are you sure you want to delete?')\" class=\"btn btn-danger\">X</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found.</p>";
        }
        ?>
        <p>Events:</p>
        <?php
        include "database.php";
        $sql = "SELECT * FROM events";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Event Name</th>";
            echo "<th>Information</th>";
            echo "<th>Type</th>";
            echo "<th>Date</th>";
            echo "<th>Time</th>";
            echo "<th>Number of Seats</th>";
            echo "<th>Unbooked Seats</th>";
            echo "<th>Event Poster</th>";
            echo "<th>Delete?</th>";
            echo "</tr>";

            while ($res = mysqli_fetch_array($result)) {
                $id = $res['id'];
                $image_name = $res['poster_name'];
                $image_data = $res['poster_data'];
                $image_type = getImageTypeFromData($image_data);

                echo "<tr>";
                echo "<td>" . $res['eventName'] . "</td>";
                echo "<td>" . $res['infoAboutEvent'] . "</td>";
                echo "<td>" . $res['eventType'] . "</td>";
                echo "<td>" . $res['eventDate'] . "</td>";
                echo "<td>" . $res['eventTime'] . "</td>";
                echo "<td>" . $res['maxPeople'] . "</td>";
                echo "<td>" . ($res['maxPeople'] - $res['numberOfPeople']) . "</td>";
                echo '<td><img id="imagesize2" src="data:' . $image_type . ';base64,' . base64_encode($image_data) . '"></td>';
                echo "<td><a href=\"Deleteevent.php?id=$id\" onClick=\"return confirm('Are you sure you want to delete?')\" class=\"btn btn-danger\" >X</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No events found.</p>";
        }
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
        <p>Registering Events to accept: </p>
        <table>
            <tr>
                <th>Event Name</th>
                <th>Information</th>
                <th>Type</th>
                <th>Date</th>
                <th>Time</th>
                <th>Number of Seats</th>
                <th>Event Poster</th>
                <th>Accept?</th>
                <th>Reject?</th>
            </tr>
            <?php
            include "database.php";
            $sql = "SELECT * FROM events";
            $result = $con->query($sql);
            $nb = 0;
            if ($result->num_rows > 0) {
                while ($res = mysqli_fetch_array($result)) {
                    if ($res['accepted'] == false) {
                        $nb = $nb + 1;
                        $image_name = $res['poster_name'];
                        $image_data = $res['poster_data'];
                        $image_type = getImageTypeFromData($image_data);
                        $id = $res['id'];
                        echo "<tr>";
                        echo "<td>" . $res['eventName'] . "</td>";
                        echo "<td>" . $res['infoAboutEvent'] . "</td>";
                        echo "<td>" . $res['eventType'] . "</td>";
                        echo "<td>" . $res['eventDate'] . "</td>";
                        echo "<td>" . $res['eventTime'] . "</td>";
                        echo "<td>" . $res['maxPeople'] . "</td>";
                        echo '<td><img id="imagesize2" src="data:' . $image_type . ';base64,' . base64_encode($image_data) . '"></td>';
                        echo "<td><a href=\"Acceptevent.php?id=$id\" onClick=\"return confirm('Are you sure you want to accept it?')\" class=\"btn btn-success\">✓</a></td>";
                        echo "<td><a href=\"Deleteevent.php?id=$id\" onClick=\"return confirm('Are you sure you want to reject it?')\" class=\"btn btn-danger\">X</a></td>";
                        echo "</tr>";
                    }
                }
            }
            if ($nb == 0) {
                echo "<tr><td colspan='9'>No registering events to accept found.</td></tr>";
            }
            ?>
        </table>
        <p>Registering Administrators to accept:</p>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Is a</th>
                <th>Accept?</th>
                <th>Reject?</th>
            </tr>
            <?php
            include "database.php";
            $sql = "SELECT u.* FROM users u JOIN request_admin ra ON u.ID = ra.userid";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                while ($res = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $res['FirstName'] . "</td>";
                    echo "<td>" . $res['LastName'] . "</td>";
                    echo "<td>" . $res['Email'] . "</td>";
                    echo "<td>" . $res['Telephone'] . "</td>";
                    echo "<td>" . $res['IS_A'] . "</td>";
                    echo "<td><a href=\"Acceptadmin.php?id=" . $res['ID'] . "\" onClick=\"return confirm('Are you sure you want to accept him?')\" class=\"btn btn-success\">✓</a></td>";
                    echo "<td><a href=\"rejectadmin.php?id=" . $res['ID'] . "\" onClick=\"return confirm('Are you sure you want to reject him?')\" class=\"btn btn-danger\">X</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No administrators to accept.</td></tr>";
            }
            ?>
        </table>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>