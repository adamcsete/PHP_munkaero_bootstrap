<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>Munkaer� nyilv�ntart�</title>
<style>
    body{ padding-left: 20px; background-color:#E6E6FA; }
 </style>
 </head>
 <body>
<br>
<form method="post" action="index2.php">
<input type="submit" class="btn btn-secondary" value="Dolgoz�k lek�rdez�se: ">
<select name="szures">
  <option value=""></option>
  <option value="nev">n�v szerint</option>
  <option value="fizetes">fizet�s szerint</option>
  <option value="bank">bankra csoportos�tva</option>
  <option value="szervezet">szervezeti egys�g szerint</option>
</select>
</form> 
<br>
<form method="post" action="add.php">
<input type="submit" class="btn btn-secondary" value="Dolgoz� felvitele">
</form>
<br>
<form method="post" action="alter.php">
<input type="submit" class="btn btn-secondary" value="Dolgoz� adatainak m�dos�t�sa">
</form>
<br>
<form method="post" action="delete.php">
<input type="submit" class="btn btn-secondary" value="Dolgoz� t�rl�se">
</form>
<br>
<form method="post" action="alterjob.php">
<input type="submit" class="btn btn-secondary" value="Munkak�r hozz�ad�sa/elt�vol�t�sa">
</form>
<br>
<form method="post" action="alterfield.php">
<input type="submit" class="btn btn-secondary" value="Szervezeti egys�g hozz�ad�sa/elt�vol�t�sa">
</form>
<br><br>



<?php
$servername = "127.0.0.1";
$username = "adamcsete";
$password = "91acEF";
$dbname = "adamcsete";

$option = $_POST['szures'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else
{
  //preselect for munkak�r and szervezet
  $sqlmun = "SELECT beazon, beosztas FROM beosztas;";
  $resultmun = $conn->query($sqlmun);
  $sqlsze = "SELECT terazon, terulet FROM terulet ORDER BY terulet;";
  $resultsze = $conn->query($sqlsze);
  if ($resultmun->num_rows > 0) {
    while($row = $resultmun->fetch_assoc()) {
        $munka[$row['beazon']] = $row['beosztas'];
    }
  }
  if ($resultsze->num_rows > 0) {
    while($row = $resultsze->fetch_assoc()) {
        $szerv[$row['terazon']] = $row['terulet'];
    }
  }

  //setting up filter select
  if ($option === 'nev'){
    $sql = "SELECT id, nev, munkakor, szervegy, fizetes, adoaz, taj, szamla FROM dolgozok ORDER BY nev;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table>
            <tr>
              <th>Dolgoz� azonos�t�</th>
              <th>N�v</th>
              <th>Munkak�r</th>
              <th>Szervezeti egys�g</th>
              <th>Fizet�s (butt� HUF)</th>
              <th>Ad�azonos�t�</th>
              <th>TAJ</th>
              <th>Banksz�mlasz�m</th>
            </tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td>
                  <td>".$row["nev"]."</td>
                  <td>".$munka[$row["munkakor"]]."</td>
                  <td>".$szerv[$row["szervegy"]]."</td>
                  <td>".$row["fizetes"]."</td>
                  <td>".$row["adoaz"]."</td>
                  <td>".$row["taj"]."</td>
                  <td>".$row["szamla"]."</td>
              </tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
  }
  elseif ($option === 'fizetes')
  {
    $sql = "SELECT id, nev, munkakor, szervegy, fizetes, adoaz, taj, szamla FROM dolgozok ORDER BY fizetes;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table>
            <tr>
              <th>Dolgoz� azonos�t�</th>
              <th>N�v</th>
              <th>Munkak�r</th>
              <th>Szervezeti egys�g</th>
              <th>Fizet�s (butt� HUF)</th>
              <th>Ad�azonos�t�</th>
              <th>TAJ</th>
              <th>Banksz�mlasz�m</th>
            </tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td>
                  <td>".$row["nev"]."</td>
                  <td>".$munka[$row["munkakor"]]."</td>
                  <td>".$szerv[$row["szervegy"]]."</td>
                  <td>".$row["fizetes"]."</td>
                  <td>".$row["adoaz"]."</td>
                  <td>".$row["taj"]."</td>
                  <td>".$row["szamla"]."</td>
              </tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
  }
  elseif ($option === 'bank')
  {
    $sql = "SELECT id, nev, munkakor, szervegy, fizetes, adoaz, taj, szamla FROM dolgozok ORDER BY SUBSTRING(szamla,1,3);";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table>
            <tr>
              <th>Dolgoz� azonos�t�</th>
              <th>N�v</th>
              <th>Munkak�r</th>
              <th>Szervezeti egys�g</th>
              <th>Fizet�s (butt� HUF)</th>
              <th>Ad�azonos�t�</th>
              <th>TAJ</th>
              <th>Banksz�mlasz�m</th>
            </tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td>
                  <td>".$row["nev"]."</td>
                  <td>".$munka[$row["munkakor"]]."</td>
                  <td>".$szerv[$row["szervegy"]]."</td>
                  <td>".$row["fizetes"]."</td>
                  <td>".$row["adoaz"]."</td>
                  <td>".$row["taj"]."</td>
                  <td>".$row["szamla"]."</td>
              </tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
  }
  elseif ($option === 'szervezet')
  {
    $sql = "SELECT id, nev, munkakor, szervegy, fizetes, adoaz, taj, szamla FROM dolgozok ORDER BY szervegy;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table>
            <tr>
              <th>Dolgoz� azonos�t�</th>
              <th>N�v</th>
              <th>Munkak�r</th>
              <th>Szervezeti egys�g</th>
              <th>Fizet�s (butt� HUF)</th>
              <th>Ad�azonos�t�</th>
              <th>TAJ</th>
              <th>Banksz�mlasz�m</th>
            </tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td>
                  <td>".$row["nev"]."</td>
                  <td>".$munka[$row["munkakor"]]."</td>
                  <td>".$szerv[$row["szervegy"]]."</td>
                  <td>".$row["fizetes"]."</td>
                  <td>".$row["adoaz"]."</td>
                  <td>".$row["taj"]."</td>
                  <td>".$row["szamla"]."</td>
              </tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }

  }
  else
  { 
    $sql = "SELECT id, nev, munkakor, szervegy, fizetes, adoaz, taj, szamla FROM dolgozok;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table>
            <tr>
              <th>Dolgoz� azonos�t�</th>
              <th>N�v</th>
              <th>Munkak�r</th>
              <th>Szervezeti egys�g</th>
              <th>Fizet�s (butt� HUF)</th>
              <th>Ad�azonos�t�</th>
              <th>TAJ</th>
              <th>Banksz�mlasz�m</th>
            </tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td>
                  <td>".$row["nev"]."</td>
                  <td>".$munka[$row["munkakor"]]."</td>
                  <td>".$szerv[$row["szervegy"]]."</td>
                  <td>".$row["fizetes"]."</td>
                  <td>".$row["adoaz"]."</td>
                  <td>".$row["taj"]."</td>
                  <td>".$row["szamla"]."</td>
              </tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
  }
}













$conn->close();
?>

<br>
<form method="post" action="updates.php">
<input type="submit" class="btn btn-secondary" value="V�ltoz�sok list�z�sa">
</form>
<br>
</body>
</html>