<?php
include 'db.php';

$countResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$total = mysqli_fetch_assoc($countResult)['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<meta charset="UTF-8">

<title>Dashboard</title>

<link rel="stylesheet" href="css/dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="sidebar">

<h2>🎓 SMS</h2>

<ul>

<li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>

<li><a href="view.php"><i class="fa fa-users"></i> Students</a></li>

<li><a href="#" onclick="openAddStudentModal(); return false;"><i class="fa fa-user-plus"></i> Add Student</a></li>

<li><a href="#"><i class="fa fa-search"></i> Search</a></li>

<li><a href="#"><i class="fa fa-right-from-bracket"></i> Logout</a></li>

</ul>

</div>

<div class="main">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2>Welcome Admin 👋</h2>

<p id="clock"></p>

</div>

<div>

<button class="btn btn-primary">

<i class="bi bi-person-circle"></i>

Admin

</button>

</div>

</div>

<h1>Dashboard</h1>

<div class="cards">

<div class="card">

<h3>Total Students</h3>

<h1 class="counter" data-target="<?php echo (int) $total; ?>">0</h1>

</div>

<div class="card">

<h3>Sessions</h3>

<h1>5</h1>

</div>

<div class="card">

<h3>Emails</h3>

<h1 class="counter" data-target="<?php echo (int) $total; ?>">0</h1>

</div>

</div>

<div class="chart-card">

    <h2>Student Analytics</h2>

    <canvas id="studentChart"></canvas>

</div>

<h2>Recent Students</h2>

<table>

<tr>

<th>Name</th>

<th>Roll</th>

<th>Session</th>

</tr>

<?php

$data = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC LIMIT 5");
while($row = mysqli_fetch_assoc($data))
{
?>

<tr>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['roll']); ?></td>

<td><?php echo htmlspecialchars($row['session']); ?></td>

</tr>

<?php

}

?>

</table>

</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="insert.php" method="POST">
          <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
          </div>
          <div class="mb-3">
            <input type="text" name="registration" class="form-control" placeholder="Registration No." required>
          </div>
          <div class="mb-3">
            <input type="text" name="roll" class="form-control" placeholder="Roll No." required>
          </div>
          <div class="mb-3">
            <input type="text" name="session" class="form-control" placeholder="Session (e.g. 2023-24)" required>
          </div>
          <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Add Student</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

function openAddStudentModal(){
    const modalEl = document.getElementById('addStudentModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

</script>

<script>

function clock(){

let d=new Date();

document.getElementById("clock").innerHTML=d.toLocaleString();

}

setInterval(clock,1000);

clock();

</script>

<script>
const counters = document.querySelectorAll(".counter");

counters.forEach(counter => {
    const target = Number(counter.dataset.target);

    let current = 0;

    const updateCounter = () => {
        const increment = Math.max(1, Math.ceil(target / 50));

        current += increment;

        if (current >= target) {
            counter.innerText = target;
        } else {
            counter.innerText = current;
            requestAnimationFrame(updateCounter);
        }
    };

    updateCounter();
});
</script>

<script>
const ctx = document.getElementById("studentChart");

new Chart(ctx,{
    type:"bar",
    data:{
        labels:["Students","Sessions","Emails"],
        datasets:[{
            label:"System Overview",
            data:[<?php echo (int) $total; ?>,5,<?php echo (int) $total; ?>],
            backgroundColor:[
                "#0d6efd",
                "#198754",
                "#ffc107"
            ],
            borderRadius:8
        }]
    },
    options:{
        responsive:true,
        plugins:{
            legend:{
                display:false
            }
        },
        scales:{
            y:{
                beginAtZero:true
            }
        }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
