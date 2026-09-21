<?php
include 'db.php';

$countResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$studentTotal = (int) mysqli_fetch_assoc($countResult)['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>

    <link rel="stylesheet" href="css/style.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="container">

<div class="background">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>

<nav>

    <div class="logo">
        <i class="fa-solid fa-graduation-cap"></i>
        Student Management
    </div>

    <ul>

        <li><a href="#">Home</a></li>
        <li><a href="view.php">Students</a></li>
        <li><a href="#">About</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>

    </ul>

</nav>

<section class="hero">

<div class="glass">

<h1>Student Management System</h1>

<p id="typing">
    
</p>

<div class="hero-buttons">

<a href="dashboard.php">
<button type="button">Open Dashboard</button>
</a>

<button type="button" class="btn-outline" onclick="openAddModal()">+ Add Student</button>

</div>

</div>

</section>

<!-- Add Student Modal -->
<div class="modal-overlay" id="addStudentOverlay">

<div class="glass form-card modal-box">

<button type="button" class="modal-close" onclick="closeAddModal()" aria-label="Close">&times;</button>

<h2>Add New Student</h2>

<form action="insert.php" method="POST">

<input type="text" name="name" placeholder="Full Name" required>

<input type="text" name="registration" placeholder="Registration No." required>

<input type="text" name="roll" placeholder="Roll No." required>

<input type="text" name="session" placeholder="Session (e.g. 2023-24)" required>

<input type="email" name="email" placeholder="Email Address" required>

<button type="submit">Add Student</button>

</form>

</div>

</div>

<section class="stats">

<div class="box">

<h2 id="student">0</h2>

<p>Students</p>

</div>

<div class="box">

<h2 id="session">8</h2>

<p>Sessions</p>

</div>

<div class="box">

<h2 id="course">5</h2>

<p>Courses</p>

</div>

</section>

<script>
    // Real student count from the database, read by js/app.js
    const STUDENT_TOTAL = <?php echo $studentTotal; ?>;
</script>
<script src="js/app.js"></script>

</body>
</html>
