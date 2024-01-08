<script>
function editCareer() {
  var career_id = $(event.currentTarget).data('career-id');
    console.log('Career ID:', career_id);
$.ajax({
    type: "GET",
    url: "editProfile.php?career_id=" + career_id,
    success: function (response) {
      console.log(response);
        var res = jQuery.parseJSON(response);
        if(res.status == 404) {

            alert(res.message);
        }else if(res.status == 200){

            $('#edit_career_id').val(res.data.CareerID);
            $('#edit_job_title').val(res.data.JobTitle);
            $('#edit_company_name').val(res.data.CompanyName);
            $('#edit_start_date').val(res.data.StartDate);
            if (res.data.StillInRole == 1) {
                    $('#edit_end_date').val('');
                } else {
                    $('#edit_end_date').val(res.data.EndDate);
                }
            $('#edit_customCheck1').prop('checked', res.data.StillInRole == 1);
            $('#edit_description').val(res.data.Description);

            $('#modal-career-edit').modal('show');
        }
    }
});
}
</script>
<script>
  function hideOverlay() {
    var elements = document.getElementsByClassName('user-info-dropdown');
  for (var i = 0; i < elements.length; i++) {
    elements[i].style.display = (elements[i].style.display === 'flex' || elements[i].style.display === '') ? 'none' : 'flex';
  }
  }
   </script>
<script>
//Edit Education
function editEducation() {
  var education_id = $(event.currentTarget).data('education-id');
    console.log('Career ID:', education_id);
$.ajax({
    type: "GET",
    url: "editProfile.php?education_id=" + education_id,
    success: function (response) {
      console.log(response);
        var res = jQuery.parseJSON(response);
        if(res.status == 404) {
            alert(res.message);
        }else if(res.status == 200){
            $('#edit_education_id').val(res.data.EducationID);
            $('#edit_institution').val(res.data.Institution);
            $('#edit_qualification').val(res.data.Course_or_Qualification);
            $('#edit_education_description').val(res.data.Course_Highlight);
            $('#edit_customControlAutosizing').prop('checked', res.data.Qualification_complete == 1);

            $('#modal-education-edit').modal('show');
        }
    }
});
}
</script>
<script>
    //Delete Career
    function deleteCareer() {
    var career_id = $(event.currentTarget).data('career-id');
    var data = {
        action: "delete_career_model",
        career_id: career_id,
    };
    console.log("delete");

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this career history",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I am sure!"],
        dangerMode: true,
    }).then((result) => {
        if (result) {
            $.ajax({
                type: "POST",
                url: "editProfile.php?career_id=" + career_id,
                data: data,
                async: true,
                success: function (response) {
                    console.log(response);
                    swal("Success", response, "success").then(function () {
                      $('#career-section').load(location.href + " #career-section > *");
                    });
                },
            });
        }
    });
}
function deleteResume() {
    var data = {
        action: "delete_resume_model",
    };
    console.log("delete");

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this career history",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I am sure!"],
        dangerMode: true,
    }).then((result) => {
        if (result) {
            $.ajax({
                type: "POST",
                url: "editProfile.php",
                data: data,
                async: true,
                success: function (response) {
                    console.log(response);
                    swal("Success", response, "success").then(function () {
                      $('#resume-section').load(location.href + " #resume-section > *");
                    });
                },
            });
        }
    });
}
  </script>
    <script>
      //Delete Education
    function deleteEducation() {
    var data = {
        action: "delete_education_model",
    };
    console.log("delete");

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover your education history",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I am sure!"],
        dangerMode: true,
    }).then((result) => {
        if (result) {
            $.ajax({
                type: "POST",
                url: "editProfile.php",
                data: data,
                async: true,
                success: function (response) {
                    console.log(response);
                    swal("Success", response, "success").then(function () {
                      $('#education-section').load(location.href + " #education-section > *");
                    });
                },
            });
        }
    });
}
  </script>