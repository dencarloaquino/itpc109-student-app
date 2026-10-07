<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $student_number = $_POST['student_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $course = $_POST['course'];

    $stmt = $pdo->prepare(
        "UPDATE students
         SET student_number = ?, first_name = ?, last_name = ?, course = ?
         WHERE id = ?"
    );

    $stmt->execute([
        $student_number,
        $first_name,
        $last_name,
        $course,
        $id
    ]);
}

header('Location: index.php');
exit;