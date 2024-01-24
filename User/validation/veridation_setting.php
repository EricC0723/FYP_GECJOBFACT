<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(document).ready(function () { 
    var hasErrors = false;
    console.log("setting in progress");
    // Input event listener for first_name input
    $('#new_email').on('input', function () {
        validateEmail($(this));
    });
    $('#c_new_email').on('input', function () {
        validateConfirmEmail($(this), $('#new_email').val());
    });
    $('#cf_ps').on('input', function () {
        validatePassword($(this));
    });
    $('#email_submitbtns').on('click', function (event) {
    var hasErrors = false;
    validateEmail($('#new_email'));
    validatePassword($('#cf_ps'));
    validateConfirmEmail($('#c_new_email'), $('#new_email').val());

    if ($('.error-message').length > 0) {
        hasErrors = true;
        event.preventDefault();
        console.log('got error');
        swal("Oops...", "Please ensure that all information is entered accurately.", "error");
      }
      if (!hasErrors) {
        event.preventDefault();
        console.log('updated action');
        update_email();
      }
    });
    function validateConfirmEmail(input, email) {
            var value = input.val();
            removeError(input);
            if (value === "") {
                displayError(input, 'Required field');
            } else if (value !== email) {
                displayError(input, 'Email do not match');
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
            console.log(response);
            if (response === 'exists') {
                displayError(input, 'Email already exists.');
            }
            else if(response === 'same')
            {
                displayError(input, 'New email must be different from the current one.');
            } else {
                removeError(input);
            }
        }).catch(function (error) {
            console.error('Error checking email existence:', error);
        });
    }
    }
    function validatePassword(input) {
    var password = input.val();

    if (password === "") {
        displayPasswordError(input, 'Password is required.');
    } else {
        validatePasswordMatch(password).then(function (response) {
            console.log(response);
            if (response === 'not_match') {
                displayPasswordError(input, 'Password incorrect.');
            } else {
                removePasswordError(input);
            }
        }).catch(function (error) {
            console.error('Error :', error);
        });
    }
}
    function validatePasswordMatch(password) {
        console.log("password checking")
    return new Promise(function (resolve, reject) {
        $.ajax({
            type: "POST",
            url: "check_password.php",
            data: {
                action: "check_password",
                password: password
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
      function validateEmailExistence(email) {
          return new Promise(function (resolve, reject) {
              $.ajax({
                  type: "POST",
                  url: "check_emailSetting.php",
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

    function update_email() {
        var data = {
            email: $("#new_email").val(),
        };
        swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I am sure!"],
        dangerMode: true,
    	}).then((result) => {
        if (result) {
        $.ajax({
            type: "POST",
            url: "send_changeEmail.php",
            data: data,
            beforeSend: function () {
            showLoading();
            },
            success: function (response) {
                hideLoading();
              swal("Success", response, "success").then(function() {
					location.replace("index.php");
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
      var errorMessageDiv = $('<div class="error-message" style="color: red;position:absolute;font-size: 12px;margin-top:50px;"></div>').text(message);
      input.closest('.input-group').append(errorMessageDiv);
    }

    // Function to remove error message
    function removePasswordError(input) {
      input.closest('.input-group').find('.error-message').remove();
    }
    function showLoading() {
    $('#loading').show();
}

function hideLoading() {
    $('#loading').hide();
}
  });
</script>