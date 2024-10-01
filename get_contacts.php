<?php
// Database connection details (same as in add_contact.php)
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

// Fetch contacts with their addresses
$sql = "SELECT c.contact_name, c.last_name, c.phone, 
               a.street, a.house_number, a.suburb, a.city, a.state, a.country, a.postal_code 
        FROM contact c
        JOIN address a ON c.address_id = a.id";

$result = $conn->query($sql);

$contacts = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $contacts[] = $row;
    }
}

// Return contacts as JSON
echo json_encode($contacts);

$conn->close();
?>