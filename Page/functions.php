<?php
function addToFavourites($db,$fiokUsername,$id){
        $fav=mysqli_query($db,"SELECT FilmID FROM kedvencek WHERE fiokUsername='$fiokUsername'");
        $favorit=array();
        while($sor=mysqli_fetch_assoc($fav)){
            $FilmID=$sor['FilmID'];
            array_push($favorit,$FilmID);
        }
        $bennevan=false;
        for($i=0;$i<count($favorit);$i++){
            if($favorit[$i]==$id){
                echo "<script> alert('A film már hozzá van adva a kedvencekhez!') </script>";
                $bennevan=true;
                break;
            }
        }
        if(!$bennevan) {
            mysqli_query($db, "INSERT INTO kedvencek VALUES('$fiokUsername','$id')");
            echo "<script>alert('Hozzáadva a kedvencekhez!') </script>";
             header("Refresh: 0; url=".$_SERVER['HTTP_REFERER']);
        }

}
