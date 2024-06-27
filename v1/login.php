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

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$found = false;

while ($row = $result->fetch_assoc()) {
    $savedFaceData = $row['face_data'];
    
    // Hash comparison for face data
    if (similar_text($savedFaceData, $faceData) > 90) { // Tweak the threshold as necessary
        $found = true;
        break;
    }
}

if ($found) {
    echo json_encode(['message' => 'Login successful']);
} else {
    echo json_encode(['message' => 'Face not recognized']);
}

$conn->close();
?>
