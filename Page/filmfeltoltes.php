<!-- ezt a kis részlet imporalasra var a film veltotese lehetosegnel -->

<?php    
if(isset($_POST['AdatBazishozAdas'])){ //submitra rakattintva ezt teszi
	echo "<div class='body_min_height'>";  
	$FilmCimBevitel = $_POST['FilmCim']; //adatok lekerese adatbeviteli mezokbol
  	$FilmKategoriaBevitel = $_POST['FilmKategoria']; 
  	$FilmLeirasBevitel = $_POST['FilmLeiras']; 
  	$FilmTraillerBevitel = $_POST['FilmTrailler']; 
  	$FilmPoszterBevitel = $_POST['FilmPoszter']; 
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imdb";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db); //adatbazishoz csatalkozas
	$sql = "INSERT INTO film (FilmCim, FilmKategoria, FilmLeiras, FilmTrailler, FilmPoszter)  VALUES 
	('$FilmCimBevitel','$FilmKategoriaBevitel','$FilmLeirasBevitel','$FilmTraillerBevitel','$FilmPoszterBevitel')";
	mysqli_query($conn, $sql);
}    

if(isset($_POST['szinesz'])){ 
	echo "<div class='body_min_height'>";  
	$sznev = $_POST['nev']; 
  	$szwti = $_POST['twi']; 
  	$szins = $_POST['ins']; 
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imdb";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db); //adatbazishoz csatalkozas
	$sql = "INSERT INTO szinesz (SzineszID, SzineszNev, SzineszTwitter, SzineszInstagram)  VALUES (default, '$sznev','$szwti','$szins')";
	mysqli_query($conn, $sql);
} 

if(isset($_POST['al'])){ 
	echo "<div class='body_min_height'>";  
	$sz = $_POST['sz']; 
  	$f = $_POST['fi']; 
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imdb";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
	$sql = "INSERT INTO szerepel (FilmID, SzineszID)  VALUES ('$sz','$f')";
	mysqli_query($conn, $sql);
} 

if(isset($_POST['tf'])){ 
	echo "<div class='body_min_height'>";  
	$f = $_POST['tfi']; 
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imdb";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
	$sql = "DELETE FROM film WHERE FilmID='$f'";
	mysqli_query($conn, $sql);
} 

if(isset($_POST['tsz'])){ 
	echo "<div class='body_min_height'>";  
	$f = $_POST['tszid']; 
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imdb";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
	$sql = "DELETE FROM szinesz WHERE SzineszID='$f'";
	mysqli_query($conn, $sql);
} 

if(isset($_POST['rept'])){ 
	echo "<div class='body_min_height'>";  
	$szt = $_POST['szt']; 
  	$fit = $_POST['fit']; 

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imdb";
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
	$sql = "DELETE FROM szerepel WHERE SzineszID='$szt' AND FilmID='$fit'";
	mysqli_query($conn, $sql);
} 




?>

<html>
<head>
<style>
	.add_button{
		cursor: pointer;
		height: 2vw;
		background-color:#00264d;
		border-radius: 25px 25px 25px 25px;
		color: white;
		width:200px;
}
	.add_button2{
		cursor: pointer;
		height: 2vw;
		background-color:#00264d;
		border-radius: 25px 25px 25px 25px;
		color: white;
		width:80px;
}

	.action_title{
		font-size: 18px;
	
	}
</style>
</head>
<body>    
<form action="" method="post">
<div class="action_title">  Film hozzáadás:</div> <br>
	<input type="text" name="FilmCim" placeholder="Film címe"/> <BR><BR>
	<input type="text" name="FilmKategoria" placeholder="A film kategóriája"/><BR><BR>
	<input type="text" name="FilmLeiras"placeholder="A film leírása"/><BR><BR>
	<input type="text" name="FilmTrailler"placeholder="Az előzetes linkje"/><BR><BR>
	<input type="text" name="FilmPoszter"placeholder="A poszter linkje"/><BR><BR>
	<input type="submit" name="AdatBazishozAdas" class="add_button2" value="Hozzáad" />
	
	<BR><BR> <!-- adatbeviteli mezok -->
</form>  

<form action="" method="post">
 <div class="action_title"> Szinész hozzáadás:</div>  <br>
	<input type="text" name="nev"placeholder="Színész neve"/> <BR><BR>
	<input type="text" name="twi"placeholder="Twitter link"/><BR><BR>
	<input type="text" name="ins"placeholder="Instagram link"/><BR><BR>
	<input type="submit" name="szinesz" class="add_button2"value="Hozzáad" /><BR> <!-- adatbeviteli mezok -->
</form>  

<form action="" method="post">
<div class="action_title">  Szerep hozzáadás:</div>   <br>
	<input type="text" name="sz"placeholder="Színész ID"/> <BR><BR>
	<input type="text" name="fi"placeholder="Film ID"/><BR><BR>
	<input type="submit" name="al" class="add_button2"value="Hozzáad" /><BR> <!-- adatbeviteli mezok -->
</form>  

<form action="" method="post">
 <div class="action_title"> Film törlése: </div>  <br>
	<input type="text" name="tfi" placeholder="Film ID"/><BR><br>
	<input type="submit" name="tf"class="add_button2" value="Töröl" /><BR> <!-- adatbeviteli mezok -->
</form>  

<form action="" method="post">
 <div class="action_title"> Szinész törlése: </div>  <br>
	<input type="text" name="tszid" placeholder="Színész ID"/><BR><BR>
	<input type="submit" name="tsz"class="add_button2" value="Töröl" /><BR> <!-- adatbeviteli mezok -->
</form> 

<form action="" method="post">
 <div class="action_title"> Szerep törlése: </div>  <br>
  <input type="text" name="szt"placeholder="Színész ID"/> <BR>
  <input type="text" name="fit"placeholder="Film ID"/><BR><br>
  <input type="submit" name="rept"class="add_button2" value="Töröl" /><BR> <!-- adatbeviteli mezok -->
</form>  



<div class='body_min_height'>
</body>
</html>