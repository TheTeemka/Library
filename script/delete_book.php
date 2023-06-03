<?php 
    include('database.php') ;
    $order_id = $_GET['order_id'] ;
    $name_surname = $_GET['name_surname'] ;
    $sql = "DELETE FROM `order` WHERE `order_id` = '$order_id'" ;
    $result = mysqli_query($connection , $sql) ;
    header('location: ../students_record.php?name_surname='.$name_surname.'&submit=') ;
?>