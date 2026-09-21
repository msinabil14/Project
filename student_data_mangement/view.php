<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student List</title>

<style>

body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:#f4f7fc;
}

.container{
    width:90%;
    margin:40px auto;
}

h2{
    text-align:center;
    color:#0d6efd;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 5px 15px rgba(0,0,0,.2);
}

table th{
    background:#0d6efd;
    color:white;
    padding:15px;
}

table td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f1f1f1;
}

.btn{
    display:inline-block;
    margin-bottom:20px;
    padding:10px 18px;
    background:#198754;
    color:white;
    text-decoration:none;
    border-radius:6px;
}

.edit{
    background:#ffc107;
    color:black;
    padding:6px 12px;
    text-decoration:none;
    border-radius:5px;
}

.delete{
    background:#dc3545;
    color:white;
    padding:6px 12px;
    text-decoration:none;
    border-radius:5px;
}

</style>

</head>
<body>

<div class="container">

<h2>Student List</h2>

<a href="index.php" class="btn">+ Add Student</a>

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Registration</th>
    <th>Roll</th>
    <th>Session</th>
    <th>Email</th>
    <th>Action</th>
</tr>

<?php

if (mysqli_num_rows($result) === 0) {
?>
<tr>
    <td colspan="7">No students found. <a href="index.php">Add one</a>.</td>
</tr>
<?php
}

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo htmlspecialchars($row['id']); ?></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td><?php echo htmlspecialchars($row['registration']); ?></td>
<td><?php echo htmlspecialchars($row['roll']); ?></td>
<td><?php echo htmlspecialchars($row['session']); ?></td>
<td><?php echo htmlspecialchars($row['email']); ?></td>

<td>

<a class="edit" href="edit.php?id=<?php echo (int) $row['id']; ?>">Edit</a>

<a class="delete"
href="delete.php?id=<?php echo (int) $row['id']; ?>"
onclick="return confirm('Are you sure?');">

Delete

</a>

</td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>
