<?php //include("server.php"); ?>
<div class="login_logout">
    <!-- error -->
    <?php if(!isset($_SESSION['username'])) { ?>
        <?php if (count($errors)!=0):?>
        <?php foreach ($errors as $error): ?>
        <script> alert("<?php echo $error; ?>");</script>
    <?php endforeach ?>
    <?php endif ?>

        <form method="post" action="index.php">
            <input type="text" name="username" placeholder="Felhasználónév" class="user_name">
            <input type="password" name="password_1" placeholder="Jelszó" class="user_pwd">
            <button type="submit" name="login" class="user_login_button">Bejelentkezés</button>
            <a href="register.php"><button type="button" name="linktoreg" class="user_login_button">Regisztráció</button> </a>
        </form>

    <?php } else{?>
        <div id="logged">
            <?php echo "Üdvözöljük, $_SESSION[name]";
            echo "</p>";?>
             <a href="userpage.php"><button type="button" class="user_logout_button">Tovább az adatlapra</button> </a>
             <a href="index.php?logout='1'"><button type="button" name="logout" class="user_logout_button">Kijelentkezés</button> </a>
        </div>
        

    <?php } ?>
</div>
<?php if(isset($_SESSION['username'])): ?>
<div class ="favourites">
    <div class="favourites_title">
        <p>Kedvencek</p>
    </div>

            <?php
                $fiokUsername=$_SESSION['username'];
                $fav=mysqli_query($db,"SELECT FilmCim,FilmID FROM film
                                            WHERE FilmID IN (SELECT FilmID FROM kedvencek WHERE fiokUsername='$fiokUsername')");
                $favorit=array();
                $favoritlink=array();
                $favoritID=array();
                while($sor=mysqli_fetch_assoc($fav)){
                    $filmCim=$sor['FilmCim'];
                    $filmLink="filmpage.php?filmid=".$sor['FilmID'];
                    $filmID=$sor['FilmID'];
                    array_push($favorit,$filmCim);
                    array_push($favoritlink,$filmLink);
                    array_push($favoritID,$filmID);
                } ?> <table> <?php
                for($i=0;$i<count($favorit);$i++){
                    echo "<tr>";
                    echo "<td><p><a id='favourit_link' href=".$favoritlink[$i].">".$favorit[$i]."</a></p>";
                    echo "<td><form action='server.php' method='post'>";
                    echo "<td><input type='hidden' name='favid' value=\"".$favoritID[$i]."\">";
                    echo "<td><input type='submit' name='rmfav' id='kedvenctorol' value=''>";
                    echo "</tr>";
                    echo "</form>";
                }
            ?> </table>
</div>
<?php endif ?>
<div class ="last_seen">
    <div class="last_seen_title">
        <p>Utoljára megtekintett filmek</p>
        <?php
            if (count($_SESSION['lastvisited'])>0){
               for ($i=1;$i<=count($_SESSION['lastvisited']);$i++):
               echo "<p><a id='last_seen_link' href=".$_SESSION['lastvisitedurl'][count($_SESSION['lastvisitedurl'])-$i].">".$_SESSION['lastvisited'][count($_SESSION['lastvisited'])-$i]."</a></p>";
               if($i>4)
                   break;
               endfor;
            }
        ?>
    </div>
    <!--UTOLJARA MEGTEKINTETT -->
</div>
