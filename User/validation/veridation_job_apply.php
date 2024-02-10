
<script>
function validateStep(step) {
    // Placeholder for validation logic based on the step
    if(step == 1)
    { console.log("step 1");
      var validateResume = false;
      var validateCover = false;
      var selectedResumeOption = $("input[name='resumeRadio']:checked").val();
      var selectedCoverOption = $("input[name='coverRadio']:checked").val();
      var max = 2 * 1024 * 1024;//2 mb maxsize
        //resume
        if (selectedResumeOption === undefined) {
          showRadioMessage($("input[name='resumeRadio'][value='noneResume']"), "Please make a selection");
          validateResume = false;
        }
        else if(selectedResumeOption === "selectResume")
        {
          var uploadedFile = $("#file_resume_select")[0].files[0];

            if (!uploadedFile) {
                // console.log("gg ma");
                showResumeErrorMessage($("#file_resume_select"), "Please choose a file.");
                validateResume = false;
            }
            else if (uploadedFile.size > max) {
                // console.log("gg ma");
                showResumeErrorMessage($("#file_resume_select"), "File size must be less than 2MB.");
                validateResume = false;
            }
            else if (!isPDF(uploadedFile.name)) {
                showResumeErrorMessage($("#file_resume_select"), "File must be a PDF.");
                validateResume = false;
            }
            else{
              removeErrorMessage($("#file_resume_select"));
              removeRadioErrorMessage($("input[name='resumeRadio'][value='noneResume']"));
              validateResume = true;
            }
        }
        else{
          validateResume = true;
          removeRadioErrorMessage($("input[name='resumeRadio'][value='noneResume']"));
        }
        //cover letter
        if(selectedCoverOption === undefined)
        { 
          showRadioMessage($("input[name='coverRadio'][value='noneCover']"), "Please make a selection");
          validateCover = false;
        }
        else if(selectedCoverOption === "selectCover")
        {
          var uploadedCover = $("#file_cover_select")[0].files[0];

            if (!uploadedCover) {
                // console.log("gg ma");
                showCoverErrorMessage($("#file_cover_select"), "Please choose a file.");
                validateCover = false;
            }
            else if(uploadedCover.size > max)
            {
              showCoverErrorMessage($("#file_cover_select"), "File size must be less than 2MB.");
                validateCover = false;
            }
            else if (!isPDF(uploadedCover.name)) {
                showCoverErrorMessage($("#file_cover_select"), "File must be a PDF.");
                validateCover = false;
            }
            else{
              removeCoverErrorMessage($("#file_cover_select"));
              removeRadioErrorMessage($("input[name='coverRadio'][value='noneCover']"));
              validateCover = true;
            }
        }
        else{
          validateCover = true;
          removeRadioErrorMessage($("input[name='coverRadio'][value='noneCover']"));
        }
        //return
        if(validateResume && validateCover)
        {
          return true;
        }
        else{
          return false;
        }
    }
}
//step 2 validation
function validateStepTwo(step,questionIDs) {
  console.log("step 2");
    // console.log(questionIDs); // 输出整个数组
    // console.log(questionIDs.length); // 输出数组的长度
    var allQuestionsValid = [];

    for (var i = 0; i < questionIDs.length; i++) {
        var questionID = "q" + questionIDs[i];
        var selectedQuestionOption = $("input[name='"+questionID+ "']:checked").val();
        console.log(selectedQuestionOption);
        var errorDivID = "error_" + questionID;
        var errorDiv = document.getElementById(errorDivID);
        if(selectedQuestionOption=== undefined)
        {
          errorDiv.innerHTML = "Please make a selection";
          console.log("Question ID: " + questionID);
          allQuestionsValid.push(false);
        }
        else{
          errorDiv.innerHTML = "";
          allQuestionsValid.push(true);
        }
    }
    var isAllValid = allQuestionsValid.every(function (isValid) {
        return isValid;
    });

    return isAllValid;
}

function showRadioMessage(input, message) {
    // Check if an error message already exists, remove it
    removeRadioErrorMessage(input);

    // Create and append the error message
    var errorMessageDiv = $('<div class="error-message" style="color: red;font-size: 16px;position:absolute;margin-top:-5px;"></div>').text(message);
    input.closest('.custom-control').append(errorMessageDiv);
}
function showOptionMessage(input, message) {
    // Check if an error message already exists, remove it
    removeRadioErrorMessage(input);

    // Create and append the error message
    var errorMessageDiv = $('<div class="error-message" style="color: red;font-size: 16px;position:absolute;margin-top:-5px;"></div>').text(message);
    input.closest('error_message').append(errorMessageDiv);
}
function showResumeErrorMessage(input, message) {
  // console.log("error message");
    // Check if an error message already exists, remove it
    removeErrorMessage(input);
    removeRadioErrorMessage($("input[name='resumeRadio'][value='noneResume']"));
    // Create and append the error message
    var errorMessageDiv = $('<div class="error-message" style="color: red;font-size: 16px;margin-top:-30px;"></div>').text(message);
    input.closest('.custom-file').append(errorMessageDiv);
}
function showCoverErrorMessage(input, message) {
  // console.log("error message");
    // Check if an error message already exists, remove it
    removeErrorMessage(input);
    removeRadioErrorMessage($("input[name='coverRadio'][value='noneCover']"));
    // Create and append the error message
    var errorMessageDiv = $('<div class="error-message" style="color: red;font-size: 16px;margin-top:-30px;"></div>').text(message);
    input.closest('.custom-file').append(errorMessageDiv);
}
// 隐藏错误信息的函数
function removeRadioErrorMessage(input) {
    console.log("Removing radio error message");
    var errorElement = input.closest('.custom-control').find('.error-message');
    console.log("Error element:", errorElement);
    errorElement.remove();
}

function removeErrorMessage(input) {
    console.log("Removing error message");
    var errorElement = input.closest('.custom-file').find('.error-message');
    console.log("Error element:", errorElement);
    errorElement.remove();
}

function removeCoverErrorMessage(input) {
    console.log("Removing cover error message");
    var errorElement = input.closest('.custom-file').find('.error-message');
    console.log("Error element:", errorElement);
    errorElement.remove();
}
function isPDF(fileName) {
    var extension = fileName.split('.').pop().toLowerCase();
    return extension === 'pdf';
}
</script>