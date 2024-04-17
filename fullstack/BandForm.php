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
            <p1 class="title-text">Band</p1>
            <form class="sub-form-border" action="BandForm.php" method="POST"><br>
                <label for="name">Band Naam:</label><br>
                <input type="text" id="name" name="name" placeholder="Band name"><br>                       <!-- name = name -->
                <label for="genre">Genre</label><br>
                <input type="text" id="genre" name="genre" placeholder="Music genre"><br>                   <!-- name = genre -->
                <label for="members">Aantal Leden</label></br>
                <input type="text" id="members" name="members" placeholder="Member count"><br><br>          <!-- name = members -->
                <input type="submit" value="Send" name="send_band">
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

if (isset($_POST['send_band'])) {
            $stmt = $conn->prepare("INSERT INTO bands (BandNaam, Genre, AantalLeden) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $_POST['name'], $_POST['genre'], $_POST['members']);
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