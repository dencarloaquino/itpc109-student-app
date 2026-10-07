<?php
require 'db.php';

$students = $pdo->query("SELECT * FROM students ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
$totalStudents = count($students);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Management System</title>

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #eff6ff;
            --success: #16a34a;
            --danger: #dc2626;
            --text: #172033;
            --muted: #64748b;
            --border: #e2e8f0;
            --background: #f5f7fb;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(15, 23, 42, 0.07);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
                         Roboto, Helvetica, Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.5;
        }

        /* =========================
           NAVIGATION
        ========================== */

        .navbar {
            height: 70px;
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .nav-inner {
            width: min(1180px, calc(100% - 40px));
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text);
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 17px;
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.25);
        }

        .brand-text strong {
            display: block;
            font-size: 15px;
            letter-spacing: -0.2px;
        }

        .brand-text span {
            display: block;
            font-size: 11px;
            color: var(--muted);
            margin-top: -2px;
        }

        .nav-status {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 13px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
            box-shadow: 0 0 0 4px #dcfce7;
        }

        /* =========================
           PAGE
        ========================== */

        .page {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
            padding: 42px 0 60px;
        }

        /* =========================
           HERO
        ========================== */

        .hero {
            background: linear-gradient(135deg, #1d4ed8 0%, #4338ca 100%);
            border-radius: 22px;
            padding: 38px 42px;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 28px;
            box-shadow: 0 18px 40px rgba(37, 99, 235, 0.18);
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 50%;
            right: -80px;
            top: -100px;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 50%;
            right: 80px;
            bottom: -120px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 720px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 11px;
            background: rgba(255,255,255,0.13);
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .hero h1 {
            font-size: clamp(27px, 4vw, 38px);
            line-height: 1.12;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 15px;
            color: rgba(255,255,255,0.82);
            max-width: 600px;
        }

        /* =========================
           STAT CARDS
        ========================== */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 21px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            border-radius: 13px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .stat-info span {
            display: block;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .stat-info strong {
            display: block;
            font-size: 23px;
            letter-spacing: -0.5px;
        }

        .online {
            color: var(--success);
        }

        /* =========================
           CONTENT GRID
        ========================== */

        .content-grid {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 24px;
            align-items: start;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
        }

        .card-header {
            padding: 23px 24px 17px;
            border-bottom: 1px solid #edf1f5;
        }

        .card-header h2 {
            font-size: 17px;
            letter-spacing: -0.25px;
            margin-bottom: 4px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 12px;
        }

        /* =========================
           FORM
        ========================== */

        .form-body {
            padding: 22px 24px 24px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 7px;
        }

        .input {
            width: 100%;
            height: 43px;
            padding: 0 13px;
            border: 1px solid #d7dee8;
            border-radius: 9px;
            background: #fbfcfe;
            color: var(--text);
            font-size: 13px;
            outline: none;
            transition: all 0.2s ease;
        }

        .input::placeholder {
            color: #a1acba;
        }

        .input:hover {
            border-color: #bdc8d6;
        }

        .input:focus {
            background: white;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.11);
        }

        .submit-button {
            width: 100%;
            height: 44px;
            border: none;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--primary), #4f46e5);
            color: white;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 7px 16px rgba(37, 99, 235, 0.22);
            transition: all 0.2s ease;
        }

        .submit-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.28);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        /* =========================
           TABLE
        ========================== */

        .records-card {
            min-width: 0;
        }

        .records-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .record-count {
            background: var(--primary-light);
            color: var(--primary-dark);
            border-radius: 999px;
            padding: 5px 10px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .table-container {
            overflow-x: auto;
            padding: 0 7px 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            padding: 14px 17px;
            text-align: left;
            color: #64748b;
            background: #f8fafc;
            border-bottom: 1px solid var(--border);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        td {
            padding: 16px 17px;
            border-bottom: 1px solid #eef2f6;
            font-size: 13px;
            color: #334155;
            vertical-align: middle;
        }

        tbody tr {
            transition: background 0.15s ease;
        }

        tbody tr:hover {
            background: #f8fbff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .id-cell {
            color: #94a3b8;
            font-weight: 600;
        }

        .student-number {
            color: var(--primary);
            font-weight: 700;
        }

        .name-cell {
            color: var(--text);
            font-weight: 600;
        }

        .course-cell {
            color: var(--muted);
        }

        .actions {
            white-space: nowrap;
        }

        .action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 30px;
            padding: 0 10px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
            margin-right: 5px;
            transition: all 0.15s ease;
        }

        .edit {
            color: #1d4ed8;
            background: #eff6ff;
        }

        .edit:hover {
            background: #dbeafe;
        }

        .delete {
            color: #dc2626;
            background: #fef2f2;
        }

        .delete:hover {
            background: #fee2e2;
        }

        .empty {
            text-align: center;
            padding: 55px 20px;
            color: var(--muted);
        }

        .empty-icon {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .empty strong {
            display: block;
            color: var(--text);
            margin-bottom: 3px;
        }

        /* =========================
           FOOTER
        ========================== */

        footer {
            text-align: center;
            padding-top: 30px;
            color: #94a3b8;
            font-size: 11px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 950px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 700px) {
            .nav-inner,
            .page {
                width: min(100% - 28px, 1180px);
            }

            .navbar {
                height: 62px;
            }

            .nav-status {
                display: none;
            }

            .page {
                padding-top: 20px;
            }

            .hero {
                padding: 28px 24px;
                border-radius: 17px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .card {
                border-radius: 15px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="nav-inner">

        <a href="index.php" class="brand">
            <div class="brand-icon">SI</div>

            <div class="brand-text">
                <strong>Student Information</strong>
                <span>Management System</span>
            </div>
        </a>

        <div class="nav-status">
            <span class="status-dot"></span>
            System Online
        </div>

    </div>
</nav>

<main class="page">

    <!-- HERO -->
    <section class="hero">

        <div class="hero-content">

            <div class="hero-label">
                ● INFORMATION TECHNOLOGY
            </div>

            <h1>Student Information Management</h1>

            <p>
                Manage student records in one simple, organized,
                and efficient dashboard.
            </p>

        </div>

    </section>

    <!-- STATISTICS -->
    <section class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon">👥</div>

            <div class="stat-info">
                <span>Total Students</span>
                <strong><?= $totalStudents ?></strong>
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-icon">✓</div>

            <div class="stat-info">
                <span>System Status</span>
                <strong class="online">Online</strong>
            </div>

        </div>

        <div class="stat-card">

            <div class="stat-icon">▣</div>

            <div class="stat-info">
                <span>Database</span>
                <strong>MySQL</strong>
            </div>

        </div>

    </section>

    <!-- MAIN CONTENT -->
    <section class="content-grid">

        <!-- ADD STUDENT -->
        <div class="card">

            <div class="card-header">

                <h2>Add New Student</h2>

                <p>
                    Enter the student's information.
                </p>

            </div>

            <div class="form-body">

                <form action="save_student.php" method="POST">

                    <div class="form-group">

                        <label for="student_number">
                            Student Number
                        </label>

                        <input
                            class="input"
                            type="text"
                            id="student_number"
                            name="student_number"
                            placeholder="2026-0003"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="first_name">
                            First Name
                        </label>

                        <input
                            class="input"
                            type="text"
                            id="first_name"
                            name="first_name"
                            placeholder="Juan"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="last_name">
                            Last Name
                        </label>

                        <input
                            class="input"
                            type="text"
                            id="last_name"
                            name="last_name"
                            placeholder="Dela Cruz"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label for="course">
                            Course
                        </label>

                        <input
                            class="input"
                            type="text"
                            id="course"
                            name="course"
                            placeholder="BS Information Technology"
                            required
                        >

                    </div>

                    <button type="submit" class="submit-button">
                        + Add Student
                    </button>

                </form>

            </div>

        </div>

        <!-- STUDENT RECORDS -->
        <div class="card records-card">

            <div class="card-header">

                <div class="records-header">

                    <div>
                        <h2>Student Records</h2>

                        <p>
                            View and manage registered students.
                        </p>
                    </div>

                    <span class="record-count">
                        <?= $totalStudents ?> Records
                    </span>

                </div>

            </div>

            <?php if ($totalStudents > 0): ?>

            <div class="table-container">

                <table>

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Student Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php foreach ($students as $student): ?>

                        <tr>

                            <td class="id-cell">
                                #<?= htmlspecialchars($student['id']) ?>
                            </td>

                            <td class="student-number">
                                <?= htmlspecialchars($student['student_number']) ?>
                            </td>

                            <td class="name-cell">
                                <?= htmlspecialchars($student['first_name']) ?>
                                <?= htmlspecialchars($student['last_name']) ?>
                            </td>

                            <td class="course-cell">
                                <?= htmlspecialchars($student['course']) ?>
                            </td>

                            <td class="actions">

                                <a
                                    href="edit_student.php?id=<?= $student['id'] ?>"
                                    class="action edit"
                                >
                                    Edit
                                </a>

                                <a
                                    href="delete_student.php?id=<?= $student['id'] ?>"
                                    class="action delete"
                                    onclick="return confirm('Are you sure you want to delete this student?');"
                                >
                                    Delete
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <?php else: ?>

                <div class="empty">

                    <div class="empty-icon">📋</div>

                    <strong>No student records yet</strong>

                    Add your first student using the form.

                </div>

            <?php endif; ?>

        </div>

    </section>

    <footer>
        ITPC 109 • Student Information Management System
    </footer>

</main>

</body>
</html>