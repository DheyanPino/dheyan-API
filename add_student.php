<?php
require 'database.php';
$db = new Database();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt =  $db->connect()->prepare("INSERT INTO students (name, im, oop, net1, it_track, sts, accounting) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['im'],
        $_POST['oop'],
        $_POST['net1'],
        $_POST['it_track'],
        $_POST['sts'],
        $_POST['accounting']
    ]);
}

header("Location: index.php");
exit;
?>
