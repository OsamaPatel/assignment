<?php
    include('./partials/header.php');
    
    $start = 0;
    $current_page = 1;
    if(isset($_GET['start'])){
        $start = mysqli_real_escape_string($conn,$_GET['start']);
        if($start<=0){
            $start = 0;
            $current_page = 1;
        }else{
            $current_page = $start;
            $start--;
            $start = $start*5;
        }
    }

    $records_per_page = 5;
    $student_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM students"));
    $pages = ceil($student_count/$records_per_page);
    
    $get_student_data = "SELECT * FROM students LIMIT $start,$records_per_page";
    $student_data_res = mysqli_query($conn,$get_student_data);
    // if(isset($_GET['search'])){
    //     $search = $_GET['search'];
    //     $get_student_data = "SELECT * FROM students WHERE CONCAT(student_first_name, ' ',
    //     student_last_name, ' ',
    //     student_address, ' ',
    //     student_mobile, ' ',
    //     student_email) LIKE '%$search%'";
    //     $student_data_res = mysqli_query($conn,$get_student_data);
    // }
?>
<div class="container my-5">
    <h2 class="mb-30">Assignment</h2>
        <div class="my-3 row">
            <div class="col">
                <form class="form-inline" action="searchStudent.php" method="get">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" id="searchInput">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div class="col text-right">
                <a href="addStudent.php">
                    <button type="button" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg> Add Student
                    </button>
                </a>
            </div>
        </div>
        <table class="table mt-20" id="myTable">
        <thead>
            <tr>
            <th scope="col">Sr.No</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Address</th>
            <th scope="col">Contact no.</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
    
        <?php 
            $sr_no = $start;
            if(mysqli_num_rows($student_data_res) > 0){
            while($student_row = mysqli_fetch_assoc($student_data_res)){
                $sr_no++;
                $id = $student_row['id'];
        ?>
        <tr>
        <th scope="row"><?php echo $sr_no; ?></th>
      
        <td><?php echo $student_row['student_first_name']?></td>
        <td><?php echo $student_row['student_last_name']?></td>
        <td><?php echo $student_row['student_address']?></td>
        <td><?php echo $student_row['student_mobile']?></td>
        <td><?php echo $student_row['student_email']?></td>
        <td>
            <a href="updateStudent.php?id=<?php echo $student_row['id']; ?>">
                <button type="button" class="btn btn-success editbtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                    </svg> Edit
                </button>
            </a>
            <a href="javascript:void(0)" class="deletebtn" data-student-id="<?php echo $student_row['id'] ?>">
                <button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>Delete
                </button>
            </a>
        <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="deleteStudent.php" method="POST">
                            <input type="hidden" name="delete_id" id="delete_id">
                                <div class="modal-body">
                                    Are you sure you want to delete this student?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <?php 
            } 
        }else {
            ?>
	        <tr><td>No records</td></tr>
            <?php
        } 
    ?>   
        
        </tbody>
    </table>         
    <ul class="pagination mt-30">
        <?php 
            for($i=1;$i<=$pages;$i++){
            $class='';
            if($current_page==$i){
                ?>
                    <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?php echo $i?></a></li>
                <?php
            }else{
            ?>
                <li class="page-item"><a class="page-link" href="?start=<?php echo $i?>"><?php echo $i?></a></li>
            <?php
            }
        } 
        ?>
  </ul>
</div>
<?php
    include('./partials/footer.php');
?>

