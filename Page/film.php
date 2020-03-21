<link rel="icon" type="image/png" href="icon.png"/>
<?php
class Movie{
               public $id ;
               public  $cim ;
               public  $kategoria ;
               public  $leiras ;
               public  $linki ;
               public  $ertekeles ;
               public  $eszam ;
               public  $poszter;
              public function __construct($i ,$c ,$k ,$l, $t, $e, $esz, $psz) {
                            $this->id = $i ;
                           $this->cim = $c;
                           $this->kategoria =  $k;
                           $this->leiras =  $l;
                           $this->linki =  $t;
                           $this->ertekeles =  $e;
                           $this->eszam =  $esz;
                           $this->poszter = $psz ;
               }
               public function getertekeles() {
               for ($i = 1 ; $i<=5 ; $i++){
                               if ($i>$this->ertekeles)
                               echo "<span>☆</span>" ;
                               else
                               echo "<span>★</span>";
                               }
               }

               public function getNumErtekeles(){
                  return '('.number_format($this->ertekeles,2).')';
               }

            }


class Comment{
            public $commentid ;
            public $idopont;
            public $szoveg;
            public $filmid;
            public $usname;

            public function __construct($id,$idop,$szo,$fid,$uname){
                $this->commentid = $id ;
                $this->idopont = $idop ;
                $this->szoveg = $szo ;
                $this->filmid = $fid ;
                $this->usname = $uname ;
            }

}

?>