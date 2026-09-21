<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$name         = trim($_POST['name'] ?? '');
$registration = trim($_POST['registration'] ?? '');
$roll         = trim($_POST['roll'] ?? '');
$session      = trim($_POST['session'] ?? '');
$email        = trim($_POST['email'] ?? '');

if ($name === '' || $registration === '' || $roll === '' || $session === '' || $email === '') {
    die("Error: All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email address.");
}

$stmt = mysqli_prepare($conn,
    "INSERT INTO students (name, registration, roll, session, email) VALUES (?, ?, ?, ?, ?)"
);
mysqli_stmt_bind_param($stmt, "sssss", $name, $registration, $roll, $session, $email);

if (mysqli_stmt_execute($stmt)) {
    header("Location: view.php");
    exit();
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
