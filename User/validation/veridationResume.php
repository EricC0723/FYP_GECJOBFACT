<script type="text/javascript">
  $(document).ready(function () {
    var hasResumeErrors = false;

    // Input event listener for job_title input
    $('#file_resume').on('input', function () {
      validatResume($(this));
    });
    
    $('#resume_submitbtn').on('click', function (event) {
      validatResume($('#file_resume'));
  });
    function validatResume(input) {
      var uploadedFile = $("#file_resume")[0].files[0];
      var max = 2 * 1024 * 1024;//2 mb maxsize
      var value = input.val();
      if (value === "") {
        displayError(input, 'Required field');
      }
      else if (uploadedFile.size > max) {
          // console.log("gg ma");
          displayError(input, "File size must be less than 2MB.");
      }
      else if (!isPDF(uploadedFile.name)) {
        displayError(input, "File must be a PDF.");
      }
      else{
        removeError(input);
      }
    }
    // Function to display error message
    function displayError(input, message) {
      removeError(input);
      var errorMessageDiv = $('<div class="error-message" style="color: red;position:absolute;font-size: 12px;margin-top:10px;"></div>').text(message);
      input.closest('.form-group').append(errorMessageDiv);
    }

    // Function to remove error message
    function removeError(input) {
      input.closest('.form-group').find('.error-message').remove();
    }
    function isPDF(fileName) {
    var extension = fileName.split('.').pop().toLowerCase();
    return extension === 'pdf';
  }
    });
</script>