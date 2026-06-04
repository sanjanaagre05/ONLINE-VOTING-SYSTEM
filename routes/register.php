<?php
session_start();
$formdata = $_SESSION['formdata'] ?? [];
?>

<html>
<head>
<title>Online Voting System - Registration Form</title>
<link rel="stylesheet" href="../css/stylesheet.css">
</head>

<body>

<div id="headerSection">
<h1>Online Voting System</h1>
</div>
<hr>

<div id="bodySection">
<h2>Registration</h2>

<form action="../api/register.php" method="POST" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Enter name"
pattern="[A-Za-z ]+" title="Only letters allowed"
value="<?php echo $formdata['name'] ?? '' ?>" required>

<input type="tel" name="mobile" placeholder="Enter mobile number"
pattern="[0-9]{10}" maxlength="10"
value="<?php echo $formdata['mobile'] ?? '' ?>" required>
<br><br>

<input type="email" name="email" placeholder="Enter Email"
value="<?php echo $formdata['email'] ?? '' ?>" required>
<br><br>

<input type="password" name="password" placeholder="Password" required>

<input type="password" name="cpassword" placeholder="Confirm Password" required>
<br><br>

<input id="address" type="text" name="address" placeholder="Address"
value="<?php echo $formdata['address'] ?? '' ?>" required>
<br><br>

<center>

<div id="imagepart">
Upload image: <input type="file" name="photo" required>
</div>

<br>

<div id="role">
Select your role:
<select name="role" required>
<option value="1" <?php if(($formdata['role'] ?? '')==1) echo "selected"; ?>>Voter</option>
<option value="2" <?php if(($formdata['role'] ?? '')==2) echo "selected"; ?>>Group</option>
</select>
</div>

</center>

<br>

<button style="
padding:5px;
font-size:15px;
border-radius:5px;
background-color:blue;
color:white;">
Register
</button>

<br><br>

Already user? <a href="../login.php">Login here</a>

</form>
</div>

<div class="bottom-line"></div>

</body>
</html>