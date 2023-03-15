<?php
    include('./partials/header.php');
    if(isset($_POST['submit'])){
        $first_name = trim(mysqli_real_escape_string($conn,$_POST['student_first_name']));
        $last_name = trim(mysqli_real_escape_string($conn,$_POST['student_last_name']));
        $student_address = trim(mysqli_real_escape_string($conn,$_POST['student_address']));
        $student_contact = trim(mysqli_real_escape_string($conn,$_POST['student_contact']));
        $student_email = trim(mysqli_real_escape_string($conn,$_POST['student_email']));
        // $error_first_name = "";
        // $error_last_name = "";
        // $error_address = "";
        $error_email = "";
        $error_contact = "";
        // if($first_name =="") {
        //     $error_first_name=  "<span class='error'>Please enter your first name.</span>";
        // }
        // else if($last_name == ""){
        //         $error_last_name=  "<span class='error'>Please enter your last name.</span>";

        //     }
            
        
        //     elseif($student_contact == ""){
        //     $error_contact =  "<span class='error'>Please enter phone number.</span>";
        //     }
        
            
            // elseif($student_address == ""){
            //     $error_address =  "<span class='error'>Please enter address.</span>";
            // }
            
            if(is_numeric(trim($student_contact)) == false){
            $error_contact =  "<span class='error'>Please enter numeric value.</span>";
            }
            // elseif(strlen($student_contact) < 10){
            // $error_contact=  "<span class='error'>Please enter valid contact no.</span>";
            // }
        
            // elseif($student_email == "") {
            //     $error_email=  "<span class='error'>Please enter your email</span>"; 
            // } 
            
            elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $student_email)){
                $error_email= "<span class='error'>Please enter valide email, like your@abc.com</span>";
            }

            else{
                $create_student = "INSERT INTO students SET 
                    student_first_name = '$first_name',
                    student_last_name = '$last_name',
                    student_address = '$student_address',
                    student_mobile = '$student_contact',
                    student_email = '$student_email'
                ";
                $create_student_res = mysqli_query($conn,$create_student);
                if($create_student_res){
                    header('location:index.php');
                }else{
                    header('Refresh:0');
                }
            }

    }
?>
<div class="container my-3">
    <form action="" method="post" name="add_form" id="add_student_form" onsubmit="return validateForm()" class="needs-validation" novalidate>
        <h1>Add Student</h1>
        <div class="form-group">
            <label for="student_first_name">First Name</label>
            <input type="text" class="form-control" id="student_first_name" name="student_first_name" placeholder="Osama" required>
            <div id="invalid_first_name"></div>
        </div>
        <div class="form-group">
            <label for="student_last_name">Last Name</label>
            <input type="text" class="form-control" id="student_last_name" name="student_last_name" placeholder="Patel" required>
            <div id="invalid_last_name"></div>
        </div>
        <div class="form-group">
            <label for="student_address">Address</label>
            <textarea class="form-control" id="student_address" name="student_address" rows="3" required></textarea>
            <div id="invalid_address"></div>
        </div>
        <div class="form-group">
            <label for="student_contact">Contact Number</label>
            <input type="text" class="form-control" id="student_contact" name="student_contact" placeholder="9988776655" required>
            <div id="invalid_contact"><?php if(isset($error_contact)) echo  $error_contact; ?></div>
        </div>
        <div class="form-group">
            <label for="student_email">Email</label>
            <input type="email" class="form-control" id="student_email" name="student_email" placeholder="osama@gmail.com" required>
            <div id="invalid_email"><?php if(isset($error_email)) echo $error_email; ?></div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
    include('./partials/footer.php');
?>