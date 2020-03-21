<?php
include('server.php');
if(isset($_POST['hozzaszolas'])&&isset($_POST['submit'])){
$str = $_POST['hozzaszolas'] ;
$day = date("Y-m-d");
$fid = $_POST['filmid'];
$uname = $_SESSION['username'];
$sql = "INSERT INTO hozzaszolasok(HozzaszolasID,HozzaszolasIdo,HozzaszolasSzoveg,FilmID,FiokUsername) VALUES ('','$day','$str','$fid','$uname')" ;
$res = mysqli_query($db,$sql);
header("Location:filmpage.php?filmid=".$fid);

}

?>

