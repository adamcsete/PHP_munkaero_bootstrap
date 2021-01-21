<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>Munkaer� nyilv�ntart�</title>
<style>
    body{ padding-left: 20px; background-color:#E6E6FA; }
 </style>
<script>
  //input validation
  function validateForm() {
    //check if name is missing
    var x1 = document.forms["add"]["name"].value;
    if (x1 == "") {
      alert("N�v megad�sa k�telez�!");
      return false;
    }
    
    //check if job is missing
    var x2 = document.forms["add"]["job"].value;
    if (x2 == "") {
      alert("Munkak�r megad�sa k�telez�!");
      return false;
    }
    
    //check if salary is missing
    var x3 = document.forms["add"]["money"].value;
    if (x3 == "") {
      alert("Fizet�s megad�sa k�telez�!");
      return false;
    }
    
    //check if tax is missing
    var x4 = document.forms["add"]["tax"].value;
    if (x4 == "") {
      alert("Ad�sz�m megad�sa k�telez�!");
      return false;
    }
    //check if tax has wrong format
    if(x4.length!=10)
    {
      alert("Ad�sz�m hossza nem megfelel�!");
      return false;
    }
    //check if tax is valid
    if(x4[0]!='8')
    {
      alert("Az ad�sz�mnak 8-as sz�mmal kell kezd�dnie!");
      return false;
    }
    var x4check = (x4[0]*1+x4[1]*2+x4[2]*3+x4[3]*4+x4[4]*5+x4[5]*6+x4[6]*7+x4[7]*8+x4[8]*9) % 11;
	  if(x4check!=x4[9])
    {
      alert("Hib�s ad�sz�m: ellen�rz� sz�m nem megfelel�");
      return false;
    }

    //check if NHS number is missing
    var x5 = document.forms["add"]["heal"].value;
    if (x5 == "") {
      alert("TAJ sz�m megad�sa k�telez�!");
      return false;
    }
    //check if NHS number has wrong format
    if(x5.length!=9)
    {
      alert("TAJ sz�m hossza nem megfelel�!");
      return false;
    }
    //check if NHS number is valid
    var x5check = (x5[0]*3 + x5[1]*7 + x5[2]*3 + x5[3]*7 + x5[4]*3 + x5[5]*7 + x5[6]*3 + x5[7]*7) % 10;
	  if(x5check!=x5[8])
	  {
      alert("Hib�s TAJ sz�m: ellen�rz� sz�m nem megfelel�!");
      return false;
    }

    //check if bank account number 1-8 is missing
    var x6 = document.forms["add"]["banknum1"].value;
    if (x6 == "") {
      alert("Banksz�mlasz�m megad�sa k�telez�!");
      return false;
    }
    //check bank account number 1-8 length
    if(x6.length!=8)
    {
      alert("Banksz�mlasz�m hossza nem megfelel�!");
      return false;
    }
    //check if bank account number 1-8 is valid
    var x6 = document.forms["add"]["banknum1"].value;  
	  var x6check = String(x6[0]*9 + x6[1]*7 + x6[2]*3 + x6[3]*1 + x6[4]*9 + x6[5]*7 + x6[6]*3);
	  var x6last = x6check[x6check.length-1];
	  var ell = String(10 - x6last);
	  if (ell == 10) ell = 0;
	  if(ell != x6[7])
	  {
      alert("Banksz�mlasz�m els� tagja hib�s!");
      return false;
    }

    //check if bank account number 9-16 is missing
    var x7 = document.forms["add"]["banknum2"].value;
    if (x7 == "") {
      alert("Banksz�mlasz�m megad�sa k�telez�!");
      return false;
    }
    //check bank account number 9-16 length
    if(x7.length!=8)
    {
      alert("Banksz�mlasz�m hossza nem megfelel�!");
      return false;
    }
    //check if bank account number 9-16 is valid
    var x7 = document.forms["add"]["banknum2"].value;  
	  var x7check = String(x7[0]*9 + x7[1]*7 + x7[2]*3 + x7[3]*1 + x7[4]*9 + x7[5]*7 + x7[6]*3);
	  var x7last = x7check[x7check.length-1];
	  var ell = String(10 - x7last);
	  if (ell == 10) ell = 0;
	  if(ell != x7[7])
	  {
      alert("Banksz�mlasz�m m�sodik tagja hib�s!");
      return false;
    }
    //check if bank account number 17-24 is valid
    var x8 = document.forms["add"]["banknum3"].value;  
	  if(x8!=""){
      var x8check = String(x8[0]*9 + x8[1]*7 + x8[2]*3 + x8[3]*1 + x8[4]*9 + x8[5]*7 + x8[6]*3);
      var x8last = x8check[x8check.length-1];
      var ell = String(10 - x8last);
      if (ell == 10) ell = 0;
	    if(ell != x8[7])
      {
        alert("Banksz�mlasz�m harmadik tagja hib�s!");
        return false;
      }
    }

    

  }
</script>
</head>
<body>
<form method="post" action="index2.php">
<input type="submit" class="btn btn-secondary" value="Vissza a lek�rdez�shez">
</form>
<br><div style="font-weight:bold;">Dolgoz� hozz�ad�sa</div>
<form method="post" name="add" action="add.php" onsubmit="return validateForm()"><br><br>
<table>
<tr><td>N�v:</td><td><input type="text" name="name" value=""><a style="color:red;"> *</a></td></tr>
<tr><td>Munkak�r:</td> 
<td><select name="job">
       <?php
          $servername = "127.0.0.1";
          $username = "adamcsete";
          $password = "91acEF";
          $dbname = "adamcsete";
          //Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);
      
          //preselect for munkak�r
          $sqlmun = "SELECT beosztas FROM beosztas;";
          $resultmun = $conn->query($sqlmun);
          
          if ($resultmun->num_rows > 0) {
            while($row = $resultmun->fetch_assoc()) {
              echo "<option value='".$row['beosztas']."'>".$row['beosztas']."</option>";
            }
          }
          $conn->close();
        ?>
    </select><a style="color:red;"> *</a>
</td></tr>
<tr><td>Szervezeti egys�g:</td>
<td><select name="field">
        <?php
          $servername = "127.0.0.1";
          $username = "adamcsete";
          $password = "91acEF";
          $dbname = "adamcsete";
          //Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);
      
          //preselect for szervezet
          $sqlsze = "SELECT terulet FROM terulet;";
          $resultsze = $conn->query($sqlsze);
          
          if ($resultsze->num_rows > 0) {
            while($row = $resultsze->fetch_assoc()) {
              echo "<option value='".$row['terulet']."'>".$row['terulet']."</option>";
            }
          }
          $conn->close();
        ?>
    </select>
</td></tr>
<tr><td>Fizet�s:</td><td><input type="text" name="money" value=""><a style="color:red;"> *</a></td>
<tr><td>Ad�azonos�t�:</td><td><input type="text" name="tax" value="";"><a style="color:red;"> *</a></td>
<tr><td>TAJ:</td><td> <input type="text" name="heal" value=""><a style="color:red;"> *</a></td></tr>
<tr><td>Banksz�mlasz�m:</td><td><input type="text" name="banknum1" value="">-<input type="text" name="banknum2" value="">-<input type="text" name="banknum3" value=""><a style="color:red;"> *</a></td></tr>
</table><br>
<input type="submit" class="btn btn-secondary" value="Dolgoz� felv�tele">
</form>
<br><br>
</body>
</html>



<?php
$servername = "127.0.0.1";
$username = "adamcsete";
$password = "91acEF";
$dbname = "adamcsete";

$banknum3 = $_POST['banknum3'];
if($banknum3==""){
  $banknum3="00000000";
}

$nev = $_POST['name'];
$mun = $_POST['job'];
$sze = $_POST['field'];
$fiz = $_POST['money'];
$ado = $_POST['tax'];
$taj = $_POST['heal'];
$ban = $_POST['banknum1']."-".$_POST['banknum2']."-".$banknum3;


//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
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
          if($mun==$munka[$row['beazon']]){
            $beazon = $row['beazon'];
          }
      }
    }
    if ($resultsze->num_rows > 0) {
      while($row = $resultsze->fetch_assoc()) {
          $szerv[$row['terazon']] = $row['terulet'];
          if($sze==$szerv[$row['terazon']]){
            $terazon = $row['terazon'];
          }
      }
    }

    //insert into table
    if($nev!=""){
        $sql = "INSERT INTO $dbname.dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) VALUES ('$nev', '$beazon', '$terazon', $fiz, '$ado', '$taj', '$ban');";    
        if ($conn->query($sql) === TRUE) {
            echo "Dolgoz� hozz�adva";
            //save to valtozas table
            $sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $nev $beazon $terazon $fiz $ado $taj $ban</a>\");"; 
            $conn->query($sqllog);
        } else {
            echo "Hiba: " . $sql . "<br>" . $conn->error;
        }
    }  

    //output SELECT
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







    // close connection
    $conn->close();
    echo "<br>";
?>