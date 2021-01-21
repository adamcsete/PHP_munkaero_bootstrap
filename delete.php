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
<form method="post" action="index2.php">
<input class="btn btn-secondary" type=submit value="Vissza a lek�rdez�shez">
</form>
<br><div style="font-weight:bold;">Dolgoz� t�rl�se</div><br>
<form method="post" action="delete.php">
<label >Dolgoz� azonos�t�ja: </label>
<input type=text name="dp" value="">
<input class="btn btn-secondary" type=submit name="torol" value="T�rl�s">
</form>
<br><br>
</body>
</html>

<?php
    $servername = "127.0.0.1";
    $username = "adamcsete";
    $password = "91acEF";
    $dbname = "adamcsete";
    $dolgozo = $_POST['dp'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else{
          //preselect for munkak�r and szervezet
          $sqlmun = "SELECT beazon, beosztas FROM beosztas;";
          $resultmun = $conn->query($sqlmun);
          $sqlsze = "SELECT terazon, terulet FROM terulet;";
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

        //delete from database
        if(isset($_POST['torol'])){
            $sql = "DELETE FROM dolgozok WHERE id=$dolgozo;";
            $conn->query($sql);
            //save to valtozas table
            $sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:red'>'$dolgozo' azonos�t�j� dolgoz� t�r�lve</a>\");"; 
            $conn->query($sqllog);
        }
    
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

    $conn->close();
    echo "<br>";
?>