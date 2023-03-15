<?php
    include('./partials/header.php');
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn,$_GET['id']);
        $get_student_data = "SELECT * FROM students WHERE id = $id";
        $student_data_res = mysqli_query($conn,$get_student_data);
        $student_row = mysqli_fetch_assoc($student_data_res);
    }else{
        header('location:index.php');
    }
    if(isset($_POST['submit'])){
        $first_name = mysqli_real_escape_string($conn,$_POST['student_first_name']);
        $last_name = mysqli_real_escape_string($conn,$_POST['student_last_name']);
        $student_address = mysqli_real_escape_string($conn,$_POST['student_address']);
        $student_contact = mysqli_real_escape_string($conn,$_POST['student_contact']);
        $student_email = mysqli_real_escape_string($conn,$_POST['student_email']);
        $error_email = "";
        $error_contact = "";
        if(is_numeric(trim($student_contact)) == false){
            $error_contact =  "<span class='error'>Please enter numeric value.</span>";
        }elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $student_email)){
            $error_email= "<span class='error'>Please enter valide email, like your@abc.com</span>";
        }else{
            $update_student = "UPDATE students SET 
                student_first_name = '$first_name',
                student_last_name = '$last_name',
                student_address = '$student_address',
                student_mobile = '$student_contact',
                student_email = '$student_email'
                WHERE id = $id
            ";
            $update_student_res = mysqli_query($conn,$update_student);
            if($update_student_res){
                header('location:index.php');
            }else{
                header('Refresh:0');
            }
        }
    }
?>
<div class="container my-3">
    <form action="" method="post" onsubmit="return validateForm()">
        <h1>Update Student</h1>
        <div class="form-group">
        <label for="student_first_name">First Name</label>
        <input type="text" class="form-control" id="student_first_name" name="student_first_name" value="<?php echo $student_row['student_first_name'] ?>" required>
        <div id="invalid_first_name"></div>
    </div>
    <div class="form-group">
        <label for="student_last_name">Last Name</label>
        <input type="text" class="form-control" id="student_last_name" name="student_last_name" value="<?php echo $student_row['student_last_name'] ?>" required>
        <div id="invalid_last_name"></div>
    </div>
    <div class="form-group">
        <label for="student_address">Address</label>
        <textarea class="form-control" id="student_address" name="student_address" rows="3" required><?php echo $student_row['student_address'] ?></textarea>
        <div id="invalid_address"></div>
    </div>
    <div class="form-group">
        <label for="student_contact">Contact Number</label>
        <input type="text" class="form-control" id="student_contact" name="student_contact" value="<?php echo $student_row['student_mobile'] ?>" required>
        <div id="invalid_contact"></div>
    </div>
    <div class="form-group">
        <label for="student_email">Email</label>
        <input type="email" class="form-control" id="student_email" name="student_email" value="<?php echo $student_row['student_email'] ?>" required>
        <div id="invalid_email"></div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
    include('./partials/footer.php');
?>