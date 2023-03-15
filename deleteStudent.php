<?php
    include('./config/conn.php');
    if(isset($_POST['submit'])){
        $id = mysqli_real_escape_string($conn,$_POST['delete_id']);
        $delete_student = "DELETE FROM students WHERE id = $id";
        $delete_student_res = mysqli_query($conn,$delete_student);
        header('location:index.php');
    }
?>