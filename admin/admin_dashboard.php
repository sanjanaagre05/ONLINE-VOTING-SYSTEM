<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
?>

<html>
<head>
    <title>Admin Dashboard - Online Voting System</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

<div id="adminHeader">
    <h1 style="color:white;">Admin Dashboard</h1>
</div>

<div class="dashboard-container">

    <div class="dashboard-card">
        <h3>Manage Users</h3>
        <a href="manage_users.php">
            <button>Open</button>
        </a>
    </div>

    <div class="dashboard-card">
        <h3>Manage Groups</h3>
        <a href="manage_groups.php">
            <button>Open</button>
        </a>
    </div>

    <div class="dashboard-card">
        <h3>View Results</h3>
        <a href="results.php">
            <button>Open</button>
        </a>
    </div>

    <div class="dashboard-card">
        <h3>Logout</h3>
        <a href="logout.php">
            <button style="background-color:red;">Logout</button>
        </a>
    </div>

</div>

</body>
</html>
