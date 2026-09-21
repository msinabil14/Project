<?php
include 'db.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conn, "SELECT * FROM students WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Student not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Student</title>

<style>

body{
font-family:Arial;
background:#f2f2f2;
}

.container{

width:400px;
margin:50px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 15px rgba(0,0,0,.2);

}

input{

width:100%;
padding:12px;
margin:10px 0;
font-size:16px;

}

button{

width:100%;
padding:12px;
background:#0d6efd;
color:white;
border:none;
cursor:pointer;
font-size:18px;

}

</style>

</head>

<body>

<div class="container">

<h2>Edit Student</h2>

<form action="update.php" method="POST">

<input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

<input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>

<input type="text" name="registration" value="<?php echo htmlspecialchars($row['registration']); ?>" required>

<input type="text" name="roll" value="<?php echo htmlspecialchars($row['roll']); ?>" required>

<input type="text" name="session" value="<?php echo htmlspecialchars($row['session']); ?>" required>

<input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

<button>Update Student</button>

</form>

</div>

</body>
</html>
