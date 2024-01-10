<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

// Get the encoded string from the URL
$encoded = $_GET['data'];

// Decode the string
$decoded = base64_decode($encoded);

// Split the string into the token and the email
list($token, $email) = explode(':', $decoded, 2);

// Prepare an SQL statement to get the user with the given email
$sql = mysqli_query($connect, "SELECT * FROM companies WHERE CompanyEmail = '$email'");

if (mysqli_num_rows($sql) > 0) {
    // The email exists in the database

    // Generate the token again from the email and password
    $row = mysqli_fetch_assoc($sql);
    $password = $row['CompanyPassword'];
    $checkToken = hash('sha256', $email . $password);

    if ($token === $checkToken) {
        // The token is valid, so mark the email as verified
        $sql = mysqli_query($connect, "UPDATE companies SET CompanyStatus = 'Active' WHERE CompanyEmail = '$email'");
        echo "Your email has been verified!";
    } else {
        // The token is not valid
        echo "Invalid verification link";
    }
} else {
    // The email does not exist in the database
    echo "Invalid verification link";
}

// Close the database connection
mysqli_close($connect);
?>