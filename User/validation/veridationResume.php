<script type="text/javascript">
  $(document).ready(function () {
    var hasResumeErrors = false;

    // Input event listener for job_title input
    $('#file_resume').on('input', function () {
      validatEeducation($(this));
    });
    });
    $('#resume_submitbtn').on('click', function (event) {
    validatEeducation($('#edit_institution'));
    validatEeducation($('#edit_qualification'));
    validateDescription($('#edit_education_description'));
  });
    function validatResume(input) {
      console.log("validateeducation");
      var value = input.val();
      if (value === "") {
        displayEditError(input, 'Required field');
        hasEducationrErrors = true;
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