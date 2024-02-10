<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($_POST["action"] == "insert_new_main")
        {
            $new_main= $_POST['new_main'];
            
            $sql = "INSERT INTO main_category (Main_Category_Name)
            VALUES ('$new_main')";
            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Inserted successfully';
            }
            }
        
        else if($_POST["action"] == "insert_new_sub")
        {
            $main= $_POST['main'];
            $sub= $_POST['sub'];
            
            $sql = "INSERT INTO sub_category (Sub_Category_Name,Main_Category_ID)
            VALUES ('$sub','$main')";
            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Inserted successfully';
            }
        }
    }