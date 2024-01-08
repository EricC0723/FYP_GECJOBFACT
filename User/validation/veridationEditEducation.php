<script type="text/javascript">
  $(document).ready(function () {
    var hasEducationrErrors = false;

    // Input event listener for job_title input
    $('#edit_institution').on('input', function () {
      validatEeducation($(this));
    });

    // Input event listener for company_name input
    $('#edit_qualification').on('input', function () {
        validatEeducation($(this));
    });
    $('#edit_education_description').on('input', function () {
      validateDescription($(this));
    });
    $('#edit_education_submitbtn').on('click', function (event) {
    validatEeducation($('#edit_institution'));
    validatEeducation($('#edit_qualification'));
    validateDescription($('#edit_education_description'));
  });
  function validateDescription(input) {
      // Get the entered value
      var value = input.val();

      // Display error message if value contains non-alphabetic characters
      if(value.length >= 700)
      {
        displayEditError(input, '700 characters or less (' + value.length+")");
        hasEducationrErrors = true;
        checkErrors();
      }else {
        removeError(input);
        hasEducationrErrors = false;
        checkErrors();
      }
    }
    function validatEeducation(input) {
      console.log("validateeducation");
      var value = input.val();
      if (value === "") {
        displayEditError(input, 'Required field');
        hasEducationrErrors = true;
        checkErrors();
      }
      else if(value.length > 100)
      {
        displayEditError(input, '100 characters or less (' + value.length+")");
        hasEducationrErrors = true;
        checkErrors();
      } 
      else {
        removeError(input);
        hasEducationrErrors = false;
        checkErrors();
      }
    }
    // Function to display error message
    function displayEditError(input, message) {
      removeError(input);
      var errorMessageDiv = $('<div class="error-message" style="color: red;position:absolute;font-size: 12px;"></div>').text(message);
      input.closest('.form-group').append(errorMessageDiv);
    }

    // Function to remove error message
    function removeError(input) {
      input.closest('.form-group').find('.error-message').remove();
    }

    // Function to check for errors
    function checkErrors() {
      if ($('#edit_job_title').next('.error-message').length ||
        $('#edit_company_name').next('.error-message').length ||
        $('#edit_start_date').next('.error-message').length) {
      $('#profile_submitbtn').prop('disabled', true);
    } else {
      $('#profile_submitbtn').prop('disabled', false);
    }
    }

  });
</script>