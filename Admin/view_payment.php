<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
if(isset($_GET['payment_id']))
{
    $payment_id = mysqli_real_escape_string($connect, $_GET['payment_id']);

    $query = "SELECT * FROM payment WHERE PaymentID='$payment_id'";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $payment = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Payment Fetch Successfully by id',
            'data' => $payment
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Payment Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}
?>