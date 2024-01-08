<script>
  $(document).ready(function () {
    var hasErrors = false;
    // Input event listener for first_name input
    $('#first_name').on('input', function () {
      validateInput($(this));
    });

    // Input event listener for last_name input
    $('#last_name').on('input', function () {
      validateInput($(this));
    });

    // Input event listener for phone input
    $('#phone').on('input', function () {
      validatePhoneNumber($(this));
    });

    // Function to validate general input (first_name, last_name)
    function validateInput(input) {
      // Get the entered value
      var value = input.val();

      // Display error message if value contains non-alphabetic characters
      if(value ==="")
      {
        displayError(input, 'Required field');
        hasErrors = true;
        checkErrors();
      }
      else if (!/^[a-zA-Z]+$/.test(value.replace(/\s/g, '')))  {
        displayError(input, 'Only alphabetic characters are allowed.');
        hasErrors = true;
        checkErrors();
      } else {
        removeError(input);
        hasErrors = false;
        checkErrors();
      }
    }
z
    // Function to validate phone number input
    function validatePhoneNumber(input) {
      // Get the entered phone number
      var phoneNumber = input.val();

      // Display error message if phone number contains letters
      if (!/^\d+$/.test(phoneNumber)) {
        displayError(input, 'Phone number cannot contain letters.');
         hasErrors = true;
         checkErrors();
      }
      else if(phoneNumber.length >10 || phoneNumber.length < 9)
      {
        displayError(input, 'Phone number does not match the length');
        hasErrors = true;
        checkErrors();
      } 
      else {
        removeError(input);
        hasErrors = false;
        checkErrors();
      }
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
    function checkErrors() {
    // Check if any error exists in any input
    if ($('#first_name').next('.error-message').length ||
        $('#last_name').next('.error-message').length ||
        $('#phone').next('.error-message').length) {
      $('#profile_submitbtn').prop('disabled', true);
    } else {
      $('#profile_submitbtn').prop('disabled', false);
    }
  }
  });
</script>