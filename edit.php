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

// Fetch the student data from the database
$id = $_GET['id'];
$sql = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Student</title>
</head>
<body>
  <h1>Edit Student</h1>

  <form method="post" action="index.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
    <br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>">
    <br>
    <label>Phone:</label>
    <input type="tel" name="phone" value="<?php echo $row['phone']; ?>">
    <br>
    <input type="submit" name="update" value="Update">
  </form>
</body>
</html>
