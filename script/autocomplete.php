<?php
    include('database.php') ;
    if(isset($_POST['search'])){
        $search = $_POST['search'] ;
        $search = standartize($search) ;
        $sql = "SELECT `name_surname` FROM `student` WHERE `name_surname` LIKE '".$search."%' ORDER BY `name_surname`";
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