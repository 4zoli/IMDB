<?php
      include('film.php');
      include ('server.php');
      include("login.php");

      if (isset($_POST['adminadasgomb'])){
      	$username=$_POST['adminadas'];
      	$sql = "UPDATE fiok SET Jog=3 WHERE FiokUsername='$username'";
        $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
		mysqli_query($conn, $sql);
      }

      if (isset($_POST['adminelvetelgomb'])){
      	$username=$_POST['adminelvetel'];
      	$sql = "UPDATE fiok SET Jog=1 WHERE FiokUsername='$username'";
        $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
		mysqli_query($conn, $sql);
      }	

      if (isset($_POST['moderatoradasgomb'])){
      	$username=$_POST['moderatoradas'];
      	$sql = "UPDATE fiok SET Jog=2 WHERE FiokUsername='$username'";
        $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
		mysqli_query($conn, $sql);
      }	

      if (isset($_POST['moderatorelvetelgomb'])){
      	$username=$_POST['moderatorelvetel'];
      	$sql = "UPDATE fiok SET Jog=1 WHERE FiokUsername='$username'";
        $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
		mysqli_query($conn, $sql);
      }	


      if (isset($_POST['felhasznalomutegomb'])){
      	$username=$_POST['felhasznalomute'];
      	$sql = "UPDATE fiok SET Nema=1 WHERE FiokUsername='$username'";
        $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
		mysqli_query($conn, $sql);
      }

      if (isset($_POST['felhasznalounmutegomb'])){
      	$username=$_POST['felhasznalounmute'];
      	$sql = "UPDATE fiok SET Nema=0 WHERE FiokUsername='$username'";
        $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
		mysqli_query($conn, $sql);
      }

       if (isset($_POST['felhasznalobangomb'])){
      	$username=$_POST['felhasznaloban'];
      	$sql = "UPDATE fiok SET Bann=1 WHERE FiokUsername='$username'";
        $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
		mysqli_query($conn, $sql);
      }

      if (isset($_POST['felhasznalounbangomb'])){
      	$username=$_POST['felhasznalounban'];
      	$sql = "UPDATE fiok SET Bann=0 WHERE FiokUsername='$username'" ;
        $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
		mysqli_query($conn, $sql);
      }


?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <meta name="description" content="2018/2019 I. RF1 Csütörtök 9:00 IMDb csapat projektje.">
    <meta name="keywords" content="Fooldal">
    <meta name="author" content="Horváth Olivér Zoltán">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="frame.css">
    <title>Kezdőlap</title>
    <style>
        .userpage_body  {
            position: relative;
            border-style: solid;
            border-width: 3px;
            border-color: black;
            margin-left: 1vw;
            margin-bottom: 1vh;
            margin-top: 1vh;
            padding-left: 1vh;
            padding-top: 1vh;
            width: 40vw;
            color: black;
            font-size: 2vh;
			min-height: 100%;
        }
        .background {
            margin-left: -1vh;
            position: absolute;
            bottom: 0;
            margin-bottom:-1vh;
        }

		.menu   {
			z-index: 1;
		}
		.favourites	{
			z-index: 1;
		}
		.last_seen	{
			z-index: 1;
		}
		.add_button{
		cursor: pointer;
		height: 2vw;
		background-color:#00264d;
		border-radius: 25px 25px 25px 25px;
		color: white;
		width:190px;
		}
		.feliratok	{
			color: darkblue;
		}
		
    </style>
</head>

<body>
    <!--Egesz oldal egyben, menu es also resze-->
    <main>
        <!--AZ OLDAL MENU SAVJA-->
        <div class="menu">
            <?php include("menu.php"); ?>
        </div>
        <!--AZ OLDAL TORZSE-->
        <div class="index_body">
            <div class="index_title">    <!--Adott lap cime-->
                <h1>Kezelői oldal</h1>
            </div>

           <?php 
                if($_SESSION['username'] == ''){
					echo "<meta http-equiv='refresh' content='0;url=index.php'>";
                }
           ?>
            <!--BODY~~~~~~-->
            <div class="userpage_body">
                <form action="server.php" method="post">
                    Jelenlegi becenév: <?php echo "$_SESSION[name] "; ?><br>
                    <input type="text" placeholder="Becenév:" name="newalias" size='20'>
                    <input type="submit" name="modalias" value="Becenév megváltoztatása" class = "add_button"><br>
                </form>
                <form action="server.php" method="post">
                    Email cím: <?php echo $_SESSION["email"];  ?> <br>
                    <input type="email" placeholder="Email cím:" name="newemail" size='20'>
                    <input type="submit" name="modemail" value="Email cím megváltoztatása"class = "add_button"><br>
                </form>
                <form action="server.php" method="post">
                    Jelszó: <br>
                    <input type="password" placeholder="Jelszó:" name="newpass_1" size='20'><br><br>
                    Jelszó megerősítése: <br>
                    <input type="password" placeholder="Jelszó:" name="newpass_2" size='20'>
                    <input type="submit" name="modpass" value="Jelszó megváltoztatása"class = "add_button"><br>
                </form>
                <?php 
                    	$sql = "SELECT Jog From fiok WHERE FiokUsername='$_SESSION[username]'";
                    	$conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) == 1){
	    					$row = mysqli_fetch_assoc($result);
	   						if ($row['Jog']==3){
								echo "<h1 class='feliratok' >Admin műveletek</h1>";
	   							?>	
	   								<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="adminadas" size='20'>
	   									<input type="submit" name="adminadasgomb" value="Admin jog adas" style="width:200px"class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

                   					<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="adminelvetel" size='20'>
	   									<input type="submit" name="adminelvetelgomb" value="Admin jog megvonas" style="width:200px"class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

                   					<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="moderatoradas" size='20'>
	   									<input type="submit" name="moderatoradasgomb" value="Moderator jog adas" style="width:200px"class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

                   					<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="moderatorelvetel" size='20'>
	   									<input type="submit" name="moderatorelvetelgomb" value="Moderator jog megvonas" style="width:200px"class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

                   					<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="felhasznalomute" size='20'>
	   									<input type="submit" name="felhasznalomutegomb" value="Felhasznalo nemitasa" style="width:200px"class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

                   					<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="felhasznalounmute" size='20'>
	   									<input type="submit" name="felhasznalounmutegomb" value="Felhasznalo nemitasfeloldasa" style="width:200px"class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

                   					<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="felhasznaloban" size='20'>
	   									<input type="submit" name="felhasznalobangomb" value="Felhasznalo tiltasa" style="width:200px"class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

                   					<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="felhasznalounban" size='20'>
	   									<input type="submit" name="felhasznalounbangomb" value="Felhasznalo tiltasfeloldasa" style="width:200px"class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

									<?php include('filmfeltoltes.php'); ?>

	   							<?php
	   						}
	   					}
	   					$sql = "SELECT Jog From fiok WHERE FiokUsername='$_SESSION[username]'";
                    	$conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
						$result = mysqli_query($conn, $sql);
	   					if (mysqli_num_rows($result) == 1){
	    					$row = mysqli_fetch_assoc($result);
	   						if ($row['Jog']==2){
									   ?>
									   <h1 class='feliratok'>Moderátori műveletek</h1>
	   									<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="felhasznalomute" size='20'>
	   									<input type="submit" name="felhasznalomutegomb" value="Felhasznalo nemitasa" class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

                   					<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="felhasznalounmute" size='20'>
	   									<input type="submit" name="felhasznalounmutegomb" value="Felhasznalo nemitasfeloldasa" class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

                   					<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="felhasznaloban" size='20'>
	   									<input type="submit" name="felhasznalobangomb" value="Felhasznalo tiltasa" class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>

                   					<form method="post">
	   									<input type="text" placeholder="Fiok Username" name="felhasznalounban" size='20'>
	   									<input type="submit" name="felhasznalounbangomb" value="Felhasznalo tiltasfeloldasa" class = "add_button"><br>
                   						 <?php  ?> 
                   					</form>
                   				<?php
	   						}
	   					}
	   					
	    			?>	 
                     
                <div class="background">
                    <!--<img src="userbg.jpg" height="30%" width="100%" />-->
                </div>
            </div>
            <!--~~~~~~BODY-->
        </div>
    </main>
</body>

<?php

/*if(isset($_SESSION['username']) and isset($_POST['fid'])) {
    addToFavourites($connect,$_SESSION['username'],$_POST['fid']);
} else if(!isset($_SESSION['username']) and isset($_POST['fid'])) {
    echo "<script> alert('Jelentkezzen be!'); </script>";
}*/

mysqli_close($conn);
?>