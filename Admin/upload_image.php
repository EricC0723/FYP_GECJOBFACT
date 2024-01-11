<?php 
include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_POST["AddSubmitbtn"])) {
    $name = mysqli_real_escape_string($connect, $_POST["txtItemName"]);

    $imagefile=$_FILES["txtItemImage"]['tmp_name'];
    $fileName=$_FILES["txtItemImage"]["name"];
    $fileExtension=pathinfo($fileName,PATHINFO_EXTENSION);
    $current_path=dirname(__FILE__);
    $target_path=$current_path.'/../user/images/item/';
    $path=$target_path.$fileName;
    move_uploaded_file($imagefile,$path);
    $image=$fileName;
    $image=mysqli_real_escape_string($connect,$image);

    $result = mysqli_query($connect, "SELECT * FROM item WHERE item_name='$name'");
    
    if (mysqli_num_rows($result) == 0) {
        $sql = mysqli_query($connect, "INSERT INTO item(item_image) VALUES ('$image')");
        
        if ($sql) {
            echo '<script>alert("Added successfully");</script>';
            exit;
        }  
    } else {
        echo '<script>alert("Adding failed.");</script>';
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
        <form class="addItemfrm" method="post" action="" enctype="multipart/form-data">
	<input type="text" id="inputbox" name="txtItemName" placeholder="Item Name">
        <input type="file" id="inputbox" name="txtItemImage" placeholder="Item Image">
        <input type="submit" id="savebtn" value="Add New Item" name="AddSubmitbtn">
	</form>
</body>
</html>

