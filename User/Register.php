<?php session_start(); ?>
<!DOCTYPE html>
<!-- <?php
// include("C:/xampp/htdocs/FYP/dataconnection.php");

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST["Email_id"]) && isset($_POST["contact_person"]) && isset($_POST["phone_number"]) && isset($_POST["business_name"]) && isset($_POST["password"])) {
//         $email = mysqli_real_escape_string($connect, $_POST["Email_id"]);
//         $contact_person = mysqli_real_escape_string($connect, $_POST["contact_person"]);
//         $phone_number = mysqli_real_escape_string($connect, $_POST["phone_number"]);
//         $business_name = mysqli_real_escape_string($connect, $_POST["business_name"]);
//         $password = mysqli_real_escape_string($connect, $_POST["password"]);

//         // Perform the database insertion
//         $sql = "INSERT INTO company (CompanyEmail, ContactPerson, CompanyPhone, CompanyName, company_password) 
//                 VALUES ('$email', '$contact_person', '$phone_number', '$business_name', '$password')";
//     }
// }
?> -->
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/register.css">
</head>
<body>
<nav class="navbar">
    <div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="index.php">
					<img src="vendors/images/logo.png" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="Login.php">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
    </nav>
<div id="loadingIndicator" class="loader" style="display: none;"></div>
<div class="container">
    <div class="header">
    <h2>Company Register</h2>
    </div>
    <!-- C:/xampp/htdocs/FYP/ -->
    <form class="form" id="form" method="post" action="insert_data.php">
        <div class="form-control">
            <label>Email Login ID</label>
            <input type="text" id="emailLoginID" placeholder="Email" name="Email_id">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label>Contact Person Name</label>
            <input type="text" id="ContactPersonName" placeholder="David / Eric / Lee WenXuan" name ="contact_person">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label>Mobile Phone number</label>
            <input type="text" id="MobilePhoneNumber" name="phone_number">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label>Registered Business Name</label>      
            <input type="text" id="BusinessName" placeholder="Same as business registration documents" name="business_name">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div class="form-control">
            <label>Password</label>
            <input type="text" id="password" name="password">
            <i class="bi bi-eye-slash" id="togglePassword"></i>
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <input type="submit" value="Submit" id="submitbtn">
    </form>
</div>
</body>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    const form = document.getElementById('form');
const emailLoginID = document.getElementById('emailLoginID');
const BusinessName = document.getElementById('BusinessName');
const MobilePhoneNumber = document.getElementById('MobilePhoneNumber');
const password = document.getElementById('password');
const ContactPersonName = document.getElementById('ContactPersonName');
form.addEventListener('submit',(e)=>{
    const verification = {
        emailLoginID: false,
        BusinessName: false,
        MobilePhoneNumber: false,
        password: false,
        ContactPersonName: false,
      };
    e.preventDefault();

    checkInputs(verification);
});
function checkInputs(verification){
    //get the values from the inputs
    const emailLoginIDValue = emailLoginID.value.trim();
    const ContactPersonNameValue = ContactPersonName.value.trim();
    const BusinessNameValue = BusinessName.value.trim();
    const passwordValue = password.value.trim();
    const MobilePhoneNumberValue = MobilePhoneNumber.value.trim();

    const minlength = 8;
    const maxlength = 16;

    //Contact Person name
    if(ContactPersonNameValue === '')
    {
        setErrorFor(ContactPersonName,'Please provide your full name');
    }
    else{
        setSuccessFor(ContactPersonName);
        verification.ContactPersonName= true;
    }
    //alert(verification.ContactPersonName);
    //Bussinesss Name
    if(BusinessNameValue === '')
    {
        setErrorFor(BusinessName,'Please provide your registered business name.');
    }
    else{
        setSuccessFor(BusinessName);
        verification.BusinessName= true;
    }
    //alert(verification.BusinessName);
    //Phone nummber
    if(MobilePhoneNumberValue === '')
    {
        setErrorFor(MobilePhoneNumber,'Please enter a valid contact number using numbers (0-9) only');
    }
    else{
        setSuccessFor(MobilePhoneNumber);
        verification.MobilePhoneNumber= true;
    }
    //alert(verification.MobilePhoneNumber);
    //Password
    if(passwordValue === '')
    {
        setErrorFor(password,'Password cannot be blank');
    }
    else if (!/\d/.test(passwordValue))
    {
        setErrorFor(password,'Password must be consist one number');
    }
    else if (!/[a-zA-Z]/.test(passwordValue))
    {
        setErrorFor(password,'Password must be consist one character');
    }
    else if (passwordValue.length < minlength)
    {
        setErrorFor(password,'Password must be at least 8 characters');
    }
    else if (passwordValue.length > maxlength)
    {
        setErrorFor(password,'Password must be less than 20 characters');
    }
    else{
        setSuccessFor(password);
        verification.password= true;
    }
    //alert(verification.password);
    //Email Login ID
    if(emailLoginIDValue === '')
    {
        setErrorFor(emailLoginID,'Email address cannot be blank');
        VerificationResult(verification);
    }
    else if(!isEmail(emailLoginIDValue))
    {
        setErrorFor(emailLoginID,'Please enter a valid email address');
        VerificationResult(verification);
    }else{
        // Perform email verification using AJAX before proceeding with the form submission
        //alert("checking process");
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'check_email.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
        //alert('ReadyState: ' + xhr.readyState); // Debug - Check the readyState changes
        if (xhr.readyState === 4) {
            // console.log('ReadyState: ' + xhr.readyState); // Debug - Check the readyState changes
            // console.log('Response Text: ' + xhr.responseText); // Debug - Check the response received
            // console.log('Status: ' + xhr.status); // Debug - Check the AJAX request status
                if (xhr.responseText === 'exists') 
                {
                    console.log("Exist");
                    setErrorFor(emailLoginID, 'Email already exists');
                    VerificationResult(verification);
                }
                else if(xhr.responseText === 'not_exists')
                {
                    console.log("Not exist");
                    verification.emailLoginID = true;
                    setSuccessFor(emailLoginID);
                    //alert("1 : "+verification.emailLoginID);
                    VerificationResult(verification);
                }
                else{
                    console.log("Error");
                    VerificationResult(verification);
                }
            }
        };
        xhr.send('email=' + encodeURIComponent(emailLoginIDValue));
        //alert("2 : "+verification.emailLoginID);
    }
}
function setErrorFor(input,message){
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');

    small.innerText = message;

    formControl.className = 'form-control error';
}
function setSuccessFor(input){
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    small.innerText="";
    formControl.className = 'form-control success';
}

function isEmail(ContactPersonName){
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailPattern.test(ContactPersonName);
}
function VerificationResult(verification)
{
    if (verification.emailLoginID && verification.BusinessName && verification.MobilePhoneNumber && verification.password && verification.ContactPersonName)
    {  
    swal({
        title: "Success!",
        text: "OTP send to your email !",
        icon: "success",
        button: "OK!",
      }).then((value) => {
        //if (value) {
         showLoadingIndicator();
         form.submit();
        //}
      });
    }
    else{
        swal({
            title: "Failed!",
            text: "Please fill out all information!",
            icon: "error",
            button: "OK",
          });
    }
}
function showLoadingIndicator() {
    document.getElementById("loadingIndicator").style.display = "block";
}

// 在加载完成后隐藏Loading特效
window.addEventListener("load", function() {
    hideLoadingIndicator();
});

function hideLoadingIndicator() {
    document.getElementById("loadingIndicator").style.display = "none";
}
</script>
</html>