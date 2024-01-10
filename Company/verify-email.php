<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_GET['data'])) {
    // Decode the data from the URL
    $decoded = base64_decode($_GET['data']);

    // Split the data into the hash and the email
    list($hash, $email) = explode(':', $decoded, 2);

    // Recreate the hash
    $secretKey = "your-secret-key";
    $expectedHash = hash_hmac('sha256', $email, $secretKey);

    // Query the database for the user with this email
    $query = mysqli_query($connect, "SELECT * FROM companies WHERE CompanyEmail = '$email'");

    if (mysqli_num_rows($query) > 0) {
        // Verify the hash
        if ($hash === $expectedHash) {
            // The hashes match, so set the user's account as verified
            mysqli_query($connect, "UPDATE companies SET CompanyStatus = 'Active' WHERE CompanyEmail = '$email'");

            echo 'Your account has been verified! You can now log in.';
        } else {
            echo 'Invalid verification link. Please check your email or request a new one.';
        }
    } else {
        echo 'No account found with this email address.';
    }
} else {
    echo 'No data received for verification.';
}

// Close the database connection
mysqli_close($connect);
?>