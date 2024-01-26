<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $(document).ready(function () { 
    var hasErrors = false;
    console.log("add_admin");
    // Input event listener for first_name input
    $('#Fname').on('input', function () {
      validateInput($(this));
    });
    // Input event listener for last_name input
    $('#Lname').on('input', function () {
      validateInput($(this));
    });
    $('#date_of_birth').on('input', function () {
      validateDateOfBirth($(this));
    });
    $('#address').on('input', function () {
      validateAddress($(this));
    });
    $('#postcode').on('input', function () {
      validatePostCode($(this));
    });
    $('#email').on('input', function () {
        validateEmail($(this));
    });
    // $('#password').on('input', function () {
    //     validatePassword($(this));
    // });
    // $('#c_password').on('input', function () {
    //     validateConfirmPassword($(this), $('#password').val());
    // });
    $('#phone').on('input', function () {
      validatePhoneNumber($(this));
    });
    $('#addbtn').on('click', function (event) {
    var hasErrors = false;
    validateInput($('#Fname'));
    validateInput($('#Lname'));
    validateDateOfBirth($('#date_of_birth'));
    validateAddress($('#address'));
    validatePostCode($('#postcode'));
    validateEmail($('#email'));
    validatePhoneNumber($('#phone'));
    // validatePassword($('#password'));
    // validateConfirmPassword($('#c_password'), $('#password').val());

    if ($('.error-message').length > 0) {
        hasErrors = true;
        event.preventDefault();
        console.log('got error');
        swal("Oops...", "Please ensure that all information is entered accurately.", "error");
      }
      if (!hasErrors) {
        event.preventDefault();
        console.log('Insert action');
        insertData();
      }
    });
    function validateDateOfBirth(input) {
            var value = input.val();
            var validMonthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            if (value === "") {
                displayError(input, 'Required field');
            }
            else {
        // 从字符串中提取月份
        var month = value.split(" ")[1];
        
        // 检查提取的月份是否在有效的月份列表中
        if (!validMonthNames.includes(month)) {
            displayError(input, 'Invalid month');
        } else {
            removeError(input);
        }
    }
    }
    function validateAddress(input) {
      var value = input.val();
      if(value ==="")
      {
        displayError(input, 'Required field');
      }
      else {
        removeError(input);
      }
    }
    function validatePostCode(input) {
      var value = input.val();
      if(value ==="")
      {
        displayError(input, 'Required field');
      }
      else if (/^[a-zA-Z]+$/.test(value.replace(/\s/g, '')))  {
        displayError(input, 'Only number are allowed.');
      } else {
        removeError(input);
      }
    }
    // Function to validate general input (first_name, last_name)
    function validateEmail(input) {
        var email = input.val(); // Get the entered email value

    // Use a regular expression for email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {
        // If the email is empty, show an error
        displayError(input, 'Email is required.');
    } else if (!emailRegex.test(email)) {
        // If the email does not match the regex pattern, show an error
        displayError(input, 'Invalid email format.');
    } else {
        validateEmailExistence(email).then(function (response) {
            if (response === 'exists') {
                displayError(input, 'Email already exists.');
            } else {
                removeError(input);
            }
        }).catch(function (error) {
            console.error('Error checking email existence:', error);
        });
    }
    }
    function validatePassword(input) {
    var value = input.val();
    if (value === "") {
        displayPasswordError(input, 'Required field');
    } else if (value.length < 8 || value.length > 16) {
        displayPasswordError(input, 'Password must be between 8 and 16 characters long');
    } else if (!/^(?=.*\d)(?=.*[a-zA-Z])/.test(value)) {
        displayPasswordError(input, 'Password must contain at least one number and one letter');
    } else {
        removePasswordError(input);
    }
}

function validateConfirmPassword(input, password) {
    var value = input.val();
    if (value === "") {
        displayPasswordError(input, 'Required field');
    } else if (value !== password) {
        displayPasswordError(input, 'Passwords do not match');
    } else {
        removePasswordError(input);
    }
}
      function validateEmailExistence(email) {
          return new Promise(function (resolve, reject) {
              $.ajax({
                  type: "POST",
                  url: "check_email.php",
                  data: {
                      action: "check_email",
                      email: email
                  },
                  success: function (response) {
                      resolve(response);
                  },
                  error: function (error) {
                      reject(error);
                  }
              });
          });
      }

    function validateInput(input) {
      var value = input.val();
      if(value ==="")
      {
        displayError(input, 'Required field');
      }
      else if (!/^[a-zA-Z]+$/.test(value.replace(/\s/g, '')))  {
        displayError(input, 'Only alphabetic characters are allowed.');
      } else {
        removeError(input);
      }
    }

    // Function to validate phone number input
    function validatePhoneNumber(input) {
      var phoneNumber = input.val();

      if (phoneNumber === "") {
        displayError(input, 'Required field');
      }
      else if (!/^\d+$/.test(phoneNumber)){
        displayError(input, 'Phone number cannot contain letters.');
      }
      else if(phoneNumber.length >10 || phoneNumber.length < 9)
      {
        displayError(input, 'Phone number does not match the length');
      } 
      else {
        removeError(input);
      }
    }
    function insertData() {
      var formData = new FormData($('#add_admin_form')[0]);
      var admin_picture = document.getElementById('profile_picture');
      var picture = admin_picture.files[0];
      if (!picture) {
        swal("Oops...", "Profile picture is required.", "error");
        return;
      }
      formData.append('action', "insert_admin");
      formData.append('picture', picture);
        for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
        }
        swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I am sure!"],
        dangerMode: true,
    	}).then((result) => {
        if (result) {
        $.ajax({
            type: "POST",
            url: "insert_admin.php", // Change this to the actual script handling the insertion
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
              swal("Success", response, "success").then(function() {
					    location.replace("admin.php");
				});
            },
            error: function (error) {
                console.error("Error:", error);
            }
        });
      }
      });
    }
    // Function to display error message
    function displayError(input, message) {
      // Remove existing error message
      removeError(input);
      
      // Add new error message
      var errorMessageDiv = $('<div class="error-message" style="color: red;position:absolute;font-size: 12px;"></div>').text(message);
      input.closest('.form-group').append(errorMessageDiv);
    }

    // Function to remove error message
    function removeError(input) {
      input.next('.error-message').remove();
    }
    function displayPasswordError(input, message) {
      // Remove existing error message
      removePasswordError(input);
      
      // Add new error message
      var errorMessageDiv = $('<div class="error-message" style="color: red;position:absolute;font-size: 12px;margin-top:45px;"></div>').text(message);
      input.closest('.input-group').append(errorMessageDiv);
    }

    // Function to remove error message
    function removePasswordError(input) {
      input.closest('.input-group').find('.error-message').remove();
    }
  });
</script>