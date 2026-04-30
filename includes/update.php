<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['update_id'];
    $surname = $_POST['new_surname'];
    $name = $_POST['new_name'];
    $middlename = $_POST['new_middlename'];
    $address = $_POST['new_address'];
    $contact = $_POST['new_contact'];

    $sql = "UPDATE students SET surname=?, name=?, middlename=?, address=?, contact_number=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $surname, $name, $middlename, $address, $contact, $id);

    if ($stmt->execute()) {
        header("Location: ../index.php?status=success");
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
