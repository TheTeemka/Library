<?php 
    include('script/database.php') ;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel = "stylesheet" href = "style/navigation.css" >
        <link rel = "stylesheet" href = "style/search.css" >
        <link rel = "stylesheet" href = "style/record.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <title >Record</title>
    </head>
    <body>
        <nav>
            <div class = "nav-links" >
                <a href="students_record.php">Students record</a>
                <a href="borrowed.html">Borrowed books</a>
                <a href="find-book.html">Find owner of book</a>
            </div> 
            <div class = "LOGIN" >
                <a href="log.html">Log in</a>
            </div>
        </nav>
        <div class = "line"></div>
        <div class = "body_part" > 
            <div class = "search_box" >
                <form method = "GET" class = "search_bar">
                    <input type = "text" name = "name_surname" value = "<?php if(isset($_GET['name_surname']) ) echo $_GET['name_surname'] ; ?>"  
                    autocomplete = "off" placeholder= "surname name class" class = "search_bar_input" id = "search">
                    <button type = "submit" name = "submit" class = "search_bar_button"><img src = "image/search-symbol.png" widht = "20px" height = "20px"> </button>
                </form>
                <div class = "search_line" ></div>
                <div id = "list"  role = "listbox"  ></div>
            </div> 
            <div class = "table">
                <?php
                    if(isset($_GET['submit'])){
                        $name_surname = $_GET['name_surname'] ;
                        $name_surname = standartize($name_surname);
                        $name_surname = trim($name_surname) ;
                        $sql = "SELECT * FROM `student` WHERE `name_surname` = '$name_surname' " ;
                        $result=  mysqli_query($connection , $sql) ;
                        $row = mysqli_fetch_assoc($result) ;
                        if(!$row){
                            ?>
                            <div class = "search_error" >
                                <label>Such student not found</label>
                                <a href = "script/add_student.php/?name_surname=<?php if(isset($_GET['name_surname']) ) echo $_GET['name_surname'] ;?>"> Add this student</a>
                            </div>
                            <?php 
                        }
                        else{
                            $student_id = $row['student_id'] ;
                            ?>
                            <table class = "list" >
                                <thead>
                                    <tr>
                                        <th>Name of book </th>
                                        <th>school id</th>
                                        <th>date</th> 
                                        <th>operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT * FROM `order` WHERE `student_id` = '$student_id' ORDER BY `book_name`" ;
                                        $result = mysqli_query($connection , $sql) ;
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['book_name'] ?></td>
                                                <td><?php echo $row['school_id'] ?></td>
                                                <td><?php echo $row['date'] ?></td>
                                            <td>
                                                <a href = 'script/delete_book.php?order_id=<?php echo $row['order_id'] ?>&name_surname=<?php echo $name_surname?>' > Delete </a> 
                                            </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                             <label>Add new book</label>
                            <form method = "POST" , action = "script/add_book.php">
                                    <input name = "student_id" value = "<?php echo $student_id?> " type = "hidden">
                                    <input name = "name_surname" value = "<?php echo $name_surname?> " type = "hidden">
                                    <input name = "book_name" type = "text">
                                    <input name = "school_id" type ="text">
                                    <button name = "new_book_submit"> Submit</button>
                            </form>
                            <?php
                        }
                    }   
                ?>
            </div>
        <div>
    </body>
    <script src = "script/suggestion_name_surname.js"></script>
</html>