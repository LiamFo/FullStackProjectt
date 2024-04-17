<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Casus Cafe
    </title>
</head>
<body>

<table>
  <tr>
    <th>Event</th>
    <th>Datum</th>
    <th>Ontvangingstijd</th>
    <th>Entree Prijs</th>
    <th>Band</th>
    <th>Genre</th>
    <th>Aantal Leden</th>
  </tr>


<?php
include "connection.php";
$stmt = $conn->prepare("SELECT events.EventID, events.EventNaam, events.Datum, events.Ontvangingstijd, events.EntreePrijs, bands.BandNaam, bands.Genre, bands.AantalLeden
FROM events
INNER JOIN bands ON bands.BandID = events.EventID;");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $value){
    echo "<td>".$value."</td>";
    }
    echo "</tr>";
}

// echo "SELECT event.EventID, event.EventNaam, event.Datum, event.Ontvangingstijd, event.EntreePrijs;
//     FROM event
//     INNER JOIN bands ON bands.BandID=event.BandID;";

?>
</table>
</body>
</html>