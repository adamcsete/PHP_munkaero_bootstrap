<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>Munkaer� nyilv�ntart�</title>
<style>
    body{ padding-left: 20px; background-color:#E6E6FA; }
 </style>
<script>
function validateForm(){
    if(document.forms["addfield"]["ujfieldaz"].value.length!=3){
      alert("Szervezeti egys�g azonos�t�nak 3 karakternek kell lennie!");
      return false;
    }
    if(document.forms["addfield"]["ujfieldnev"].value.length==""){
      alert("Szervezeti egys�g teljes nev�t k�telez� megadni!");
      return false;
    }

}
</script>
</head>
<body>
<form method="post" action="index2.php">
<input class="btn btn-secondary" type=submit value="Vissza a lek�rdez�shez">
</form>
<br><div style="font-weight:bold;">Szervezeti egys�g hozz�ad�sa/elt�vol�t�sa</div><br>
<form method="post" name="addfield" action="alterfield.php">
    <label>Szervezeti egys�g azonos�t�ja: </label>
    <input type=text value="" name="ujfieldaz"><label> (3 karakter): </label><br><br>
    <label>Szervezeti egys�g teljes neve: </label>
    <input type=text value="" name="ujfieldnev"><br><br>
    <input class="btn btn-secondary" type=submit value="�j szervezeti egys�g felvitele" name="fieldadd" onclick="return validateForm();">
</form>
<br><br><br>
<form method="post" name="deletefield" action="alterfield.php" >
    <label>Elt�vol�tand� Szervezeti egys�g azonos�t�ja: </label>
    <input type=text value="" name="delazon">
    <input class="btn btn-secondary" type=submit value="Szervezeti egys�g t�rl�se" name=fielddel><label id="cantdel" style="color:red; "></label>
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
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>�j szervezeti egys�g hozz�ad�sa: '$ujaz' '$ujnev'</a>\");"; 
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
            echo "<script>document.getElementById('cantdel').innerHTML=' - Szervezeti egys�g nem t�r�lhet�, mert haszn�latban van!';</script>";
        }else{
            //delete field from table terulet
            $sql = "DELETE FROM terulet WHERE terazon = '$fieldtodel';";
            $conn->query($sql);
            //save to valtozas table
            $sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:red'>Szervezeti egys�g t�r�lve: '$fieldtodel'</a>\");"; 
            $conn->query($sqllog);
        }
    }


    //show field descriptions
    $sql = "SELECT terazon, terulet FROM terulet;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>
              <tr>
                <th>Szervezeti egys�g azonos�t�</th>
                <th>Szervezeti egys�g teljes neve</th> 
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