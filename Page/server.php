<?php
include "functions.php";
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $username="";
    $email="";
    $regs=false;
    $errors=array();
    if(!isset($_SESSION['lastvisited'])){
        $_SESSION['lastvisited']=array();
        $_SESSION['lastvisitedurl']=array();
    }


    //csatlakozas az adatbazishoz
    if($_SERVER['SERVER_NAME']=='localhost')
        $db=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
    if($_SERVER['SERVER_NAME']=='project-imdb.gat-worldhost.tk')
        $db=mysqli_connect('sql205.gat-worldhost.tk','gatw_22922717','c4QSyKBV','gatw_22922717_imdb') or die("Couldn't connect!");


    //Regisztracio
    if(isset($_POST['register'])){
        $username=mysqli_real_escape_string($db,$_POST['username']);
        $email=mysqli_real_escape_string($db,$_POST['email']);
        $password_1=mysqli_real_escape_string($db,$_POST['password_1']);
        $password_2=mysqli_real_escape_string($db,$_POST['password_2']);


        //Input-ellenorzes
        if (empty($username)){
            array_push($errors,"Adjon meg felhasználónevet!");
        }
        $queryusername="SELECT * FROM fiok WHERE FiokUsername='$username'";
        $result=mysqli_query($db,$queryusername);
        if(mysqli_num_rows($result)!=0){
            array_push($errors,"Ez a felhasználónév már foglalt!");
        }

        $queryemail="SELECT * FROM fiok WHERE FiokEmail='$email'";
        $result=mysqli_query($db,$queryemail);
        if(mysqli_num_rows($result)!=0){
            array_push($errors,"Erről az e-mail címről már regisztráltak!");
        }


        if (empty($email)){
            array_push($errors,"Adjon meg e-mail címet!");
        }
        if (empty($password_1)){
            array_push($errors,"Adjon meg jelszót!");
        }
        if($password_1 != $password_2){
            array_push($errors, "A két jelszó nem egyezik meg!");
        }

        //Ha nincs hiba,
        if(count($errors)==0){
            $password=password_hash($password_1,PASSWORD_DEFAULT); //Jelszo titkositasa
            $name=ucwords($username);
            $sql="INSERT INTO fiok(FiokUsername, FiokNev, FiokEmail, FiokJelszo, Jog)  
                  VALUES('$username','$name','$email','$password',1)";
            mysqli_query($db,$sql);
            $regs=true;
            header("Refresh: 3; url=index.php"); //Atiranyitas a fooldalra
        }



    }

    //Bejelentkezes eseten
    if (isset($_POST['login'])){

        $username=mysqli_real_escape_string($db,$_POST['username']);
        $password=mysqli_real_escape_string($db,$_POST['password_1']);

        //Input ellenorzes
        if(empty($username)){
            array_push($errors,"A Felhasználónév hiányzik!");
        }
        if(empty($password)){
            array_push($errors," A Jelszó hiányzik!");
        }

        //Megfelelo adatok eseten bejelentkezes
        if(count($errors)== 0){
            $query="SELECT * FROM fiok WHERE FiokUsername='$username'";
            $result=mysqli_query($db,$query);
            if(mysqli_num_rows($result)==1){
                while($row=mysqli_fetch_array($result)){
                    if(isset($row["FiokJelszo"])) {
                        if (password_verify($password, $row["FiokJelszo"])) {
                            $x = $row['FiokUsername'];
                            $sql = "SELECT Bann,Jog FROM fiok WHERE FiokUsername='$x'";
                                $conn=mysqli_connect('localhost','root','','imdb') or die ("Couldn't connect!");
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) == 1) {
                                        $row = mysqli_fetch_assoc($result);
                                        if ($row["Bann"]==1 and $row["Jog"]<=2){
                                            array_push($errors, "Bannolva vagy!");
                                        }
                                        else{
                                        	$query="SELECT * FROM fiok WHERE FiokUsername='$username'";
            								$result=mysqli_query($db,$query);
            								$row=mysqli_fetch_array($result);
                                            $_SESSION["username"] = $username;
                                            $_SESSION["name"]=$row['FiokNev'];
                                            $_SESSION["email"]=$row['FiokEmail'];
                                            $_SESSION['loggedin'] = true;
                                        }
                                } 
                        } else {
                            array_push($errors, "Rossz felhasználónév/jelszó kombináció!");
                        }
                    }

                }

            }else{
                array_push($errors,"Rossz felhasználónév/jelszó kombináció!");
            }
        }
    }

    //Kijelentkezes
    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("location: ".$_SERVER['HTTP_REFERER']);
    }

    if(isset($_SESSION['username']) and isset($_POST['rmfav'])){
        $filmID=$_POST['favid'];
        $user=$_SESSION['username'];
        $sql="DELETE FROM kedvencek WHERE filmID='$filmID' AND fiokUsername='$user';";
        echo $filmID."   ".$user;
        mysqli_query($db,$sql) or die('Nem sikerült az utasítás!');
        echo "<script> alert('A film el lett távolítva a kedvencek közül');</script>";
        header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']);
    }


    if(isset($_SESSION['username']) and isset($_POST['fid'])) {
        addToFavourites($db,$_SESSION['username'],$_POST['fid']);
    } else if(!isset($_SESSION['username']) and isset($_POST['fid'])) {
        echo "<script> alert('Jelentkezzen be!'); </script>";
    }



    if(isset($_SESSION['username']) and isset($_POST['modalias'])){
        $user=mysqli_real_escape_string($db,$_SESSION['username']);
        $alias=mysqli_real_escape_string($db,$_POST['newalias']);
        if(empty($alias)){
            echo "<script> alert('Nem adott meg új becenevet!') </script>";
        }else{
            $sql="UPDATE fiok SET FiokNev='$alias' WHERE fiokUsername='$user';";
            mysqli_query($db,$sql) or die("Couldn't connect!");
            $_SESSION['name']=$alias;
        }
        header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']);
    }

if(isset($_SESSION['username']) and isset($_POST['modemail'])){
    $user=mysqli_real_escape_string($db,$_SESSION['username']);
    $newemail=mysqli_real_escape_string($db,$_POST['newemail']);
    if(empty($newemail)){
        echo "<script> alert('Nem adott meg új email címet!') </script>";
    }else{
        $sql="SELECT FiokEmail FROM fiok WHERE FiokEmail='$newemail';";
        $res=mysqli_query($db,$sql) or die("Couldn't connect!");
        if(mysqli_num_rows($res)!=0){
            echo "<script> alert('Ez az email cím már foglalt!') </script>";
        }else {
            $sql = "UPDATE fiok SET FiokEmail='$newemail' WHERE fiokUsername='$user';";
            mysqli_query($db, $sql) or die("Couldn't connect!");
            $_SESSION['email'] = $newemail;
        }
    }
    header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']);
}

if(isset($_SESSION['username']) and isset($_POST['modalias'])){
    $user=mysqli_real_escape_string($db,$_SESSION['username']);
    $alias=mysqli_real_escape_string($db,$_POST['newalias']);
    if(empty($alias)){
        echo "<script> alert('Nem adott meg új becenevet!') </script>";
    }else{
        $sql="UPDATE fiok SET FiokNev='$alias' WHERE fiokUsername='$user';";
        mysqli_query($db,$sql) or die("Couldn't connect!");
        $_SESSION['name']=$alias;
    }
    header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']);
}

if(isset($_SESSION['username']) and isset($_POST['modpass'])){
    $user=mysqli_real_escape_string($db,$_SESSION['username']);
    $newpass_1=mysqli_real_escape_string($db,$_POST['newpass_1']);
    $newpass_2=mysqli_real_escape_string($db,$_POST['newpass_2']);
    if (empty($newpass_1)){
        echo "<script> alert('Adjon meg jelszót!')</script>";
        header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']);
    }else {
        if ($newpass_1 != $newpass_2) {
            echo "<script> alert('A két jelszó nem egyezik meg!')</script>";
            header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']);
        } else{
            $password=password_hash($newpass_1,PASSWORD_DEFAULT);
            $sql="UPDATE fiok SET FiokJelszo='$password' WHERE fiokUsername='$user';";
            mysqli_query($db,$sql) or die("Couldn't connect!");
            session_destroy();
            echo "<script> alert('Jelentkezzen be az új jelszóval!')</script>";
            header("Refresh: 0; url=index.php");
        }
    }
}



