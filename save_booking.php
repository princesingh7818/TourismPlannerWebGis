<?php

$conn = new mysqli("localhost", "root", "", "nepal_tourism");

if ($conn->connect_error) {
    die("Connection Failed");
}

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$destination = $data['destination'];
$travelers = $data['travelers'];
$date = $data['date'];

$stmt = $conn->prepare("INSERT INTO bookings (customer_name, destination, travelers, travel_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $name, $destination, $travelers, $date);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}

$conn->close();

?>