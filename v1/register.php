<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "face_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$faceData = $data['faceData'];

$sql = "INSERT INTO users (face_data) VALUES ('$faceData')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Registration successful']);
} else {
    echo json_encode(['message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
