<script>
  $(document).ready(function () {
    var hasSummaryErrors = false;
    // Input event listener for first_name input
    $('#summary').on('input', function () {
      validateSummary($(this));
    });

    // Function to validate general input (first_name, last_name)
    function validateSummary(input) {
      // Get the entered value
      var value = input.val();

      // Display error message if value contains non-alphabetic characters
      if(value.length >= 700)
      {
        displaySummaryError(input, '700 characters or less (' + value.length+")");
        hasSummaryErrors = true;
        checkSummaryErrors();
      }else {
        removeSummaryError(input);
        hasSummaryErrors = false;
        checkSummaryErrors();
      }
    }

    // Function to display error message
    function displaySummaryError(input, message) {
      // Remove existing error message
      removeSummaryError(input);

      // Add new error message
      var errorMessageDiv = $('<div class="error-message" style="color: red;possition:absolute;font-size: 12px;"></div>').text(message);
      input.closest('.form-group').append(errorMessageDiv);
    }

    // Function to remove error message
    function removeSummaryError(input) {
      input.next('.error-message').remove();
    }
    function checkSummaryErrors(){
    // Check if any error exists in any input
    if ($('#summary').next('.error-message').length) {
      $('#summary_submitbtn').prop('disabled', true);
    } else {
      $('#summary_submitbtn').prop('disabled', false);
    }
  }
  });
</script>