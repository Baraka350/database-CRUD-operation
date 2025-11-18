<?php
// add_student.php
// Simple page that shows a form to add a new student
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Add Student</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family: Arial, sans-serif; padding:20px}
    form{max-width:500px}
    label{display:block; margin-top:10px}
    input, select{width:100%; padding:8px; box-sizing:border-box}
    .radio-inline{display:inline-block; margin-right:10px}
    .btn{margin-top:12px; padding:10px 16px}
  </style>
</head>
<body>
  <h1>Add Student</h1>
  <!-- The form posts to insert_student.php -->
  <form action="insert_student.php" method="post">
    <label for="names">Full name</label>
    <input type="text" id="names" name="names" required>

    <label>Gender</label>
    <label class="radio-inline"><input type="radio" name="gender" value="male" required> Male</label>
    <label class="radio-inline"><input type="radio" name="gender" value="female" required> Female</label>

    <label for="dob">Date of birth</label>
    <input type="date" id="dob" name="dob" required>

    <label for="class">Class</label>
    <select id="class" name="class" required>
      <option value="">-- Choose class --</option>
      <option value="S1">S1</option>
      <option value="S2">S2</option>
      <option value="S3">S3</option>
      <option value="S4">S4</option>
      <option value="S5">S5</option>
      <option value="S6">S6</option>
    </select>

    <label for="email">Email (optional)</label>
    <input type="email" id="email" name="email" placeholder="name@example.com">

    <button type="submit" class="btn">Add Student</button>
  </form>

  <p><a href="list_student.php">View students</a></p>
</body>
</html>
