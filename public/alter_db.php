<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbstudents";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "ALTER TABLE students MODIFY contact_number VARCHAR(11) DEFAULT NULL;";
if ($conn->query($sql) === TRUE) {
  echo "Table altered successfully.";
} else {
  echo "Error altering table: " . $conn->error;
}
$conn->close();
?>
