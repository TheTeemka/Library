<?php 
    include('database.php') ;
    $student_id = $_POST['student_id'] ;
    $book_name = $_POST['book_name'] ;
    $school_id = $_POST['school_id'] ;
    $name_surname = $_POST['name_surname'] ;
    $student_id = standartize($student_id)  ;
    $book_name = standartize($book_name) ;
    $school_id = standartize($school_id) ;
    $date = date('Y-m-d') ;
    if(strlen($student_id ) and strlen($book_name ) and strlen($school_id)){
        $sql = "INSERT INTO `order` (`student_id`,`book_name` , `school_id` , `date` ) VALUES('$student_id' , 
        '$book_name' , '$school_id' , '$date' )";
        $result = mysqli_query($connection , $sql) ;
    }
    else{
        echo 'FUCK' ;
    }
    header('location: ../students_record.php?name_surname='.$name_surname.'&submit=') ;
?>