<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(document).ready(function () { 
    var hasErrors = false;
    console.log("setting in progress");
    $('#new_password').on('input', function () {
        validateNewPassword($(this));
    });
    $('#cf_password').on('input', function () {
        validateConfirmPassword($(this), $('#new_password').val());
    });
    $('#current_password').on('input', function () {
        validatePassword($(this));
    });
    $('#password_submitbtns').on('click', function (event) {
    var hasErrors = false;
    validateNewPassword($('#new_password'));
    validatePassword($('#current_password'));
    validateConfirmPassword($('#cf_password'), $('#new_password').val());

    if ($('.error-message').length > 0) {
        hasErrors = true;
        event.preventDefault();
        console.log('got error');
        swal("Oops...", "Please ensure that all information is entered accurately.", "error");
      }
      if (!hasErrors) {
        event.preventDefault();
        console.log('updated action');
        update_password();
      }
    });
    function validateConfirmPassword(input, password) {
            var value = input.val();
            removeError(input);
            if (value === "") {
                displayPasswordError(input, 'Required field');
            } else if (value !== password) {
                displayPasswordError(input, 'Password do not match');
            } else {
                removePasswordError(input);
            }
      }
    // Function to validate new password
    function validateNewPassword(input) {
            var value = input.val();
            removeError(input);

            if (value === "") {
                displayPasswordError(input, 'Required field');
            }
            else if (value.length < 8 || value.length > 16) {
                displayPasswordError(input, 'Password must be between 8 and 16 characters long');
            }
            else if (!/^(?=.*\d)(?=.*[a-z]).*$/.test(value)) {
                displayPasswordError(input, 'Password must contain at least one number and one letter');
            }
            else if (!/^(?=.*[A-Z]).*$/.test(value)) {
                displayPasswordError(input, 'Password must contain at least one uppercase letter');
            }
            else if (!/^(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]).*$/.test(value)) {
                displayPasswordError(input, 'Password must contain at least one special character');
            } 
            else {
                validateNewPasswordMatch(input, value);
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
function validateNewPasswordMatch(input, newPassword){
    $.ajax({
        type: "POST",
        url: "check_password.php",
        data: {
            action: "check_new_password",
            password: newPassword
        },
        success: function (response) {
            if (response === 'match') {
                displayPasswordError(input, 'New password must be different from the current one.');
            } else {
                removePasswordError(input);
            }
        },
        error: function (error) {
            console.error('Error checking new password:', error);
        }
    });
}
    function validatePasswordMatch(password) {
        // console.log("password checking")
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

    function update_password() {
        var data = {
            new_password: $("#new_password").val(),
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
            url: "update_password.php",
            data: data,
            beforeSend: function () {
            showLoading();
            },
            success: function (response) {
                hideLoading();
              swal("Success", response, "success").then(function() {
					location.replace("logout.php");
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