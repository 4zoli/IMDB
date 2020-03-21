<!-- ezt minden film oldalara importalni kell -->

<?php    

$sessionfilmID=9; //session-ból kéne kiszedni, amelyik film oldalán vagy
$sessionFiokUsername='igenkerdo'; //session-ból kéne kiszedni, akiként be vagy jelentkezve

if(isset($_POST['latottLista'])){ //submitra rakattintva ezt teszi
  	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imdb";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db); //adatbazishoz csatalkozas

	if ($conn->connect_error) {
    	die("Csatlakozas sikeretlen: " . $conn->connect_error);//ha nem sikerült csatlakozni az adatbazihoz
	} 

	$sql="SELECT FilmCim FROM film WHERE FilmID='$sessionfilmID'";
	$result = $conn->query($sql);

    if ($conn && ($result->num_rows > 0)) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $filmneve = $row["FilmCim"];
        }
    } 

	$sql="SELECT LatottFilmek FROM fiok WHERE FiokUsername='$sessionFiokUsername'";
	$result = $conn->query($sql);

    if ($conn && ($result->num_rows > 0)) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $lista = $row["LatottFilmek"];
        }
    } 

    $nincsbenne = True;

    $tomb = explode(' | ',$lista);
    for ($i=0;$i<count($tomb);$i++){
    		if ($tomb[$i]==$filmneve){
    			$nincsbenne=False;
    		}
    }

    if ($nincsbenne){
		if($lista != ''){
			$lista=$lista.' | '.$filmneve;
		}
		else{
			$lista=$filmneve;
		}

		$sql = "UPDATE fiok SET LatottFilmek = '$lista' WHERE FiokUsername = '$sessionFiokUsername';";
		mysqli_query($conn,$sql);
	}
}    





if(isset($_POST['kedvencLista'])){ //submitra rakattintva ezt teszi
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imdb";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db); //adatbazishoz csatalkozas

	if ($conn->connect_error) {
    	die("Csatlakozas sikeretlen: " . $conn->connect_error);//ha nem sikerült csatlakozni az adatbazihoz
	} 

	$sql="SELECT FilmCim FROM film WHERE FilmID='$sessionfilmID'";
	$result = $conn->query($sql);

    if ($conn && ($result->num_rows > 0)) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $filmneve = $row["FilmCim"];
        }
    } 

	$sql="SELECT KedvencFilmek FROM fiok WHERE FiokUsername='$sessionFiokUsername'";
	$result = $conn->query($sql);

    if ($conn && ($result->num_rows > 0)) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $lista = $row["KedvencFilmek"];
        }
    } 

    $nincsbenne = True;

    $tomb = explode(' | ',$lista);
    for ($i=0;$i<count($tomb);$i++){
    		if ($tomb[$i]==$filmneve){
    			$nincsbenne=False;
    		}
    }

    if ($nincsbenne){
		if($lista != ''){
			$lista=$lista.' | '.$filmneve;
		}
		else{
			$lista=$filmneve;
		}

		$sql = "UPDATE fiok SET KedvencFilmek = '$lista' WHERE FiokUsername = '$sessionFiokUsername';";
		mysqli_query($conn,$sql);
	}
}    



if(isset($_POST['megnezendoLista'])){ //submitra rakattintva ezt teszi
  	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imdb";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db); //adatbazishoz csatalkozas

	if ($conn->connect_error) {
    	die("Csatlakozas sikeretlen: " . $conn->connect_error);//ha nem sikerült csatlakozni az adatbazihoz
	} 

	$sql="SELECT FilmCim FROM film WHERE FilmID='$sessionfilmID'";
	$result = $conn->query($sql);

    if ($conn && ($result->num_rows > 0)) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $filmneve = $row["FilmCim"];
        }
    } 

	$sql="SELECT MegnezendoFilmek FROM fiok WHERE FiokUsername='$sessionFiokUsername'";
	$result = $conn->query($sql);

    if ($conn && ($result->num_rows > 0)) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $lista = $row["MegnezendoFilmek"];
        }
    } 

    $nincsbenne = True;

    $tomb = explode(' | ',$lista);
    for ($i=0;$i<count($tomb);$i++){
    		if ($tomb[$i]==$filmneve){
    			$nincsbenne=False;
    		}
    }

    if ($nincsbenne){
		if($lista != ''){
			$lista=$lista.' | '.$filmneve;
		}
		else{
			$lista=$filmneve;
		}

		$sql = "UPDATE fiok SET MegnezendoFilmek = '$lista' WHERE FiokUsername = '$sessionFiokUsername';";
		mysqli_query($conn,$sql);
	}
}    

?>




<html>
<body>    
<form action="" method="post">
  <input type="submit" value="Hozzaadas a latott filmek listahoz" name="latottLista"/><BR> 
  <input type="submit" value="Hozzaadas a megnezendo filmek listahoz" name="megnezendoLista"/><BR> 
  <input type="submit" value="Hozzaadas a kedvenc filmek listahoz" name="kedvencLista"/><BR> 
</form>    
</body>
</html>