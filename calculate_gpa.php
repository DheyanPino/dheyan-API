<?php
require 'database.php';
$db = new Database();
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt =  $db->connect()->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch();

    if ($student) {
        $grades = [$student['im'], $student['oop'], $student['net1'], $student['it_track'], $student['sts'], $student['accounting']];
        $gpa = round(array_sum($grades) / count($grades),2);

        $update =  $db->connect()->prepare("UPDATE students SET gpa = ? WHERE id = ?");
        $update->execute([$gpa, $id]);
    }
}

header("Location: index.php");
exit;
?>
