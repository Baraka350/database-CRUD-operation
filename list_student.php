<?php
// list_student.php
require_once 'config.php';

// Fetch all students
$result = $mysqli->query("SELECT student_id, names, gender, dob, class, email FROM students ORDER BY student_id DESC");
if (!$result) {
    die("DB query error: (" . $mysqli->errno . ") " . $mysqli->error);
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Student List</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family: Arial, sans-serif; padding:20px}
    table{border-collapse:collapse; width:100%}
    th, td{border:1px solid #ddd; padding:8px}
    th{background:#f2f2f2}
    a.btn{display:inline-block; padding:6px 10px; text-decoration:none; border:1px solid #333; margin-right:6px}
  </style>
</head>
<body>
  <h1>Students</h1>

  <?php if (isset($_GET['msg']) && $_GET['msg'] === 'added'): ?>
    <p style="color:green">Student added successfully.</p>
  <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
    <p style="color:green">Student updated successfully.</p>
  <?php endif; ?>

  <p><a href="add_student.php" class="btn">Add new student</a></p>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Names</th>
        <th>Gender</th>
        <th>DOB</th>
        <th>Class</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['student_id']); ?></td>
          <td><?php echo htmlspecialchars($row['names']); ?></td>
          <td><?php echo htmlspecialchars($row['gender']); ?></td>
          <td><?php echo htmlspecialchars($row['dob']); ?></td>
          <td><?php echo htmlspecialchars($row['class']); ?></td>
          <td><?php echo htmlspecialchars($row['email']); ?></td>
          <td>
            <a href="edit_student.php?id=<?php echo urlencode($row['student_id']); ?>" class="btn">Edit</a>
            <a href="delete_student.php?id=<?php echo urlencode($row['student_id']); ?>"
               class="btn"
               onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
