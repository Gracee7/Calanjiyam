<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $requesttype = isset($_POST['requesttype']) ? $_POST['requesttype'] : '';

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'customers');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO customers (firstName, lastName, address, email, requesttype) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        // Corrected bind_param types: s for string, i for integer
        $stmt->bind_param("sssss", $firstName, $lastName, $address, $email, $requesttype);

        $execval = $stmt->execute();
        if ($execval) {
            echo "Registration successfully...";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "No form data submitted.";
}
?>
