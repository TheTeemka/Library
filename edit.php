
<?php 
    include('database.php') ;
    $id = $_GET['id'] ;

    if(isset($_POST['submit'])){
        $name = $_POST['name'] ;
        $surname = $_POST['surname'] ;
        $class = $_POST['class'] ;
        $sql = "UPDATE student_record  SET `name` = '$name' , `surname` = '$surname' , `class` = '$class' WHERE `id` = $id " ;
        $result = mysqli_query($connection , $sql) ;

        if(!$result){
            echo "invalid query" ;
        }
        else{
            echo "Succesfull query" ;
            header("location: /project/students-record.php") ;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel = "stylesheet" href = "styles/navigation.css" >
        <title >Add_student</title>
    </head>
    <body>
        <nav>
            <div class = "nav-links" >
                <a href="students-record.php">Students record</a>
                <a href="borrowed.html">Borrowed books</a>
                <a href="find-book.html">Find owner of book</a>
            </div> 
            <div class = "LOGIN" >
                <a href="log.html">Log in</a>
            </div>
        </nav>
        <div class = "line" ></div>
        <?php 
            $sql = "SELECT * FROM student_record WHERE id = $id" ;
            $result = mysqli_query($connection , $sql) ;
            $row = mysqli_fetch_assoc($result) ;
        ?>
        <div class = "container" >
            <form method = "post">
                <input type = "text" name = "name"  value = "<?php echo $row['name']?>"> 
                <input type = "text" name = "surname"  value = "<?php echo $row['surname']?>"> 
                <input type = "text" name = "class"  value = "<?php echo  $row['class']?>"> 
                <button type= "submit" name = "submit" > Submit </button> 
            </form>
        </div>
    </body>
</html>