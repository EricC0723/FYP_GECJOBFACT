<script type="text/javascript">
  $(document).ready(function () {
    var hasCareerErrors = false;


    // Input event listener for job_title input
    $('#edit_job_title').on('input', function () {
      validateEditTitleCompanyInput($(this));
    });

    // Input event listener for company_name input
    $('#edit_company_name').on('input', function () {
        validateEditTitleCompanyInput($(this));
    });

    // Input event listener for start_date input
    $('#edit_start_date').on('input', function () {
      validateEditDateRange($(this));
    });

    // Input event listener for end_date input
    $('#edit_end_date').on('input', function () {
        validateEditDateRange($(this));
    });
    $('#edit_description').on('input', function () {
      validateDescription($(this));
    });
    $('#edit_customCheck1').on('change', function () {
        updateEditEndDateRequirement();
        validateEditDateRange($('#edit_start_date'));
        validateEditDateRange($('#edit_end_date'));
    });
    $('#edit_career_submitbtn').on('click', function (event) {
    validateEditTitleCompanyInput($('#edit_job_title'));
    validateEditTitleCompanyInput($('#edit_company_name'));
    validateEditDateRange($('#edit_start_date'));
    validateEditStillInRole_EndDate($('#edit_end_date'));
    validateEditDateRange($('#edit_end_date'));
  });

  function validateEditStillInRole_EndDate(input) {
    var startDate = new Date($('#edit_start_date').val());
    var endDate = new Date($('#edit_end_date').val());
    var isStillInRole = $("#edit_customCheck1").is(":checked");
    var value = input.val();
    if(isNaN(endDate) && !isStillInRole){
        displayEditError(input, 'Required field');
        hasCareerErrors = true;
        checkErrors();
    } else {
        removeError(input);
        hasCareerErrors = false;
        checkErrors();
    }
}
  function validateDescription(input) {
      // Get the entered value
      var value = input.val();
      // Display error message if value contains non-alphabetic characters
      if(value.length >= 700)
      {
        displayEditError(input, '700 characters or less (' + value.length+")");
        hasCareerErrors = true;
        checkErrors();
      }else {
        removeError(input);
        hasCareerErrors = false;
        checkErrors();
      }
    }
    function validateEditTitleCompanyInput(input) {
      console.log("validatecareer");
      var value = input.val();
      if (value === "") {
        displayEditError(input, 'Required field');
        hasCareerErrors = true;
        checkErrors();
      }
      else if(value.length > 100)
      {
        displayEditError(input, '100 characters or less (' + value.length+")");
        hasCareerErrors = true;
        checkErrors();
      } 
      else {
        removeError(input);
        hasCareerErrors = false;
        checkErrors();
      }
    }
    function validateEditDateRange(input) {
    var startDate = new Date($('#edit_start_date').val());
    var endDate = new Date($('#edit_end_date').val());
    var isStillInRole = $("#edit_customCheck1").is(":checked");
    var value = input.val();

    console.log("validateEditDateRange called with input:", input);

    if (!isStillInRole && value === "" && isNaN(endDate)) {
        displayEditError(input, 'Either end date or "Still in role" must be provided');
        hasCareerErrors = true;
        checkErrors();
    } else if (!isStillInRole && !isNaN(startDate) && !isNaN(endDate) && endDate < startDate) {
        displayEditError(input, 'The end date cannot be earlier than the start date');
        hasCareerErrors = true;
        checkErrors();
    } else {
        removeError(input);
        hasCareerErrors = false;
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

    // Function to update the required attribute of end_date
    function updateEditEndDateRequirement() {
      var isStillInRole = $("#edit_customCheck1").is(":checked");
      $('#edit_end_date').prop('required', !isStillInRole);
      removeError($('#edit_end_date'));

      // Combine with your previous logic to show/hide end_date
      if (isStillInRole) {
        $('[name="end_date"]').hide();
      } else {
        $('[name="end_date"]').show();
      }

      checkErrors();
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

    // Function to check if any input field is empty
    function isAnyFieldEmpty() {
      var isEmpty = false;
      $('input[type="text"]').each(function() {
        if ($(this).val() === "") {
          isEmpty = true;
          return false; // Exit the loop if any field is empty
        }
      });
      return isEmpty;
    }

    updateEditEndDateRequirement();
  });
</script>