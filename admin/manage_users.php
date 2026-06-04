<?php   
session_start();
include("../api/connect.php");

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($connect,"DELETE FROM user WHERE id='$id'");
    header("Location: manage_users.php");
    exit();
}

if(isset($_POST['add'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];

    if(!preg_match("/^[A-Za-z ]+$/", $name)){
        echo "<script>alert('Name only letters allowed');</script>";
        exit();
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid Email');</script>";
        exit();
    }

    if($password != $cpassword){
        echo "<script>alert('Password not match');</script>";
        exit();
    }

    $check_mobile = mysqli_query($connect, "SELECT * FROM user WHERE mobile='$mobile'");
    if(mysqli_num_rows($check_mobile) > 0){
        echo "<script>alert('Mobile already exists');</script>";
        exit();
    }

    $check_email = mysqli_query($connect, "SELECT * FROM user WHERE email='$email'");
    if(mysqli_num_rows($check_email) > 0){
        echo "<script>alert('Email already exists');</script>";
        exit();
    }

    move_uploaded_file($tmp_name, "../uploads/$image");

    mysqli_query($connect,"INSERT INTO user 
    (name,email,mobile,password,address,photo,role,status,votes)
    VALUES('$name','$email','$mobile','$password','$address','$image','$role',0,0)");

    header("Location: manage_users.php");
    exit();
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    mysqli_query($connect,"UPDATE user SET 
        name='$name',
        email='$email',
        role='$role',
        status='$status'
        WHERE id='$id'");

    header("Location: manage_users.php");
    exit();
}

$data = mysqli_query($connect,"SELECT * FROM user");
?>

<html>
<head>
<title>Manage Users</title>
<link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

<div class="container">

<h1>Manage Users</h1>

<a href="admin_dashboard.php" class="btn back-btn">Back</a>
<a href="logout.php" class="btn logout-btn">Logout</a>

<hr>

<h2>Add New User</h2>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Enter name" pattern="[A-Za-z ]+" title="Only letters allowed" required>

<input type="email" name="email" placeholder="Email" required>

<input type="tel" name="mobile" placeholder="Enter number" pattern="[0-9]{10}" maxlength="10" required>

<br><br>

<input type="password" name="password" placeholder="Password" required>

<input type="password" name="cpassword" placeholder="Confirm Password" required>

<br><br>

<input type="text" name="address" placeholder="Address" required>

<br><br>

<input type="file" name="photo" required>

<br><br>

<select name="role">
<option value="1">Voter</option>
<option value="2">Group</option>
</select>

<br><br>

<button type="submit" name="add">Add User</button>

</form>

<hr>

<h2>All Users</h2>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($data)){ ?>

<tr>
<form method="POST">

<td>
<?php echo $row['id']; ?>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
</td>

<td>
<input type="text" name="name" value="<?php echo $row['name']; ?>">
</td>

<td>
<input type="email" name="email" value="<?php echo $row['email']; ?>">
</td>

<td>
<select name="role">
<option value="1" <?php if($row['role']==1) echo "selected"; ?>>Voter</option>
<option value="2" <?php if($row['role']==2) echo "selected"; ?>>Group</option>
</select>
</td>

<td>
<select name="status">
<option value="0" <?php if($row['status']==0) echo "selected"; ?>>Not Voted</option>
<option value="1" <?php if($row['status']==1) echo "selected"; ?>>Voted</option>
</select>
</td>

<td>
<button type="submit" name="update">Update</button>

<a href="manage_users.php?delete=<?php echo $row['id']; ?>" 
onclick="return confirm('Delete this user?')">Delete</a>
</td>

</form>
</tr>

<?php } ?>

</table>

</div>
</body>
</html>