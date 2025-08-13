<?php
require 'database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("No student ID provided.");
}

$db = new Database();

$stmt =  $db->connect()->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if (!$student) {
    die("Student not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Update Student Grades</h2>
    <form action="update_student.php" method="POST" class="card p-4 shadow rounded bg-white">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" class="form-control" name="name" value="<?= $student['name'] ?>" required>
        </div>

        <?php
        $subjects = ['im' => 'IM', 'oop' => 'OOP', 'net1' => 'NET1', 'it_track' => 'IT-TRACK', 'sts' => 'STS', 'accounting' => 'ACCOUNTING'];
        foreach ($subjects as $key => $label):
        ?>
        <div class="mb-3">
            <label class="form-label"><?= $label ?> Grade</label>
            <input type="number" step="0.01" class="form-control" name="<?= $key ?>" value="<?= $student[$key] ?>" required>
        </div>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-primary">Update Grades</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
