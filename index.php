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

// Handle the create operation
if (isset($_POST['create'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $sql = "INSERT INTO students (name, email, phone) VALUES ('$name', '$email', '$phone')";

  if (mysqli_query($conn, $sql)) {
    echo "Student created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Handle the update operation
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $sql = "UPDATE students SET name='$name', email='$email', phone='$phone' WHERE id='$id'";

  if (mysqli_query($conn, $sql)) {
    echo "Student updated successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Handle the delete operation
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];

  $sql = "DELETE FROM students WHERE id='$id'";

  if (mysqli_query($conn, $sql)) {
    echo "Student deleted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Fetch all the student data from the database
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Students</title>
</head>
<body>
  <h1>Students</h1>

  <form method="post" action="index.php">
    <h2>Add New Student</h2>
    <label>Name:</label>
    <input type="text" name="name" required>
    <br>
    <label>Email:</label>
    <input type="email" name="email">
    <br>
    <label>Phone:</label>
    <input type="tel" name="phone">
    <br>
    <input type="submit" name="create" value="Create">
  </form>

  <h2>Existing Students</h2>

  <table border="1">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Created At</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
        <td>
          <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
          <a href="index.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
</td>
</tr>
<?php } ?>

  </table>
</body>
</html>