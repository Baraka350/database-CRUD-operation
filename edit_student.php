<?php
// edit_student.php
require_once 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID");
}

$id = (int)$_GET['id'];

// Fetch student
$stmt = $mysqli->prepare("SELECT student_id, names, gender, dob, class, email FROM students WHERE student_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    die("Student not found");
}
$student = $res->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Student</title>

  <style>
   body {
    font-family: Arial, sans-serif;
    background: #f4f4f4;
    margin: 0;
    padding: 40px;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    background: #fff;
    padding: 25px 30px;
    width: 100%;
    max-width: 450px;
    margin: 0 auto;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
}

label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #333;
}

input[type="text"],
input[type="email"],
input[type="date"],
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #aaa;
    box-sizing: border-box;
    font-size: 14px;
}

input[type="radio"] {
    margin-right: 5px;
}

button {
    width: 100%;
    background: #007bff;
    color: white;
    padding: 12px;
    margin-top: 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 6px;
    transition: 0.3s;
}

button:hover {
    background: #0056b3;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}

p {
    text-align: center;
    margin-top: 20px;
}

    
  </style>
</head>
<body>
  <h1>Edit Student</h1>
  <form action="update_student.php" method="post">
    <!-- include id as hidden -->
    <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>"><br>

    <label for="names">Full name</label>
    <input type="text" id="names" name="names" value="<?php echo htmlspecialchars($student['names']); ?>" required><br>

    <label>Gender</label>
    <label><input type="radio" name="gender" value="male" <?php echo $student['gender'] === 'male' ? 'checked' : ''; ?>> Male</label>
    <label><input type="radio" name="gender" value="female" <?php echo $student['gender'] === 'female' ? 'checked' : ''; ?>> Female</label><br>

    <label for="dob">Date of birth</label>
    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($student['dob']); ?>" required><br>

    <label for="class">Class</label>
    <select id="class" name="class" required> <br>
      <option value="">-- Choose class --</option> <br>
      <?php
      $classes = ['S1','S2','S3','S4','S5','S6'];
      foreach ($classes as $c) {
          $sel = ($student['class'] === $c) ? 'selected' : '';
          echo "<option value=\"" . htmlspecialchars($c) . "\" $sel>" . htmlspecialchars($c) . "</option>";
      }
      ?>
    </select> <br>

    <label for="email">Email (optional)</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>"><br>

    <button type="submit">Update Student</button>
  </form>

  <p><a href="list_student.php">Back to list</a></p>
</body>
</html>
