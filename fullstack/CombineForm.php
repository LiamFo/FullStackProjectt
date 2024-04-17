<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Casus Cafe
    </title>
</head>

<body>
    <div class="text-font form-border-combine">
        <div>
        <div>
            <h1 class="title-text">Combineer Event met Band</h1>
            <form class="form-border" action="CombineForm.php" method="POST"><br>
                <label for="chooseevent">Kies bestaande event:</label><br>
                <select name="chooseevent" style="width:150px;">
                    <?php
                    include "connection.php";
                    $stmt = $conn->prepare("SELECT EventNaam, EventID FROM events");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        //echo "<option value=\"{$row['EventID']}\">{$row['EventNaam']}</option>";
                        echo '<option value="'.$row["EventID"].'">'.$row["EventNaam"].'</option>';
                    }
                    ?>
                </select><br><br>
                <label for="chooseband">Kies bestaande band:</label><br>
                <select name="chooseband" style="width:150px;">
                    <?php
                    $stmt = $conn->prepare("SELECT BandNaam, BandID FROM bands");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"{$row['BandID']}\">{$row['BandNaam']}</option>";
                    }
                    ?>
                </select><br><br><br>
                <input type="submit" value="Send" name="send_createevent">
            </form>
        </div>
    </div>
    <br>
    <br>
    <button onclick="document.location='Menu.php'">Menu</button>

    <br><br>
    <div class="result-box">
        <?php
        include "connection.php";

        if (isset($_POST['send_createevent'])) {

            $stmt = $conn->prepare("INSERT INTO eventmaken (EventID, BandID) VALUES (?, ?)");
            $stmt->bind_param("ii", $_POST['chooseevent'], $_POST['chooseband']);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "Band successfully added.<br>";
            } else {
                echo "Error adding band: " . $conn->error;
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