<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: view.php");
    exit();
}

$id           = (int) ($_POST['id'] ?? 0);
$name         = trim($_POST['name'] ?? '');
$registration = trim($_POST['registration'] ?? '');
$roll         = trim($_POST['roll'] ?? '');
$session      = trim($_POST['session'] ?? '');
$email        = trim($_POST['email'] ?? '');

if ($id <= 0 || $name === '' || $registration === '' || $roll === '' || $session === '' || $email === '') {
    die("Error: All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email address.");
}

$stmt = mysqli_prepare($conn,
    "UPDATE students SET name = ?, registration = ?, roll = ?, session = ?, email = ? WHERE id = ?"
);
mysqli_stmt_bind_param($stmt, "sssssi", $name, $registration, $roll, $session, $email, $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: view.php");
    exit();
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
