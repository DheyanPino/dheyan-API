<?php
require 'database.php';
$db = new Database();

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt =  $db->connect()->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>
