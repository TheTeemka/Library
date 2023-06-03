<?php 
    include('database.php') ;
    $name_surname = $_GET['name_surname'] ;
    $name_surname = standartize($name_surname) ;
    $sql = "INSERT INTO `student`(`name_surname`) VALUES('$name_surname')" ;
    $result = mysqli_query($connection , $sql) ;
    header('location: ../../students_record.php?name_surname='.$name_surname.'&submit=') ;
?>