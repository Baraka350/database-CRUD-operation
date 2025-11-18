<?php
// update_student.php
require_once 'config.php';

// Get POST values
$student_id = isset($_POST['student_id']) ? (int)$_POST['student_id'] : 0;
$names  = isset($_POST['names']) ? trim($_POST['names']) : '';
$gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
$dob    = isset($_POST['dob']) ? trim($_POST['dob']) : '';
$class  = isset($_POST['class']) ? trim($_POST['class']) : '';
$email  = isset($_POST['email']) ? trim($_POST['email']) : null;

// Basic validation (same as insert)
$errors = [];
if ($student_id <= 0) { $errors[] = "Invalid student ID."; }
if ($names === '') { $errors[] = "Name is required."; }
if ($gender !== 'male' && $gender !== 'female') { $errors[] = "Gender is required."; }
if ($dob === '') { $errors[] = "Date of birth is required."; }
if ($class === '') { $errors[] = "Class is required."; }
if ($email !== null && $email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email is not a valid format.";
}

if (!empty($errors)) {
    echo "<h3>There were errors:</h3><ul>";
    foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>";
    echo "</ul><p><a href='edit_student.php?id=" . urlencode($student_id) . "'>Go back</a></p>";
    exit;
}

// Update DB using prepared statement
$stmt = $mysqli->prepare("UPDATE students SET names = ?, gender = ?, dob = ?, class = ?, email = ? WHERE student_id = ?");
if (!$stmt) {
    die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
}
$stmt->bind_param("sssssi", $names, $gender, $dob, $class, $email, $student_id);

if ($stmt->execute()) {
    header("Location: list_student.php?msg=updated");
    exit;
} else {
    echo "Update failed: (" . $stmt->errno . ") " . $stmt->error;
}
