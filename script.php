<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
  function submitData(action){
    event.preventDefault();
    $(document).ready(function(){
      //summary
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
      $.ajax({
        url: 'editProfile.php',
        type: 'post',
        data: data,
        async: true, 
        success:function(response){
          console.log("Ajax request successful!");
          swal("Success", response, "success");
        }
      });
    });
  }
</script>