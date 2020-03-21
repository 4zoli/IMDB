<?php
      include('film.php');
      include('server.php');


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
        .founded_body  {
            position: relative;
            border-style: solid;
            border-width: 3px;
            border-color: #00264d;
            border-radius: 20px 20px 20px 20px;
            margin-left: 1vw;
            margin-bottom: 1vh;
            margin-top: 1vh;
            padding-left: 1vh;
            padding-top: 1vh;
            width: 40vw;
            height: 60vh;
            font-size: 2vh;
            background:#222222;

        }
        .background {
            margin-left: -1vh;
            position: absolute;
            bottom: 0;
            margin-bottom:-1vh;
        }
        .nothing{
        font-size : 3em;
        color : #fff;
        padding-top:20vh;
        font-weight: bold;
        }

        .body_min_height    {
            min-height: 100%;
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
                <h1>Találatok</h1>
            </div>

           <?php include("login.php"); ?>
            <!--BODY~~~~~~-->


            <?php
            echo "<div class='body_min_height'>";

       if(isset($_POST['submit'])){
            if(isset($_POST['kategori'])){
            $kategoria = $_POST['kategori'] ;
            $kategoriahalmaz =  implode(",",$kategoria);
            }
            $ker = $_POST['keresett'];
           if(empty($kategoria)){
                $sql = "SELECT * from film where FilmCim LIKE '%".$ker."%' ORDER BY FilmCim";

            }
            else{
               $sql = "SELECT * from film where FilmCim LIKE '%".$ker."%' and INSTR('$kategoriahalmaz',FilmKategoria) ORDER BY FilmCim;" ;
            }
            $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
             $res = mysqli_query($conn,$sql);
               $filmek = array() ;
                    while($sor = mysqli_fetch_assoc($res)){
                        $filmid=$sor['FilmID'];
                        $result=mysqli_query($conn,"SELECT AVG(pont) as atlag FROM ertekelesek WHERE FilmID='$filmid'; ") or die("Couldn't connect!");
                        $fetchRes=mysqli_fetch_assoc($result);
                        $sor['FilmErtekeles']=$fetchRes['atlag'];
                        $result=mysqli_query($conn,"SELECT COUNT(*) as szam FROM ertekelesek WHERE FilmID='$filmid'; ") or die("Couldn't connect!");
                        $fetchRes=mysqli_fetch_assoc($result);
                        $sor['FilmErtekelokSzama']=$fetchRes['szam'];
                       $fi = new Movie($sor['FilmID'],$sor['FilmCim'],$sor['FilmKategoria'],$sor['FilmLeiras'],$sor['FilmTrailler'],$sor['FilmErtekeles'],$sor['FilmErtekelokSzama'],$sor['FilmPoszter']) ;
                       $filmek[] = $fi ;
                    }
                $n = count($filmek) ;
                if($n>0){
                for($i=0;$i< $n ;$i++){
                  ?> <div class="top_five">
                                    <div class="top_five_bar">
                                        <div class="top_five_title">
                                         <?php  echo $filmek[$i]->cim ; ?>
                                        </div>
                                        <div class="top_five_stars">
                                          <?php  echo $filmek[$i]->getertekeles() ; ?>
                                        </div>
                                    </div>
                                    <div class="adding_buttons">
                                        <div class="to_fav">
                                            <form method="post" action="index.php">
                                                <input type="hidden" name="fid" value=<?php echo $filmek[$i]->id ?>>
                                                <button type="submit" name="fav" class="favbutton">Kedvencekhez</button>
                                            </form>
                                        </div>
                                        <div class="to_film_page">
                                          <?php  $fid = $filmek[$i]->id ;
                                            echo "<form action='filmpage.php' method='get'> ";
                                            echo "<a href='filmpage.php?filmid=$fid'>Tovabb az adatlapra..</a> ";
                                            echo "</form>"
                                          ?>
                                        </div>
                                    </div>
                                    <div class="top_five_poster">
                                      <?php $poszt = $filmek[$i]->poszter;
                                                            echo"<img src = '$poszt' style='height:100%'>" ;
                                                       ?>
                                    </div>
                                    <div class="top_five_shortstory">
                                        <?php  echo $filmek[$i]->leiras ; ?>
                                    </div>
                                    <div class="top_five_filmtype">
                                            Műfaj : <?php  echo $filmek[$i]->kategoria ; ?>
                                        </div>
                                </div>
           <?php     }
             }else{
                                  echo "<div class='founded_body'>";
                                  echo "<div class='nothing'>Nincs ilyen film az adatbázisban!</div>" ;
                           }}

            ?>

           </div>
            <!--~~~~~~BODY-->
        </div>
    </main>
</body>

<?php
if(isset($_SESSION['username']) and isset($_POST['fid'])) {
    addToFavourites($connect,$_SESSION['username'],$_POST['fid']);
} else if(!isset($_SESSION['username']) and isset($_POST['fid'])) {
    echo "<script> alert('Jelentkezzen be!'); </script>";
}


?>