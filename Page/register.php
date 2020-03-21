<?php include('server.php'); ?>


<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <meta name="description" content="2018/2019 I. RF1 Csütörtök 9:00 IMDb csapat projektje.">
    <meta name="keywords" content="Regisztracio">
    <meta name="author" content="Szabo Tamas">
    <link rel="stylesheet" type="text/css" href="reg.css">
    <title>Regisztáció</title>
    <style>
                *{
            margin: 0;
            padding: 0;
        }
        body{
            background-image: url("background.jpg");
            background-size: cover;
        }

        .header{
            width: 20%;
            margin: 50px auto 0;
            color:black;
            background: #5F9EA0;
            text-align: center;
            border: 1px solid #B0C4DE;
            border-bottom: none;
            border-radius: 10px 10px 0px 0px;
            padding: 20px;
        }
        form{
            width: 20%;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            border: 1px solid #B0C4DE;
            background: white;
            border-radius: 0 0 10px 10px;
        }
        .error{
            width: 92%;
            margin: 0px auto;
            padding: 10px;
            border: 1px solid #A94442;
            color: #A94442;
            border-radius: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Regisztráció</h2>
    </div>
    <form method="post" action="register.php">
        <!-- error-->
        <?php
        if(count($errors)==0 and $regs){?>
            <div class="error"> <p>Sikeres regisztáció!</p></div>
        <?php }else {
            include("errors.php");
        }?>

        <div class="input-group">
            <label><strong>Felhasználónév:</strong></label><br/>
            <input type="text" name="username" placeholder="pelda012" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label><strong>E-mail cím:</strong></label><br/>
            <input type="email" name="email" placeholder="pelda012@pelda.com" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <label><strong>Jelszó:</strong></label><br/>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label><strong>Jelszó megerősítése:</strong></label><br/>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" name="register" class="register">Regisztáció</button>
        </div>
        <div>
            <br/>
            <p>Már van fiókja? <a href="index.php">Jelentkezzen be!</a></p>
        </div>
    </form>

</body>
</html>