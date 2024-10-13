<?php
include('config.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $examiner_id = $_POST['examiner_id'];

    // Delete examiner query
    $query = $conn->prepare("DELETE FROM Examiners WHERE examiner_id = ?");
    $query->bind_param("i", $examiner_id);

    if ($query->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $query->error]);
    }

    $query->close();
}

$conn->close();
?>
