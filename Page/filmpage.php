<?php
include('film.php');
//include('functions.php');
include('server.php');
?>


<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <meta name="description" content="2018/2019 I. RF1 Csütörtök 9:00 IMDb csapat projektje.">
    <meta name="keywords" content="Film oldala">
    <meta name="author" content="Horváth Olivér Zoltán">
    <link rel="stylesheet" href="filmpage.css">
    <link rel="stylesheet" href="frame.css">
    <title>Film oldal</title>
    <style>
        #adminmodositas {
            width: 35vh;
        }
    </style>
</head>
<?php

        
    if (isset($_POST['gomb'])){

        if (!empty($_POST['leiras'])){
            $x = $_POST['leiras'];
            $y = $_GET['filmid'];
            $sql = "UPDATE film SET FilmLeiras='$x' WHERE filmID='$y'";
            $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
            mysqli_query($conn, $sql);
        }

        if (!empty($_POST['cim'])){
            $x = $_POST['cim'];
            $y = $_GET['filmid'];
            $sql = "UPDATE film SET FilmCim='$x' WHERE filmID='$y'";
            $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
            mysqli_query($conn, $sql);
        }

        if (!empty($_POST['kategoria'])){
            $x = $_POST['kategoria'];
            $y = $_GET['filmid'];
            $sql = "UPDATE film SET FilmKategoria='$x' WHERE filmID='$y'";
            $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
            mysqli_query($conn, $sql);
        }


        if (!empty($_POST['trailler'])){
            $x = $_POST['trailler'];
            $y = $_GET['filmid'];
            $sql = "UPDATE film SET FilmTrailler='$x' WHERE filmID='$y'";
            $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
            mysqli_query($conn, $sql);
        }

         if (!empty($_POST['ertekeles'])){
            $x = $_POST['ertekeles'];
            $y = $_GET['filmid'];
            $sql = "UPDATE film SET FilmErtekeles='$x' WHERE filmID='$y'";
            $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
            mysqli_query($conn, $sql);
        }


         if (!empty($_POST['ertekeloksz'])){
            $x = $_POST['ertekeloksz'];
            $y = $_GET['filmid'];
            $sql = "UPDATE film SET FilmErtekelokSzama='$x' WHERE filmID='$y'";
            $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
            mysqli_query($conn, $sql);
        }

        if (!empty($_POST['poszter'])){
            $x = $_POST['poszter'];
            $y = $_GET['filmid'];
            $sql = "UPDATE film SET FilmPoszter='$x' WHERE filmID='$y'";
            $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
            mysqli_query($conn, $sql);
        }
      }

    
    $filmid =  $_GET['filmid'] ;
    if($_SERVER['SERVER_NAME']=='localhost')
        $connect = mysqli_connect("localhost","root","","imdb") or die ("Couldn't connect!");
    if($_SERVER['SERVER_NAME']=='project-imdb.gat-worldhost.tk')
        $connect = mysqli_connect('sql205.gat-worldhost.tk','gatw_22922717','c4QSyKBV','gatw_22922717_imdb') or die ("Couldn't connect!");
    $film = mysqli_query($connect,"SELECT * FROM film WHERE FilmID = $filmid");
    $sor = mysqli_fetch_assoc($film) ;

    $res=mysqli_query($connect,"SELECT AVG(pont) as atlag FROM ertekelesek WHERE FilmID='$filmid'; ") or die("Couldn't connect!");
    $fetchRes=mysqli_fetch_assoc($res);
    $sor['FilmErtekeles']=$fetchRes['atlag'];
    $res=mysqli_query($connect,"SELECT COUNT(*) as szam FROM ertekelesek WHERE FilmID='$filmid'; ") or die("Couldn't connect!");
    $fetchRes=mysqli_fetch_assoc($res);
    $sor['FilmErtekelokSzama']=$fetchRes['szam'];
    $fi = new Movie($sor['FilmID'],$sor['FilmCim'],$sor['FilmKategoria'],$sor['FilmLeiras'],$sor['FilmTrailler'],$sor['FilmErtekeles'],$sor['FilmErtekelokSzama'],0) ;
    echo "<script> document.title=\"".$fi->cim."\"</script>";


   if (isset($_POST['csillgomb']) and isset($_SESSION['username'])){
        $user=mysqli_real_escape_string($connect,$_SESSION['username']);
        $filmID =mysqli_real_escape_string($connect,$_GET['filmid']) ;
        $pont=mysqli_real_escape_string($connect,$_POST['pont']);
        if($pont==0){
            $sql="DELETE FROM ertekelesek WHERE fiokUsername='$user' AND FilmID='$filmid';";
            mysqli_query($connect,$sql) or die("Couldn't connect");
            header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']);
        }else{
            $sql="SELECT * FROM ertekelesek WHERE fiokUsername='$user' AND FilmID='$filmid';";
            $res=mysqli_query($connect,$sql);
            if(mysqli_num_rows($res)!=0){
                $sql="UPDATE ertekelesek SET pont='$pont' WHERE fiokUsername='$user' AND FilmID='$filmid';";
                mysqli_query($connect, $sql) or die("Couldn't connect");
                header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']);
            }else {
                $sql = "INSERT INTO ertekelesek VALUES ('$user','$filmID','$pont');";
                mysqli_query($connect, $sql) or die("Couldn't connect");
                header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']);
            }
        }

        /*
        $sql = "SELECT FilmErtekeles,FilmErtekelokSzama FROM film WHERE FilmID='$filmID'";
        $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $ujPont = $row['FilmErtekeles'] * $row['FilmErtekelokSzama'] + $p;
        $ujSzam = $row['FilmErtekelokSzama'] + 1;
        $ujPont = $ujPont/$ujSzam;
        $sql = "UPDATE film SET FilmErtekeles='$ujPont', FilmErtekelokSzama='$ujSzam' WHERE FilmID='$filmID'";
        mysqli_query($conn, $sql);*/
      } 
?>

<body>
<!--Egesz oldal egyben, menu es also resze-->
<main>
    <!--AZ OLDAL MENU SAVJA-->
    <div class="menu">
        <?php include("menu.php"); ?>
    </div>
    <!--AZ OLDAL TORZSE-->
    <div class="filmpage_body">
      
        <div class="filmpage_bar">    <!--Adott lap cime-->


            <div class="filmpage_name">
                <?php
                    echo $fi->cim ;
                ?>
            </div>
            <div class="to_fav">
            <form method="post" action=<?php echo "filmpage.php?filmid=".$filmid; ?>>
                <input type="hidden" name="fid" value=<?php echo $fi->id ?>>
                <button type="submit" name="fav" class="favbutton">Kedvencekhez</button>
            </form>
            </div>

            <div class="filmpage_stars">
                <?php
                //echo $fi->getNumErtekeles();
                echo $fi->getNumErtekeles();

                $fi->getertekeles();
                ?>
            </div>
            
        </div>

        <div class="filmpage_trailer">
            <?php
             $linky = $fi->linki;
                   echo " <iframe width='100%' height = '100%' src='$linky' frameborder ='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>" ;
            ?>
        </div>
        <div class="filmpage_story">
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            ?>
                <?php
                 $user=$_SESSION['username'];
                 $sql="SELECT pont FROM ertekelesek WHERE fiokUsername='$user' AND FilmID='$fi->id'";
                 $res=mysqli_query($connect,$sql);
                 $sor=mysqli_fetch_array($res);
                 $pont=$sor['pont'];
                ?>
            <form method="post">
                <select name="pont">
                    <option value=1><?php echo (1==$pont)? "Jelenleg: 1" :"1"; ?></option>
                    <option value=2><?php echo (2==$pont)? "Jelenleg: 2" :"2"; ?></option>
                    <option value=3><?php echo (3==$pont)? "Jelenleg: 3" :"3"; ?></option>
                    <option value=4><?php echo (4==$pont)? "Jelenleg: 4" :"4"; ?></option>
                    <option value=5><?php echo (5==$pont)? "Jelenleg: 5" :"5"; ?></option>
                    <option value=0><?php echo (0==$pont)? "Jelenleg: Nem értékelte" :"Nem értékelem"; ?></option>
                </select>
                <input type="submit" name="csillgomb" value="Pontoz"><br> <!-- Bocsi Oli, nem tudtam máshova rakni -->
            </form>
            <h3>Történet: </h3>
            <?php
             }
                echo $fi->leiras ;


            ?>
            <div class="filmtype">
                Műfaj: 
                <?php
                    echo $fi->kategoria ;
                ?>
            </div>
        </div>
        <div class="filmpage_filmstars">
        <h3>Szereplők: </h3>
		
		<?php
		$id = $fi->id ;
				$conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
				 $sql = "SELECT szinesz.SzineszNev as szn
				 FROM szinesz, szerepel, film
				 WHERE szinesz.SzineszID=szerepel.SzineszID AND film.FilmID='$id' AND film.filmID=szerepel.FilmID";
				 $res = mysqli_query($conn, $sql) or die ("Couldn't connect!".mysqli_error($conn));
				while ( ($current_row = mysqli_fetch_assoc($res))!= null) {
					echo '<option value="'.$current_row["szn"].'">'.$current_row["szn"].'</option>';
					
				}
		
		
		
		
		?>
        </div>
        <div class= "filmpage_comments">
            <h3>Hozzászólások: </h3>
            <?php

                 $id = $fi->id ;

                 if(isset($_SESSION['username'])){
                    //kommentek irasa
                    echo "<form method = 'POST' action='comment.php' ><textarea maxlength='255'  rows='4' cols='50' name='hozzaszolas' placeholder='Hozzaszolas irasa...' value = ''></textarea>
                    <input type = 'hidden' name = 'filmid' value = '$id'>
                    <input type = 'submit' name = 'submit' id='kommentkuld' value = ''></form>
                    ";
                 }
                //kommentek kiirasa
                  $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");

                  $sql = "SELECT * from hozzaszolasok WHERE FilmID = '$id'" ;
                  $res = mysqli_query($conn,$sql);
                  $commentek = array() ;

                  while($row = mysqli_fetch_assoc($res)){
                    $com = new Comment($row['HozzaszolasID'],$row['HozzaszolasIdo'],$row['HozzaszolasSzoveg'],$row['FilmID'],$row['FiokUsername']);
                    $commentek[] = $com ;
                  }
                  $n = count($commentek);

                  for($i = 0;$i<$n;$i++){
                    $cid = $commentek[$i]->commentid ;

                    $sql = "SELECT Bann,Nema,Jog FROM fiok WHERE FiokUsername=(SELECT FiokUsername From hozzaszolasok WHERE HozzaszolasID ='$cid')";

                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                            if ((($row["Bann"]==1) or ($row["Nema"]==1)) and ($row["Jog"]!=3)){}
                            else{
                            echo "<div class=''>".$commentek[$i]->usname."<br>".$commentek[$i]->idopont."<br>".$commentek[$i]->szoveg."</div>";
                            }
                    }
                  }
            ?>

        </div>
        
            <?php
                include("login.php");
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                $sql = "SELECT Jog From fiok WHERE FiokUsername='$_SESSION[username]'";
                $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_assoc($result);
                    if ($row['Jog']==3){
                    echo '<div class="filmpage_admin">';

            ?>
                <form method="post">
                <h3>Film adatainak modositasa</h3>
                <table id= 'adminmodositas'>
                    <tbody>
                        <tr>
                            <td>Cim</td>
                            <td><input type="text" name="cim" size='20'><br></td>
                        </tr>
                        <tr>
                            <td>Kategoria</td>
                            <td><input type="text" name="kategoria" size='20'></td>
                        </tr>
                        <tr>
                            <td>Leiras</td>
                            <td><input type="text" name="leiras" size='20'></td>
                        </tr>
                        <tr>
                            <td>Trailler</td>
                            <td><input type="text" name="trailler" size='20'></td>
                        </tr>
                        <tr>
                            <td>Ertekeles</td>
                            <td><input type="text" name="ertekeles" size='20'></td>
                        </tr>
                        <tr>
                            <td>Ertekelok Szama</td>
                            <td><input type="text" name="ertekeloksz" size='20'></td>
                        </tr>
                        <tr>
                            <td>Poszter</td>
                            <td><input type="text" name="poszter" size='20'></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="gomb" value="Modositas"></td>
                        </tr>
                    </tbody>
                </table>
                </form>
            <?php
                    }
                }
            }
            ?>
            
        </div>
    </div>
        <?php 
         if(count($_SESSION['lastvisited'])==0) {
             array_push($_SESSION['lastvisited'], $fi->cim);
             array_push($_SESSION['lastvisitedurl'], "filmpage.php?filmid=".$filmid);
         }
         else if(count($_SESSION['lastvisited'])==1){
             if($_SESSION['lastvisited'][0]!=$fi->cim) {
                 array_push($_SESSION['lastvisited'], $fi->cim);
                 array_push($_SESSION['lastvisitedurl'], "filmpage.php?filmid=".$filmid);
             }
         }
         else{
             for($i=count($_SESSION['lastvisited'])-1;$i!=-1;$i--){
                if($i==count($_SESSION['lastvisited'])-6) {
                    array_push($_SESSION['lastvisited'],$fi->cim);
                    array_push($_SESSION['lastvisitedurl'], "filmpage.php?filmid=".$filmid);
                    break;
                }
                if($_SESSION['lastvisited'][$i]==$fi->cim){
                    array_splice( $_SESSION['lastvisited'],$i,1);
                    array_splice( $_SESSION['lastvisitedurl'],$i,1);
                    array_push($_SESSION['lastvisited'],$fi->cim);
                    array_push($_SESSION['lastvisitedurl'], "filmpage.php?filmid=".$filmid);
                    break;
                }
                if($i==0) {
                    array_push($_SESSION['lastvisited'], $fi->cim);
                    array_push($_SESSION['lastvisitedurl'], "filmpage.php?filmid=".$filmid);
                }
             }
         }
        ?>


    <br>
</main>
</body>

