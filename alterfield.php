<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>Munkaerõ nyilvántartó</title>
<style>
    body{ padding-left: 20px; background-color:#E6E6FA; }
 </style>
<script>
function validateForm(){
    if(document.forms["addfield"]["ujfieldaz"].value.length!=3){
      alert("Szervezeti egység azonosítónak 3 karakternek kell lennie!");
      return false;
    }
    if(document.forms["addfield"]["ujfieldnev"].value.length==""){
      alert("Szervezeti egység teljes nevét kötelezõ megadni!");
      return false;
    }

}
</script>
</head>
<body>
<form method="post" action="index2.php">
<input class="btn btn-secondary" type=submit value="Vissza a lekérdezéshez">
</form>
<br><div style="font-weight:bold;">Szervezeti egység hozzáadása/eltávolítása</div><br>
<form method="post" name="addfield" action="alterfield.php">
    <label>Szervezeti egység azonosítója: </label>
    <input type=text value="" name="ujfieldaz"><label> (3 karakter): </label><br><br>
    <label>Szervezeti egység teljes neve: </label>
    <input type=text value="" name="ujfieldnev"><br><br>
    <input class="btn btn-secondary" type=submit value="Új szervezeti egység felvitele" name="fieldadd" onclick="return validateForm();">
</form>
<br><br><br>
<form method="post" name="deletefield" action="alterfield.php" >
    <label>Eltávolítandó Szervezeti egység azonosítója: </label>
    <input type=text value="" name="delazon">
    <input class="btn btn-secondary" type=submit value="Szervezeti egység törlése" name=fielddel><label id="cantdel" style="color:red; "></label>
</form>
<br><br>




<?php
$servername = "127.0.0.1";
$username = "adamcsete";
$password = "91acEF";
$dbname = "adamcsete";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
    //add a new field
    if(isset($_POST['fieldadd'])){
        $ujaz = $_POST['ujfieldaz'];
        $ujnev = $_POST['ujfieldnev'];
        $sql = "INSERT INTO terulet (terazon, terulet) VALUES('$ujaz', '$ujnev');";
        $conn->query($sql);
        //save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Új szervezeti egység hozzáadása: '$ujaz' '$ujnev'</a>\");"; 
		$conn->query($sqllog);
    }

    if(isset($_POST['fielddel'])){
        //check if field is in use
        $fieldtodel = $_POST['delazon'];
        $isDelOK = True;
        $sql = "SELECT id, szervegy FROM dolgozok;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row['szervegy'] == $fieldtodel){
                    $isDelOK = False; 
                }
            }

        }
        
        
        if(!$isDelOK){
            echo "<script>document.getElementById('cantdel').innerHTML=' - Szervezeti egység nem törölhetõ, mert használatban van!';</script>";
        }else{
            //delete field from table terulet
            $sql = "DELETE FROM terulet WHERE terazon = '$fieldtodel';";
            $conn->query($sql);
            //save to valtozas table
            $sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:red'>Szervezeti egység törölve: '$fieldtodel'</a>\");"; 
            $conn->query($sqllog);
        }
    }


    //show field descriptions
    $sql = "SELECT terazon, terulet FROM terulet;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>
              <tr>
                <th>Szervezeti egység azonosító</th>
                <th>Szervezeti egység teljes neve</th> 
              </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>".$row["terazon"]."</td>
                    <td>".$row["terulet"]."</td>
                </tr>";
        }
        echo "</table>";
      } 
    else {
        echo "0 results";
    }
    
    
    
}


?>

<br>
</body>
</html>