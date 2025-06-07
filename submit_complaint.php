<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$host = "localhost";
$user = "root";
$password = "";
$dbname = "product_db";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$product = htmlspecialchars($_POST['product']);
$issue = htmlspecialchars($_POST['issue']);

$sql = "INSERT INTO complaints (name, email, product, issue) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $product, $issue);

if ($stmt->execute()) {
    echo "<h2 style='color:green;text-align:center;'>✅ Complaint submitted successfully!</h2>";
} else {
    echo "<h2 style='color:red;text-align:center;'>❌ Error: " . $stmt->error . "</h2>";
}

$stmt->close();
$conn->close();
?>
