<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? 0;

  if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM reg_form WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      echo "Deleted";
    } else {
      http_response_code(500);
      echo "Failed to delete user.";
    }
  } else {
    http_response_code(400);
    echo "Invalid ID.";
  }
}
?>
