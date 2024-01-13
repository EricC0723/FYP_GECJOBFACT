<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="validation/veridationcareer.php"></script>
<script type="text/javascript">
  function resetForm() {
    // Reset the form by setting its 'reset' method
    document.getElementById('model-career').reset();
}
  function submitData(action){
    event.preventDefault();
    $(document).ready(function(){
      //summary
      if(action != "resume_model")
      {
        if(action == "summary_model")
        {
          var data = {
          action: action,
          summary: $("#summary").val(),
        };
        }
        //profile
        else if(action == "profile_model")
        {
          var data = {
          action: action,
          first_name: $("#first_name").val(),
          last_name: $("#last_name").val(),
          location: $("#location").val(),
          phone: $("#phone").val(),
        };
        }
        else if(action == "career_model")
        {
          var data = {
            action: action,
            job_title: $("#job_title").val(),
            company_name: $("#company_name").val(),
            start_date: $("#start_date").val(),
            end_date: $("#end_date").val(),
            still_in_role: $("#customCheck1").prop('checked') ? 1 : 0,
            description: $("textarea[name='description']").val(),
        };
        }
        else if(action == "edit_career_model")
        {
          var data = {
            action: action,
            career_id: $("#edit_career_id").val(),
            job_title: $("#edit_job_title").val(),
            company_name: $("#edit_company_name").val(),
            start_date: $("#edit_start_date").val(),
            end_date: $("#edit_end_date").val(),
            still_in_role: $("#edit_customCheck1").prop('checked') ? 1 : 0,
            description: $("textarea[name='edit_description']").val(),
        };
        }
        else if(action == "education_model")
        {
          var data = {
            action: action,
            institution: $("#institution").val(),
            qualification: $("#qualification").val(),
            quali_is_complete: $("#customControlAutosizing").prop('checked') ? 1 : 0,
            description: $("textarea[name='education_description']").val(),
        };
        }
        else if(action == "edit_education_model")
        {
          var data = {
            action: action,
            education_id: $("#edit_education_id").val(),
            institution: $("#edit_institution").val(),
            qualification: $("#edit_qualification").val(),
            quali_is_complete: $("#edit_customControlAutosizing").prop('checked') ? 1 : 0,
            description: $("textarea[name='edit_education_description']").val(),
        };
        }
        else if(action == "resume_model")
        { var data = new FormData();
          var fileInput = document.getElementById('file_resume');
          var file = fileInput.files[0];

          data.append('action', action);
          data.append('file_resume', file);

          console.log('Action:', action);
          console.log('File:', file);
        }
        $.ajax({
          url: 'editProfile.php',
          type: 'post',
          data: data,
          // contentType: false,
          // processData: false,
          async: true, 
          success:function(response){
            if(response === "failed")
            {
              swal("Oops...", "Please ensure that all information is entered accurately.", "error");
            }
            else if(response === "time_format_error")
            {
              swal("Oops...", "The end date cannot be earlier than the start date", "error");
            }
            else{
              console.log("Ajax request successful!");
              swal("Success", response, "success").then(function() {
                
                $('#profile-section').load(location.href + " #profile-section > *");
                $('#summary-section').load(location.href + " #summary-section > *");
                $('#career-section').load(location.href + " #career-section > *");
                $('#education-section').load(location.href + " #education-section > *");
                $('#resume-section').load(location.href + " #resume-section > *");

                console.log("Before hiding modal");
                resetForm();
                $('#modal-career [data-dismiss="modal"]').click();
                $('#modal-education [data-dismiss="modal"]').click();
                $('#modal-career-edit [data-dismiss="modal"]').click();
                $('#modal-education-edit [data-dismiss="modal"]').click();
                $('#modal-resume [data-dismiss="modal"]').click();
                
                console.log("After hiding modal");
          });
            }
            
          }
        });
    }
    else{
        var data = new FormData();
        var fileInput = document.getElementById('file_resume');
        var file = fileInput.files[0];

        data.append('action', action);
        data.append('file_resume', file);

        console.log('Action:', action);
        console.log('File:', file);
      
      $.ajax({
        url: 'editProfile.php',
        type: 'post',
        data: data,
        contentType: false,
        processData: false,
        async: true, 
        success:function(response){
          if(response === "size_extra")
          {
            swal("Oops...", "File size exceeds the limit of 2MB", "error");
          }
          else if(response === "empty")
          {
            swal("Oops...", "File is empty", "error");
          }
          else{
            console.log("Ajax request successful!");
            swal("Success", response, "success").then(function() {
            // 在这里添加跳转到 profile.php 的代码
            $('#profile-section').load(location.href + " #profile-section > *");
            $('#summary-section').load(location.href + " #summary-section > *");
            $('#career-section').load(location.href + " #career-section > *");
            $('#education-section').load(location.href + " #education-section > *");
            $('#resume-section').load(location.href + " #resume-section > *");
            $('#modal-resume [data-dismiss="modal"]').click();
        });
          }
          
        }
      });
    }
    });
  }
</script>