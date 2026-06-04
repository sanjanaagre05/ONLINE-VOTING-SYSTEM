<?php
session_start();
include("../api/connect.php");

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}

$data = mysqli_query($connect,"SELECT * FROM user WHERE role=2");
?>

<html>
<head>
<title>Voting Results</title>
<link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
<div class="container">
<h1>Voting Results</h1>

<a href="admin_dashboard.php" class="btn back-btn">Back</a>
<a href="logout.php" class="btn logout-btn">Logout</a>

<table>
<tr>
<th>Group Name</th>
<th>Total Votes</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($data)){
    echo "<tr>
    <td>".$row['name']."</td>
    <td>".$row['votes']."</td>
    </tr>";
}
?>

</table>
</div>
</body>
</html>
