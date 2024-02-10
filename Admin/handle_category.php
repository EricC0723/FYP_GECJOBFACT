<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST["action"] == "deleteSub")
    {   
        $categoryid = $_POST['categoryid'];

        $sql = "UPDATE sub_category 
            SET SubCategory_isDeleted = 1
            WHERE Sub_Category_ID  = '$categoryid'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo "Deleted successfully";
        }
    }
    else if($_POST["action"] == "deleteMain")
    {   
        $categoryid = $_POST['categoryid'];

        $sql = "UPDATE main_category 
            SET MainCategory_isDeleted = 1
            WHERE Main_Category_ID  = '$categoryid'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo "Deleted successfully";
        }
    }
}
?>