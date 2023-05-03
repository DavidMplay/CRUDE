<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Handle the delete operation
$id = $_GET['id'];
$sql = "DELETE FROM students WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
  echo "Student deleted successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli
