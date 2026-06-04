<?php
session_start();
?>

<html>
    <head>
        <title>Online Voting System</title>
        <link rel="stylesheet" href="css/stylesheet.css">
    </head>

<body>
    <div id="headerSection">
        <h1>Online Voting System</h1>
    </div>
    <hr>

<?php if(!isset($_GET['otp'])){ ?>

    <div id="bodySection">
        <form action="api/login.php" method="POST">
            <h2>Login</h2>

            <input type="tel" name="mobile" placeholder="Enter number" pattern="[0-9]{10}" maxlength="10" required><br><br>

            <input type="password" name="password" placeholder="Enter Password" required><br><br>

            <select id="dropbox" name="role">
                <option value="1">Voter</option>
                <option value="2">Group</option>
            </select><br><br>

            <button id="loginbutton" type="submit" name="login">Login</button><br><br>
             New user? <a href="routes/register.html">Register Here</a>
        </form>
    </div>

<?php } else { ?>

<div id="bodySection">
<form action="api/login.php" method="POST">
    <h2>Enter OTP</h2>

    <input type="number" name="otp" placeholder="Enter OTP" required><br><br>
    <button type="submit" name="verify">Verify OTP</button>
</form>
</div>

<?php } ?>

<div class="bottom-line"></div>

</body>
</html>
