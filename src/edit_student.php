<?php
require 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    exit('Student not found.');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h1>Edit Student</h1>

<form action="update_student.php" method="POST">

    <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']) ?>">

    <label>Student Number:</label>
    <input type="text" name="student_number"
           value="<?= htmlspecialchars($student['student_number']) ?>" required>

    <label>First Name:</label>
    <input type="text" name="first_name"
           value="<?= htmlspecialchars($student['first_name']) ?>" required>

    <label>Last Name:</label>
    <input type="text" name="last_name"
           value="<?= htmlspecialchars($student['last_name']) ?>" required>

    <label>Course:</label>
    <input type="text" name="course"
           value="<?= htmlspecialchars($student['course']) ?>" required>

    <button type="submit">Update Student</button>

</form>

<a href="index.php">Back to Student List</a>

</body>
</html>