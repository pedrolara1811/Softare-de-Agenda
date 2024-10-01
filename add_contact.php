<?php
// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "directory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the AJAX request (assuming you're sending data as JSON)
$data = json_decode(file_get_contents('php://input'), true);

// Extract contact and address data
$contactName = $data['contactName'];
$lastName = $data['lastName'];
$phone = $data['phone'];
$lada = $data['lada'];

$street = $data['street'];
$houseNumber = $data['houseNumber'];
$suburb = $data['suburb'];
$city = $data['city'];
$state = $data['state'];
$country = $data['country'];
$postalCode = $data['postalCode'];

// Insert address first to get the address_id
$sql_address = "INSERT INTO address (street, house_number, suburb, city, state, country, postal_code) 
                VALUES ('$street', $houseNumber, '$suburb', '$city', '$state', '$country', $postalCode)";

if ($conn->query($sql_address) === TRUE) {
    $address_id = $conn->insert_id; // Get the last inserted ID

    // Now insert the contact with the address_id
    $sql_contact = "INSERT INTO contact (contact_name, last_name, phone, lada, address_id) 
                    VALUES ('$contactName', '$lastName', $phone, $lada, $address_id)";

    if ($conn->query($sql_contact) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Contact added successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error adding contact: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Error adding address: " . $conn->error));
}

$conn->close();
?>