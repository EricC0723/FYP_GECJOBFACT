<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($_POST["action"] == "updateCompany")
        {   $company_id = $_POST['company_id'];
            $companyName = $_POST['company_name'];
            $contactPerson = $_POST['contact_person'];
            $status = $_POST['status'];

            $sql = "UPDATE companies 
                SET CompanyName = '$companyName', ContactPerson = '$contactPerson', CompanyStatus = '$status'
                WHERE CompanyID = '$company_id'";
            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Updated successfully';
            } else {
                echo 'Updated failed';
            }
        }
    }
if(isset($_GET['company_id']))
{
    $company_id = mysqli_real_escape_string($connect, $_GET['company_id']);

    $query = "SELECT * FROM companies WHERE CompanyID='$company_id'";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $company_id = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'company Fetch Successfully by id',
            'data' => $company_id
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'company Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}
?>