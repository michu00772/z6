<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
Z jakiego dzialu chcesz zobaczyc wiadomosci?
<form method="POST" >
 <select id="cmbMake" name="Make">
  <option value="oc">OC</option>
  <option value="ac">AC</option>
  <option value="nnw">NNW</option>
  <option value="inne">INNE</option>
</select> 
<br>
<input type="submit" name="search" value="Zobacz"/>
</form>
<br>
<br>


<?php
$cookie_name = "loggedin";
$servername = "localhost";
$username = "michu007_baza";
$password = "admin";
$database = "michu007_bazaporty";



$conn = mysqli_connect($servername, $username, $password, $database);

$cookie_name = "loggedin";


if (isset($_POST['search']))
{
   $maker = ($_POST['Make']);

$sql3 = "SELECT * FROM zapytania WHERE `dzial`='$maker' AND `komunikatpracownik`= '' LIMIT 1";
	$result3 = mysqli_query($conn, $sql3);
if(mysqli_num_rows($result3)>0) { 
			echo "<table cellpadding=\"3\" border=1>"; 
			echo "<tr align='center'>";
			echo "<td>ID</td>";
			echo "<td>klient</td>";
			echo "<td>Dzial</td>";
			echo "<td>komunikat</td>";
			echo "<td>Data</td>";
			echo "<td>pracownik</td>";
			echo "<td>komprac</td>";
			echo "<td>dataodp</td>";
			
		
		//wypisanie z bazy
		while($x = mysqli_fetch_assoc($result3)) { 
		
			$x1 = $x['id'];
			$x2 = $x['nickklienta'];	
			$x3= $x['dzial'];
			$x4= $x['komunikatklient']; 
			$x5 = $x['datapyt'];
			$x6 = $x['nickpracownika'];	
			$x7= $x['komunikatpracownik'];
			$x8= $x['data']; 
                        $sql4 = mysqli_fetch_array($conn ->query("SELECT * FROM zapytania WHERE `dzial`='$maker'"));
			$timeout = '1';
			echo "<tr align='center'> ";
			
			echo "<td>".$x1."</td>";
        echo "<td>".$x2."</td>"; 
        echo "<td>".$x3."</td>"; 
        echo "<td>".$x4."</td>"; 
		echo "<td>".$x5."</td>";
        echo "<td>".$x6."</td>"; 
        echo "<td>".$x7."</td>"; 
        echo "<td>".$x8."</td>";
			}
			echo "</tr>";
		}echo "</table>";
			
			
			}  



if (isset($_COOKIE[$cookie_name])){
	$cookie_value = $_COOKIE[$cookie_name];
	echo "Jeste¶ zalogowany jako: $cookie_value";echo "<br>";
	echo '<a href="logout.php">Wyloguj</a>';echo "<br>";

$data= date('d-m-Y');

$godzina= date("H:i");
$wpis = $_POST['wpis'];
$wid = $_POST['wid'];



        echo "<form  method=\"post\">";
	echo "<table>";
	echo "<tr><td>Wpisz odpowied¼.</td><td><input type=\"text\" name=\"wpis\"/></tr></td>";
        echo "<tr><td>Podaj ID.</td><td><input type=\"text\" name=\"wid\"/></tr></td>";
	echo "</table>";
	echo "<input type=\"submit\" name=\"dodaj\" value=\"Wy¶lij\"/>";
	echo "</form>";









      
     
if ($wpis > "0" & $wid > "0") {



 $sql2 = "UPDATE zapytania SET `nickpracownika` = '$cookie_value', `komunikatpracownik` = '$wpis', `data`='$data, $godzina' WHERE `id`='$wid'";
 $result2 = mysqli_query($conn, $sql2);



  }

	
}


?>
</form>
</body>
</html>