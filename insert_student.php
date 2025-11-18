<?php
// insert_student.php
require_once 'config.php';

// Simple server-side validation & sanitation
$names  = isset($_POST['names']) ? trim($_POST['names']) : '';
$gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
$dob    = isset($_POST['dob']) ? trim($_POST['dob']) : '';
$class  = isset($_POST['class']) ? trim($_POST['class']) : '';
$email  = isset($_POST['email']) ? trim($_POST['email']) : null;

// Basic validation
$errors = [];
if ($names === '') {
    $errors[] = "Name is required.";
}
if ($gender !== 'male' && $gender !== 'female') {
    $errors[] = "Gender is required.";
}
if ($dob === '') {
    $errors[] = "Date of birth is required.";
}
if ($class === '') {
    $errors[] = "Class is required.";
}
if ($email !== null && $email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email is not a valid format.";
}

// If there are validation errors, show them and stop
if (!empty($errors)) {
    echo "<h3>There were errors:</h3><ul>";
    foreach ($errors as $e) {
        echo "<li>" . htmlspecialchars($e) . "</li>";
    }
    echo "</ul><p><a href='add_student.php'>Go back</a></p>";
    exit;
}

// Use prepared statements to avoid SQL injection
$stmt = $mysqli->prepare("INSERT INTO students (names, gender, dob, class, email) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
}

// Bind parameters: s = string, so "sssss" for 5 strings
$stmt->bind_param("sssss", $names, $gender, $dob, $class, $email);

// Execute
if ($stmt->execute()) {
    // success - redirect to list or show message
    header("Location: list_student.php?msg=added");
    exit;
} else {
    echo "Insert failed: (" . $stmt->errno . ") " . $stmt->error;
}
