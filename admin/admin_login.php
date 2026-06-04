<?php
session_start();
include("../api/connect.php");

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($connect, 
        "SELECT * FROM admin WHERE username='$username' AND password='$password'"
    );

    if(mysqli_num_rows($check) > 0){
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Admin Credentials');</script>";
    }
}
?>

<html>
<head>
    <title>Admin Login - Online Voting System</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

<div id="adminHeader">
    <h1 style="color:white;">Online Voting System</h1>
</div>

<div class="admin-box">
    <h2>Admin Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>
