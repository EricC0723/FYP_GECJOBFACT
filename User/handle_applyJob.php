<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
function submitApplication(questionIDs){
    event.preventDefault();
    $(document).ready(function(){
      // console.log(questionIDs);
      // console.log(questionIDs.length);
        var data = new FormData();
        var resumeInput = document.getElementById('file_resume_select');
        var coverInput = document.getElementById('file_cover_select');
        //Handle resume and resume radio
        var resumeOption = $("input[name='resumeRadio']:checked").val();
        data.append('resumeOption', resumeOption);
        if(resumeOption == "selectResume")
        {
          var resume = resumeInput.files[0];
          data.append('resume', resume);
        }
        //handle cover letter and cover radio
        var coverOption = $("input[name='coverRadio']:checked").val();
        data.append('coverOption', coverOption);
        if(coverOption == "selectCover")
        {
          var cover = coverInput.files[0];
          data.append('cover', cover);
        }
        
        var questionAnswers = [];
        
        for (var i = 0; i < questionIDs.length; i++) {
            var questionID = "q" + questionIDs[i];
            var selectedQuestionOption = $("input[name='"+questionID+ "']:checked").val();
            
            var questionAnswerObject = {
                "questionID": questionIDs[i],
                "option": selectedQuestionOption
            };

            questionAnswers.push(questionAnswerObject);
        }
        var namedQuestionAnswers = {
        "Question_answer": questionAnswers
        };
        var QuestionAnswersJSON = JSON.stringify(namedQuestionAnswers);
        console.log(QuestionAnswersJSON);
        data.append('questionAnswers', QuestionAnswersJSON);
        for (let pair of data.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
        
        if (pair[0] === 'resume' || pair[0] === 'cover') {
          console.log(pair[0] + ' File Name: ' + pair[1].name);
          console.log(pair[0] + ' File Size: ' + pair[1].size);
          console.log(pair[0] + ' File Type: ' + pair[1].type);
          // 其他文件属性可以根据需要添加
        }
      }
    
    $.ajax({
    url: 'insert_applyJob.php',
    type: 'post',
    data: data,
    contentType: false,
    processData: false,
    async: true,
    beforeSend: function () {
      showLoading();
    },
    success:function(response){
      hideLoading();
      if(response === "failed")
      {
        swal("Oops...", "You have already applied for this job and cannot apply again.", "error");
      }
      else{
        swal("Success", "Application submited successfully", "success").then(function () {
            location.replace("user_applyjob.php");
          });
      }
    }
  });
});
  }
  function showLoading() {
    $('#loading').show();
}

function hideLoading() {
    $('#loading').hide();
}
  </script>