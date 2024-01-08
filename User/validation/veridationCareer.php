<script type="text/javascript">
  $(document).ready(function () {
    var hasCareerErrors = false;

    // Input event listener for job_title input
    $('#job_title').on('input', function () {
      validateTitleCompanyInput($(this));
    });

    // Input event listener for company_name input
    $('#company_name').on('input', function () {
        validateTitleCompanyInput($(this));
    });

    // Input event listener for start_date input
    $('#start_date').on('input', function () {
      validateDateRange($(this));
    });

    // Input event listener for end_date input
    $('#end_date').on('input', function () {
        validateDateRange($(this));
    });
    $('#description').on('input', function () {
      validateDescription($(this));
    });
    // Input event listener for checkbox
    $('#customCheck1').on('change', function () {
        updateEndDateRequirement();
    });
    $('#career_submitbtn').on('click', function (event) {
    validateTitleCompanyInput($('#job_title'));
    validateTitleCompanyInput($('#company_name'));
    validateDateRange($('#start_date'));
      
  });
  function validateDescription(input) {
      // Get the entered value
      var value = input.val();

      // Display error message if value contains non-alphabetic characters
      if(value.length >= 700)
      {
        displayError(input, '700 characters or less (' + value.length+")");
        hasCareerErrors = true;
        checkErrors();
      }else {
        removeError(input);
        hasCareerErrors = false;
        checkErrors();
      }
    }
    function validateTitleCompanyInput(input) {
      console.log("validatecareer");
      var value = input.val();
      if (value === "") {
        displayError(input, 'Required field');
        hasCareerErrors = true;
        checkErrors();
      }
      else if(value.length > 100)
      {
        displayError(input, '100 characters or less (' + value.length+")");
        hasCareerErrors = true;
        checkErrors();
      } 
      else {
        removeError(input);
        hasCareerErrors = false;
        checkErrors();
      }
    }
    function validateDateRange(input) {
    var startDate = new Date($('#start_date').val());
    var endDate = new Date($('#end_date').val());
    var value = input.val();
    console.log("validateDateRange called with input:", input);
    if (value === "") {
        displayError(input, 'Required field');
        hasCareerErrors = true;
        checkErrors();
    } else if (!isNaN(startDate) && !isNaN(endDate) && endDate < startDate) {
        displayError(input, 'The end date cannot be earlier than the start date');
        hasCareerErrors = true;
        checkErrors();
    } else {
        removeError(input);
        hasCareerErrors = false;
        checkErrors();
    }
}
    // Function to display error message
    function displayError(input, message) {
      removeError(input);
      var errorMessageDiv = $('<div class="error-message" style="color: red;position:absolute;font-size: 12px;"></div>').text(message);
      input.closest('.form-group').append(errorMessageDiv);
    }

    // Function to remove error message
    function removeError(input) {
      input.closest('.form-group').find('.error-message').remove();
    }

    // Function to update the required attribute of end_date
    function updateEndDateRequirement() {
      var isStillInRole = $("#customCheck1").is(":checked");
      $('#end_date').prop('required', !isStillInRole);
      removeError($('#end_date'));

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
      if ($('#job_title').next('.error-message').length ||
        $('#company_name').next('.error-message').length ||
        $('#start_date').next('.error-message').length) {
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


    // Initial setup when the document is ready
    updateEndDateRequirement();
  });
</script>