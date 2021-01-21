<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>Munkaerõ nyilvántartó</title>
<style>
    body{ padding-left: 20px; background-color:#E6E6FA; }
 </style>
 </head>
 <body>
 <form method="post" action="index2.php">
 <input class="btn btn-secondary" type="submit" value="Vissza a lekérdezéshez"/>
</form>
<br><h3 style="font-weight: bold;">Változások listája:</h3>
</body>
</html>


<?php

$servername = "127.0.0.1";
$username = "adamcsete";
$password = "91acEF";
$dbname = "adamcsete";
    
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//show updates from valtozas table
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else
{ 
    $sql = "SELECT id, valtoztatas FROM valtozas;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table>
            <tr>
              <th>Változás azonosítója</th>
              <th>Változtatás</th>
            </tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td>
                  <td>".$row["valtoztatas"]."</td>
              </tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
}