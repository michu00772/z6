<?php
$cookie_name = "loggedin";
$servername = "localhost";
$username = "michu007_baza";
$password = "admin";
$database = "michu007_bazaporty";



$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn){
	die("b³±d: ".msqli_connect_error());
}

if (isset($_POST['login']))
{
        $kto = $_POST['jestem'];
        $im = $_POST['imie'];
        $nazw = $_POST['nazwisko'];
	$user = $_POST['username'];
	$pass = $_POST['password'];
	
	$phash = sha1(sha1($pass."salt")."salt");
	
       if ($kto == klient){

	$sql = "SELECT * FROM klienci WHERE imie='$user' AND haslo='$phash'";
	$result = $conn->query ($sql);
	$count = mysqli_num_rows($result);
	
	$cookie_value = $user;
		setcookie($cookie_name, $cookie_value, time()+ (86400 * 30), "/");
	
		header("Location: klienci.php");
	}
	
	if ($kto == pracownik){

	$sql = "SELECT * FROM pracownicy WHERE imie='$user' AND haslo='$phash'";
	$result = $conn->query ($sql);
	$count = mysqli_num_rows($result);
	
	$cookie_value = $user;
		setcookie($cookie_name, $cookie_value, time()+ (86400 * 30), "/");
	
		header("Location: pracownik.php");
	}
	
	else {
		echo "Zle haslo lub login.";echo "<br>";
		echo '<a href="z6.php">Przejdz do logowania</a>';echo "<br>";
	}
}
else if (isset($_POST['register'])){
      
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$spr = strlen($pass);
	$spr1 = mysqli_fetch_array($conn ->query("SELECT COUNT(*) FROM klienci WHERE login='$user' LIMIT 1"));
	if ($spr < 8 || $spr1[0] >= 1) {
  
		echo "Blad. Haslo musi miec conajmniej 8 znakow lub login zajety.";echo "<br>";
		echo '<a href="z6.php">Przejd¼ do logowania</a>';echo "<br>";
	}
	else{
			
               $sql = "INSERT INTO klienci (id, imie, nazwisko, login, haslo) VALUES ('', '$im', '$nazw', '$user', '$pass')";
		$result = $conn->query($sql);
		
		$phash = sha1(sha1($pass."salt")."salt");
		echo "Zajerestrowano: $user";echo "<br>";
		echo '<a href="z6.php">Przejdz do logowania</a>';
		
               




}}
?>