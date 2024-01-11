<script>
        $(document).on('click', '.viewUserBtn', function () {
        console.log("view click");
        var user_id = $(this).data('userid');
        console.log("User ID : "+user_id);
        $.ajax({
            type: "GET",
            url: "view_user.php?user_id=" + user_id,
            success: function (response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if(res.status == 404) {

                    alert(res.message);
                }else if(res.status == 200){
                    var formattedDate = moment(res.data.RegistrationDate).format('DD-MM-YYYY HH:mm:ss');
                    $('#FirstName').text(res.data.FirstName);
                    $('#LastName').text(res.data.LastName);
                    $('#Phone').text(res.data.Phone);
                    $('#Email').text(res.data.Email);
                    $('#Password').text(res.data.Password);
                    $('#UserStatus').text(res.data.UserStatus);
                    $('#Location').text(res.data.Location);
                    $('#RegistrationDate').text(formattedDate);

                    $('#view-user-modal').modal('show');
                }
            }
        });
        });
    </script>
    <script>
        $(document).on('click', '.editUserBtn', function () {
        console.log("view click");
        var user_id = $(this).data('userid');
        console.log("User ID : "+user_id);
        $.ajax({
            type: "GET",
            url: "view_user.php?user_id=" + user_id,
            success: function (response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if(res.status == 404) {

                    alert(res.message);
                }else if(res.status == 200){
                    var formattedDate = moment(res.data.RegistrationDate).format('DD-MM-YYYY HH:mm:ss');
                    $('#FirstName').text(res.data.FirstName);
                    $('#LastName').text(res.data.LastName);
                    $('#Phone').text(res.data.Phone);
                    $('#Email').text(res.data.Email);
                    $('#Password').text(res.data.Password);
                    $('#UserStatus').text(res.data.UserStatus);
                    $('#Location').text(res.data.Location);
                    $('#RegistrationDate').text(formattedDate);

                    $('#view-user-modal').modal('show');
                }
            }
        });
        });
    </script>