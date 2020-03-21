<!DOCTYPE html>
<html lang="hu">
<?php
    include('film.php');
    include('functions.php');
    include("menu.php");
    include("login.php");
?>
<head>
    <meta charset="utf-8">
    <meta name="description" content="2018/2019 I. RF1 Csütörtök 9:00 IMDb csapat projektje.">
    <meta name="keywords" content="Film oldala">
    <meta name="author" content="Horváth Olivér Zoltán">
    <link rel="stylesheet" href="filmpage.css">
    <link rel="stylesheet" href="frame.css">
    <title>Film oldal</title>
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
    $fi = new Movie($sor['FilmID'],$sor['FilmCim'],$sor['FilmKategoria'],$sor['FilmLeiras'],$sor['FilmTrailler'],$sor['FilmErtekeles'],$sor['FilmErtekelokSzama'],0) ;


    if (isset($_POST['csillgomb'])){
        $filmID =  $_GET['filmid'] ;
        $p=$_POST['pont'];
        $sql = "SELECT FilmErtekeles,FilmErtekelokSzama FROM film WHERE FilmID='$filmID'";
        $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $ujPont = $row['FilmErtekeles'] * $row['FilmErtekelokSzama'] + $p;
        $ujSzam = $row['FilmErtekelokSzama'] + 1;
        $ujPont = $ujPont/$ujSzam;
        $sql = "UPDATE film SET FilmErtekeles='$ujPont', FilmErtekelokSzama='$ujSzam' WHERE FilmID='$filmID'";
        mysqli_query($conn, $sql);
      } 


?>

<body>
<!--Egesz oldal egyben, menu es also resze-->
<main>
    <!--AZ OLDAL MENU SAVJA-->
    <div class="menu">
        
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
            <form method="post">
                <input type="text" placeholder="1-5" name="pont"  style="width: 20px">
                <input type="submit" name="csillgomb" value="Pontoz"><br> <!-- Bocsi Oli, nem tudtam máshova rakni -->
                </form>
            <?php
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
            SZEREPLOK
        </div>
        <div class= "filmpage_comments">
            KOMMENTEK
            <?php
                //akkor irja ki ha nincs bannolva vagy nemitva
                    $sql = "SELECT Bann,Nema,Jog FROM fiok WHERE FiokUsername=(SELECT FiokUsername From hozzaszolasok WHERE HozzaszolasID ='jelen hozzaszolas ID-je')";
                    $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                            if ((($row["Bann"]==1) or ($row["Nema"]==1)) and ($row["Jog"]!=3)){}
                            else{
                                //kommentek kiirasa
                                ?>
                                    $comment = new Comment() ;
                                <?php
                            }
                    } 
            ?>

        </div>
        
            <?php
                
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
                    Cim <input type="text" name="cim" size='20'><br>
                    Kategoria <input type="text" name="kategoria" size='20'><br>
                    Leiras <input type="text" name="leiras" size='20'><br>
                    Trailler <input type="text" name="trailler" size='20'><br>
                    Ertekeles <input type="text" name="ertekeles" size='20'><br>
                    Ertekelok Szama <input type="text" name="ertekeloksz" size='20'><br>
                    Poszter <input type="text" name="poszter" size='20'><br>
                    <input type="submit" name="gomb" value="Modositas"><br>
                    <br>
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

    <?php
    if(isset($_SESSION['username']) and isset($_POST['fid'])) {
        addToFavourites($connect,$_SESSION['username'],$_POST['fid']);
    } else if(!isset($_SESSION['username']) and isset($_POST['fid'])) {
        echo "<script> alert('Jelentkezzen be!'); </script>";
    }
    ?>
    <br>
</main>
</body>
