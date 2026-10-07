<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_number = $_POST['student_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $course = $_POST['course'];

    $stmt = $pdo->prepare(
        "INSERT INTO students (student_number, first_name, last_name, course)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->execute([
        $student_number,
        $first_name,
        $last_name,
        $course
    ]);
}

header('Location: index.php');
exit;