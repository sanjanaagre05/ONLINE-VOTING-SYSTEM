<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Voting System - Home</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>

<div id="header">
    <h1>Online Voting System</h1>
</div>

<div id="main">
    <h2>Welcome to Secure Online Voting Portal</h2>
    <p>
        This system allows voters to cast their vote securely 
        using Email OTP authentication.
    </p>

    <br>

    <a href="login.php">
        <button>Login</button>
    </a>

    <br><br>

    <a href="routes/register.php">
        <button>Register</button>
    </a>
</div>

<div class="section">
    <h3>System Features</h3>
    <p>• Secure Email OTP Authentication</p>
    <p>• One Vote Per Voter</p>
    <p>• Instant Vote Counting</p>
    <p>• Admin Monitoring System</p>
</div>

<footer></footer>

</body>
</html>
