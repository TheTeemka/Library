<?php 
    $servername = "localhost" ;
    $username = "root" ;
    $password = "" ;
    $database = "library" ;

    $connection = new mysqli($servername , $username , $password , $database) ;
    if($connection->connect_error){
        die("connection failed" . $connection->connect_error) ;
    }
    function standartize($name_surname){
        $res = "" ;
        $step = 0 ;
        $name_surname = trim(ucwords(strtolower($name_surname))) ;
        for($i = 0 ; $i < strlen($name_surname) ; $i++){
            if($step <= 1  and  $name_surname[$i] != ' '){
                $step = 1;
                $res .= $name_surname[$i] ;
            }
            else if($step == 1 and $name_surname[$i] == ' '){
                $step = 2;
                $res .= $name_surname[$i] ;
            }
            else if($step <= 3 and  $name_surname[$i] != ' '){
                $res .= $name_surname[$i] ;
                $step = 3;
            }
            else if($step == 3 and $name_surname[$i] == ' '){
                $res .= $name_surname[$i] ;
                $step = 4; 
            }
            else if($step <= 5 and  $name_surname[$i] != ' '){
                $res .= $name_surname[$i] ;
                $step = 5;
            }
            else if($step == 5 and $name_surname[$i] == ' '){
                $step = 6 ; 
            }
        }
        return $res ;
    }
?>