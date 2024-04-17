<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Casus Cafe
    </title>
</head>

<body>
    <div class="form-border text-font">
        <div>
            <p1 class="title-text">Event</p1>
            <form class="sub-form-border" action="EventForm.php" method="POST"><br><br>
                <label for="date">Datum:</label><br>
                <input type="date" id="date" name="date" placeholder="Event date"><br><br>                      <!-- name = date -->
                <label for="time">Ontvangingstijd</label><br>
                <input type="time" id="time" name="time" placeholder="Event time"><br><br>                      <!-- name = time -->
                <label for="eventname">Event Naam</label><br>
                <input type="text" id="eventname" name="eventname" placeholder="Event name"></label><br><br>    <!-- name = eventname -->
                <label for="eventname">Entree Prijs</label><br>
                <input type="text" id="price" name="price" placeholder="Entry price"></label><br><br>           <!-- name = price -->
                <input type="submit" value="Send" name="send_event">
            </form><br><br>
        </div>
    </div>
    <br>
    <br>
    <button onclick="document.location='Menu.php'">Menu</button>

    <br><br>
    <div class="result-box">
        <?php
        include "connection.php";

        if (isset($_POST['send_event'])) {
            // Using prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO events (Datum, Ontvangingstijd, EventNaam, EntreePrijs) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $_POST['date'], $_POST['time'], $_POST['eventname'], $_POST['price']);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "Event successfully added.<br>";
            } else {
                echo "Error adding event: " . $conn->error;
            }
        }
            

        // Close statement and connection
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
        ?>
    </div>
</body>
</html>