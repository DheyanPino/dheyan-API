<?php
require 'database.php';

    $db = new Database();
    
    $students = $db->connect()->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student GPA Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Student GPA Management System</h2>

    <!-- Add Student Form -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-primary text-white">Add New Student</div>
        <div class="card-body">
            <form action="add_student.php" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Student Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <?php
                $subjects = ['im' => 'IM', 'oop' => 'OOP', 'net1' => 'NET1', 'it_track' => 'IT-TRACK', 'sts' => 'STS', 'accounting' => 'ACCOUNTING'];
                foreach ($subjects as $key => $label): ?>
                    <div class="col-md-4">
                        <label class="form-label"><?= $label ?></label>
                        <input type="number" step="0.01" class="form-control" name="<?= $key ?>" required>
                    </div>
                <?php endforeach; ?>

                <div class="col-12">
                    <button type="submit" class="btn btn-success w-100">Add Student</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Student Records Table -->
    <div class="card shadow">
        <div class="card-header bg-dark text-white">Student List</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>IM</th>
                        <th>OOP</th>
                        <th>NET1</th>
                        <th>IT-TRACK</th>
                        <th>STS</th>
                        <th>ACCOUNTING</th>
                        <th>GPA</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($students) > 0): ?>
                        <?php foreach ($students as $s): ?>
                            <tr>
                                <td><?= htmlspecialchars($s['name']) ?></td>
                                <td><?= $s['im'] ?></td>
                                <td><?= $s['oop'] ?></td>
                                <td><?= $s['net1'] ?></td>
                                <td><?= $s['it_track'] ?></td>
                                <td><?= $s['sts'] ?></td>
                                <td><?= $s['accounting'] ?></td>
                                <td><strong><?= $s['gpa'] ?? '-' ?></strong></td>
                                <td>
                                    <a href="update.php?id=<?= $s['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="calculate_gpa.php?id=<?= $s['id'] ?>" class="btn btn-info btn-sm">Calc GPA</a>
                                    <a href="delete_student.php?id=<?= $s['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="9" class="text-muted">No students found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
