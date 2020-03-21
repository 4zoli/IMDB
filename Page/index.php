<?php
      include('film.php');
      include('server.php');
      //include('functions.php');
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
                <h1>Főoldal</h1>
            </div>

           <?php include("login.php"); ?>
            <!--Utolso ot film divek ETTOL~~~~~~-->
            <?php

            if($_SERVER['SERVER_NAME']=='localhost')
                $connect=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
            if($_SERVER['SERVER_NAME']=='project-imdb.gat-worldhost.tk')
                $connect=mysqli_connect('sql205.gat-worldhost.tk','gatw_22922717','c4QSyKBV','gatw_22922717_imdb') or die("Couldn't connect!");
            $filmertekeles = mysqli_query($connect,"SELECT FilmID, AVG(pont) as atlag  FROM ertekelesek GROUP BY FilmID ORDER BY atlag DESC limit 5") or die("Couldn't connect!");
            $top5 = array() ;
            while ($sor = mysqli_fetch_assoc($filmertekeles)){
                $filmid=$sor['FilmID'];
                /*$res=mysqli_query($connect,"SELECT AVG(pont) as atlag FROM ertekelesek WHERE FilmID='$filmid'; ") or die("Couldn't connect!");
                $fetchRes=mysqli_fetch_assoc($res);
                $sor['FilmErtekeles']=$fetchRes['atlag'];*/
                $res=mysqli_query($connect,"SELECT COUNT(*) as szam FROM ertekelesek WHERE FilmID='$filmid'; ") or die("Couldn't connect!");
                $fetchRes=mysqli_fetch_assoc($res);
                $sor['FilmErtekelokSzama']=$fetchRes['szam'];
                $res=mysqli_query($connect,"SELECT * FROM film WHERE FilmID='$filmid';")or die("Couldn't connect!");
                $fetchRes=mysqli_fetch_assoc($res);

                $fi = new Movie($sor['FilmID'],$fetchRes['FilmCim'],$fetchRes['FilmKategoria'],$fetchRes['FilmLeiras'],$fetchRes['FilmTrailler'],$sor['atlag'],$sor['FilmErtekelokSzama'],$fetchRes['FilmPoszter']) ;

                $top5[] = $fi ;
            }
            ?>

            <div class="top_five" id="one">
                <div class="top_five_bar">
                    <div class="top_five_title">
                     <?php  echo $top5[0]->cim ; ?>
                    </div>
                    <div class="top_five_stars">
                        <?php echo $top5[0]->getNumErtekeles(); ?>
                      <?php  echo $top5[0]->getertekeles() ; ?>
                    </div>
                </div>
                <div class="adding_buttons">
                    <div class="to_fav">
                        <form method="post" action="index.php">
                            <input type="hidden" name="fid" value=<?php echo $top5[0]->id ?>>
                            <button type="submit" name="fav" class="favbutton">Kedvencekhez</button>
                        </form>
                    </div>
                    <div class="to_film_page">
                      <?php  $fid = $top5[0]->id ;
                        echo "<form action='filmpage.php' method='get'> ";
                        echo "<a href='filmpage.php?filmid=$fid'>Tovabb az adatlapra..</a> ";
                        echo "</form>"
                      ?>
                    </div>
                </div>
                <div class="top_five_poster">
                  <?php $poszt = $top5[0]->poszter;
                                        echo"<img src = '$poszt' style='height:100%'>" ;
                                   ?>
                </div>
                <div class="top_five_shortstory">
                    <?php  echo $top5[0]->leiras ; ?>
                </div>
                <div class="top_five_filmtype">
                        Műfaj : <?php  echo $top5[0]->kategoria ; ?>
                    </div>
            </div>
            <div class="top_five" id="two">
                <div class="top_five_bar">
                    <div class="top_five_title">
                        <?php  echo $top5[1]->cim ; ?>
                    </div>
                    <div class="top_five_stars">
                        <?php echo $top5[1]->getNumErtekeles(); ?>
                      <?php  echo $top5[1]->getertekeles() ; ?>
                    </div>
                </div>
                <div class="adding_buttons">
                    <div class="to_fav">
                        <form method="post" action="index.php">
                            <input type="hidden" name="fid" value=<?php echo $top5[1]->id ?>>
                            <button type="submit" name="fav" class="favbutton">Kedvencekhez</button>
                        </form>
                    </div>
                    <div class="to_film_page">
                        <?php  $fid = $top5[1]->id ;
                          echo "<form action='filmpage.php' method='get'> ";
                           echo "<a href='filmpage.php?filmid=$fid'>Tovabb az adatlapra..</a> ";
                           echo "</form>"
                         ?>
                    </div>
                </div>
                <div class="top_five_poster">
                <?php $poszt = $top5[1]->poszter;
                                      echo"<img src = '$poszt' style='height:100%'>" ;
                                 ?>
                </div>
                <div class="top_five_shortstory">
                    <?php  echo $top5[1]->leiras ; ?>
                </div>
                <div class="top_five_filmtype">
                        Műfaj : <?php  echo $top5[1]->kategoria ; ?>
                    </div>
            </div>

            <div class="top_five" id="three">
                <div class="top_five_bar">
                    <div class="top_five_title">
                       <?php  echo $top5[2]->cim ; ?>
                    </div>
                    <div class="top_five_stars">
                        <?php echo $top5[2]->getNumErtekeles(); ?>
                       <?php  echo $top5[2]->getertekeles() ; ?>
                    </div>
                </div>
                <div class="adding_buttons">
                    <div class="to_fav">
                        <form method="post" action="index.php">
                            <input type="hidden" name="fid" value=<?php echo $top5[2]->id ?>>
                            <button type="submit" name="fav" class="favbutton">Kedvencekhez</button>
                        </form>
                    </div>
                    <div class="to_film_page">
                        <?php  $fid = $top5[2]->id ;
                           echo "<form action='filmpage.php' method='get'> ";
                            echo "<a href='filmpage.php?filmid=$fid'>Tovabb az adatlapra..</a> ";
                           echo "</form>"
                             ?>
                    </div>
                </div>
                <div class="top_five_poster">
                <?php $poszt = $top5[2]->poszter;
                                      echo"<img src = '$poszt' style='height:100%'>" ;
                                 ?>
                </div>
                <div class="top_five_shortstory">
                   <?php  echo $top5[2]->leiras ; ?>
                </div>
                <div class="top_five_filmtype">
                        Műfaj : <?php  echo $top5[2]->kategoria ; ?>
                    </div>
            </div>
            <div class="top_five" id="four">
                <div class="top_five_bar">
                    <div class="top_five_title">
                        <?php  echo $top5[3]->cim ; ?>
                    </div>
                    <div class="top_five_stars">
                        <?php echo $top5[3]->getNumErtekeles(); ?>
                       <?php  echo $top5[3]->getertekeles() ; ?>
                    </div>
                </div>
                <div class="adding_buttons">
                    <div class="to_fav">
                        <form method="post" action="index.php">
                            <input type="hidden" name="fid" value=<?php echo $top5[3]->id ?>>
                            <button type="submit" name="fav" class="favbutton">Kedvencekhez</button>
                        </form>
                    </div>
                    <div class="to_film_page">
                        <?php  $fid = $top5[3]->id ;
                           echo "<form action='filmpage.php' method='get'> ";
                            echo "<a href='filmpage.php?filmid=$fid'>Tovabb az adatlapra..</a> ";
                           echo "</form>"
                                              ?>
                    </div>
                </div>
                <div class="top_five_poster">
                <?php $poszt = $top5[3]->poszter;
                                      echo"<img src = '$poszt' style='height:100%'>" ;
                                 ?>
                </div>
                <div class="top_five_shortstory">
                    <?php  echo $top5[3]->leiras ; ?>
                </div>
                <div class="top_five_filmtype">
                        Műfaj : <?php  echo $top5[3]->kategoria ; ?>
                    </div>
            </div>

            <div class="top_five" id="five">
                <div class="top_five_bar">
                    <div class="top_five_title">

                        <?php  echo $top5[4]->cim ; ?>
                    </div>
                    <div class="top_five_stars">
                        <?php echo $top5[4]->getNumErtekeles(); ?>
                       <?php  echo $top5[4]->getertekeles() ; ?>
                    </div>
                </div>
                <div class="adding_buttons">
                    <div class="to_fav">
                        <form method="post" action="index.php">
                            <input type="hidden" name="fid" value=<?php echo $top5[4]->id ?>>
                            <button type="submit" name="fav" class="favbutton">Kedvencekhez</button>
                        </form>
                    </div>
                    <div class="to_film_page">
                        <?php  $fid = $top5[4]->id ;
                                                echo "<form action='filmpage.php' method='get'> ";
                                               echo "<a href='filmpage.php?filmid=$fid'>Tovabb az adatlapra..</a> ";
                                               echo "</form>"
                                              ?>
                    </div>
                </div>
                <div class="top_five_poster">
                <?php $poszt = $top5[4]->poszter;
                      echo"<img src = '$poszt' style='height:100%'>" ;
                 ?>
                </div>
                <div class="top_five_shortstory">
                   <?php  echo $top5[4]->leiras ; ?>
                </div>
                <div class="top_five_filmtype">
                        Műfaj : <?php  echo $top5[4]->kategoria ; ?>
                    </div>
            </div>
            <!--~~~~~~Utolso ot film divek EDDIG-->
        </div>
    </main>
</body>

