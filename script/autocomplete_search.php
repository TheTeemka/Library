<?php
    include('database.php') ;
    if(isset($_POST['search'])){
        $search = $_POST['search'] ;
        $type = $_POST['type'] ;
        $database = $_POST['database'] ;
        $search = standartize($search) ;
        $sql = "SELECT ".$type." FROM ".$database." WHERE ".$type." LIKE '".$search."%' ORDER BY ".$type;
        $result = mysqli_query($connection , $sql) ;
        $output = array() ;
        if(mysqli_num_rows($result) > 0){  
            while($row = mysqli_fetch_array($result)){  
                $output[] = $row['name_surname'];  
            }  
        }else{   
            $output[] = "Not found" ;
        }  
        echo json_encode($output ) ;
    }
    else{
        echo "LOX" ;
    }
?>