<?php
// delete_student.php
require_once 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID");
}

$id = (int)$_GET['id'];


$stmt = $mysqli->prepare("DELETE FROM students WHERE student_id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: list_student.php?msg=deleted");
    exit;
} else {
    echo "Delete failed: (" . $stmt->errno . ") " . $stmt->error;
}
