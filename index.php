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
 <input class="btn btn-primary" type="submit" value="Tov�bb a nyilv�ntart�hoz"/>
</form>
<br><h3 style="font-weight: bold;">Adatb�zis felt�lt�se mintaadatokkal:</h3>
</body>
</html>


<?php

    $servername = "127.0.0.1";
	$username = "adamcsete";
	$password = "91acEF";
	$dbname = "adamcsete";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		echo ("x Kapcsol�d�s hiba : " . $conn->connect_error . "<br>");
	}
	else { 
		echo ("Sikeres kapcsol�d�s az adatb�zishoz<br>");
		
		//drop former database
		$sql = "DROP DATABASE $dbname;";
		if ($conn->query($sql) === TRUE) {echo ("Kor�bbi adatb�zis t�rl�se rendben<br>");} 
		else {echo ("x Kor�bbi adatb�zis t�rl�s hiba: " . $conn->error . "<br>");}

		// Create database
		$sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8 COLLATE utf8_unicode_ci;";
		if ($conn->query($sql) === TRUE) {echo ("Adatb�zis l�trehoz�s rendben<br>");} 
		else {echo ("x Adatb�zis l�trehoz�s hiba: " . $conn->error . "<br>");}

		//selecting database 
		$conn -> select_db($dbname);
		
		// sql to create table: dolgozok
		$sql = "CREATE TABLE IF NOT EXISTS dolgozok (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			nev VARCHAR(50) NOT NULL,
			munkakor VARCHAR(50) NOT NULL,
			szervegy VARCHAR(50),
			fizetes INT(10) NOT NULL,
			adoaz VARCHAR(10) NOT NULL,
			taj VARCHAR(9) NOT NULL,
			szamla VARCHAR(26) NOT NULL
			);";	
		if ($conn->query($sql) === TRUE) {echo "'dolgozok' t�bla l�trehoz�s rendben<br>"; } 
		else {echo "x T�bla l�trehoz�s hiba: " . $conn->error . "<br>";}

		// sql to create table: valtozas
		$sql = "CREATE TABLE IF NOT EXISTS valtozas (
			id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			valtoztatas VARCHAR(1000) NOT NULL
			);";	
		if ($conn->query($sql) === TRUE) {echo "'valtozas' t�bla l�trehoz�s rendben<br>"; } 
		else {echo "x T�bla l�trehoz�s hiba: " . $conn->error . "<br>";}

		// sql to create table: beosztas
		$sql = "CREATE TABLE IF NOT EXISTS beosztas (
			beazon VARCHAR(3) NOT NULL PRIMARY KEY, 
			beosztas VARCHAR(100) NOT NULL
			);";	
		if ($conn->query($sql) === TRUE) {echo "'beosztas' t�bla l�trehoz�s rendben<br>"; } 
		else {echo "x T�bla l�trehoz�s hiba: " . $conn->error . "<br>";}
		
		// sql to create table: terulet
		$sql = "CREATE TABLE IF NOT EXISTS terulet (
			terazon VARCHAR(3) NOT NULL PRIMARY KEY, 
			terulet VARCHAR(1000) NOT NULL
			);";	
		if ($conn->query($sql) === TRUE) {echo "'terulet' t�bla l�trehoz�s rendben<br>"; } 
		else {echo "x T�bla l�trehoz�s hiba: " . $conn->error . "<br>";}

		//insert into table beosztas
		$value = "'vez','Vez�rigazgat�'";
		$sql = "INSERT INTO beosztas (beazon, beosztas) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Munkak�r hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value = "'res','R�szlegigazgat�'";
		$sql = "INSERT INTO beosztas (beazon, beosztas) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Munkak�r hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value = "'inf','Informatikus'";
		$sql = "INSERT INTO beosztas (beazon, beosztas) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Munkak�r hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value = "'kon','K�nyvel�'";
		$sql = "INSERT INTO beosztas (beazon, beosztas) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Munkak�r hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value = "'log','Logisztikus'";
		$sql = "INSERT INTO beosztas (beazon, beosztas) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Munkak�r hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value = "'cso','Csoportvezet�'";
		$sql = "INSERT INTO beosztas (beazon, beosztas) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Munkak�r hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value = "'mun','�sszeszerel� munkat�rs'";
		$sql = "INSERT INTO beosztas (beazon, beosztas) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Munkak�r hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);


		//insert into table terulet
		$value = "'elo','El�szerelde'";
		$sql = "INSERT INTO terulet (terazon, terulet) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Szervezeti egys�g hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		//insert into table terulet
		$value = "'sze','Szerelde'";
		$sql = "INSERT INTO terulet (terazon, terulet) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Szervezeti egys�g hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		//insert into table terulet
		$value = "'its','IT Support'";
		$sql = "INSERT INTO terulet (terazon, terulet) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Szervezeti egys�g hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		//insert into table terulet
		$value = "'pen','P�nz�gy'";
		$sql = "INSERT INTO terulet (terazon, terulet) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Szervezeti egys�g hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		//insert into table terulet
		$value = "'lgi','Logisztika'";
		$sql = "INSERT INTO terulet (terazon, terulet) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Szervezeti egys�g hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		//insert into table terulet
		$value = "'gya','-'";
		$sql = "INSERT INTO terulet (terazon, terulet) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Szervezeti egys�g hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);


        // insert into table dolgozok
        $value="'Kiss Janos', 'vez', 'gya', 1000000, '8234567810', '044220110', '12345676-12345676-12345676'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) VALUES ($value);"; 
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>";} else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

        $value="'Kiss P�ter', 'res', 'elo', 800000, '8234567829', '044220127', '12345683-12345683-12345683'";
        $sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'Nagy P�ter', 'res', 'sze', 800000, '8234567837', '044220134', '12345607-12345607-12345607'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'Horv�th Andr�s', 'inf', 'its', 600000, '8234567845', '044220141', '12345614-12345614-12345614'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'D�vid Alad�r', 'inf', 'its', 600000, '8234567853', '044220158', '12345621-12345621-12345621'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
	    //save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'Vir�g Ibolya', 'kon', 'pen', 350000, '8234567861', '044220165', '12345638-12345638-12345638'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
	    //save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'Feh�r �lmos', 'log', 'lgi', 450000, '8234567802', '044220172', '12345645-12345645-00000000'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'Feh�r �rp�d', 'cso', 'elo', 400000, '8234567128', '044220189', '12345652-12345652-00000000'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
	    //save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'Fekete Andor', 'cso', 'elo', 400000, '8234567136', '044220196', '12345669-12345669-00000000'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
	    //save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'Z�ld �rp�d', 'cso', 'sze', 400000, '8234567144', '044220103', '22345505-22345505-00000000'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
	    //save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'Z�ld Andor', 'cso', 'sze', 400000, '8234567209', '044220213', '22345512-22345512-00000000'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
	    //save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'Els� �d�m', 'mun', 'elo', 250000, '8234567217', '044220220', '22345529-22345529-00000000'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
	    //save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'Els� �va', 'mun', 'elo', 250000, '8234567225', '044220237', '22345536-22345536-00000000'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
        //save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'M�sodik �d�m', 'mun', 'sze', 250000, '8234567233', '044220244', '22345543-22345543-00000000'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

		$value="'M�sodik �va', 'mun', 'sze', 250000, '8234567241', '044220251', '22345598-22345598-00000000'";
		$sql = "INSERT INTO dolgozok (nev, munkakor, szervegy, fizetes, adoaz, taj, szamla) 
		VALUES ($value);";
		if ($conn->query($sql) === TRUE) {echo "�j rekord sikeresen l�trehozva: ".$value."<br>"; } 
		else {echo "x L�trehoz�s hiba: " . $sql . $conn->error. "<br>";}
		//save to valtozas table
		$sqllog = "INSERT INTO valtozas (valtoztatas) VALUES (\"<a style='color:green'>Dolgoz� hozz�ad�sa: $value</a>\");"; 
		$conn->query($sqllog);

    }
    
	// close connection
	$conn->close();

?>