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
    if(document.forms["addjob"]["ujjobaz"].value.length!=3){
      alert("Munkak�r azonos�t�nak 3 karakternek kell lennie!");
      return false;
    }
    if(document.forms["addjob"]["ujjobnev"].value.length==""){
      alert("Munkak�r teljes nev�t k�telez� megadni!");
      return false;
    }

}
</script>
</head>
<body>
<form method="post" action="index2.php">
<input class="btn btn-secondary" type=submit value="Vissza a lek�rdez�shez">
</form>
<br><div style="font-weight:bold;">Munkak�r hozz�ad�sa/elt�vol�t�sa</div><br>
<form method="post" name="addjob" action="alterjob.php">
    <label>Munkak�r azonos�t�ja: </label>
    <input type=text value="" name="ujjobaz"><label> (3 karakter): </label><br><br>
    <label>Munkak�r teljes neve: </label>
    <input type=text value="" name="ujjobnev"><br><br>
    <input class="btn btn-secondary" type=submit value="�j munkak�r felvitele" name="jobadd" onclick="return validateForm();">
</form>
<br><br><br>
<form method="post" name="deletejob" action="alterjob.php" >
    <label>Elt�vol�tand� munkak�r azonos�t�ja: </label>
    <input type=text value="" name="delazon">
    <input class="btn btn-secondary" type=submit value="Munkak�r t�rl�se" name=jobdel><label id="cantdel" style="color:red; "></label>
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
    //add a new job
    if(isset($_POST['jobadd'])){
        $ujaz = $_POST['ujjobaz'];
        $ujnev = $_POST['ujjobnev'];
        $sql = "INSERT INTO beosztas (beazon, beosztas) VALUES('$ujaz', '$ujnev');";
        $conn->query($sql);
        //save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>�j munkak�r hozz�ad�sa: '$ujaz' '$ujnev'</a>\");"; 
		$conn->query($sqllog);
    }

    if(isset($_POST['jobdel'])){
        //check if job is in use
        $jobtodel = $_POST['delazon'];
        $isDelOK = True;
        $sql = "SELECT id, munkakor FROM dolgozok;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row['munkakor'] == $jobtodel){
                    $isDelOK = False; 
                }
            }

        }
        
        
        if(!$isDelOK){
            echo "<script>document.getElementById('cantdel').innerHTML=' - Munkak�r nem t�r�lhet�, mert haszn�latban van!';</script>";
        }else{
            //delete job from table beosztas
            $sql = "DELETE FROM beosztas WHERE beazon = '$jobtodel';";
            $conn->query($sql);
            //save to valtozas table
            $sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:red'>Munkak�r t�r�lve: '$jobtodel'</a>\");"; 
            $conn->query($sqllog);
        }
    }


    //show job descriptions
    $sql = "SELECT beazon, beosztas FROM beosztas;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>
              <tr>
                <th>Munkak�r azonos�t�</th>
                <th>Munkak�r teljes neve</th> 
              </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>".$row["beazon"]."</td>
                    <td>".$row["beosztas"]."</td>
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