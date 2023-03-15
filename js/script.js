//validation
function validateForm(){  
    var firstName=document.getElementById('student_first_name').value;  
    var lastName=document.getElementById('student_last_name').value;  
    var address=document.getElementById('student_address').value;  
    var contact=document.getElementById('student_contact').value;  
    var email=document.getElementById('student_email').value; 
      
    if (firstName==null || firstName==""){
      document.getElementById('invalid_first_name').textContent = 'Invalid First Name';  
      document.getElementById('invalid_first_name').style.color = 'red';  
      return false;  
    }else if (lastName==null || lastName==""){
        document.getElementById('invalid_last_name').textContent = 'Invalid Last Name';  
        document.getElementById('invalid_last_name').style.color = 'red';  
        return false;  
    }else if (address==null || address==""){
        document.getElementById('invalid_address').textContent = 'Invalid Address';  
        document.getElementById('invalid_address').style.color = 'red';  
        return false;  
    }else if (contact==null || contact=="" || isNaN(contact) || contact.length<10){
        document.getElementById('invalid_contact').textContent = 'Invalid Mobile Number';  
        document.getElementById('invalid_contact').style.color = 'red';  
        return false;  
    }else if (email==null || email=="" || email.length<15){
        document.getElementById('invalid_email').textContent = 'Invalid Email';  
        document.getElementById('invalid_email').style.color = 'red';  
        return false;  
    }
}
  //get delete id
$(document).ready(function () {

    $('.deletebtn').on('click',function(e)  {
        var studentid = $(this).attr('data-student-id');
        console.log(studentid);
        $('#delete_id').val(studentid);
    });
});