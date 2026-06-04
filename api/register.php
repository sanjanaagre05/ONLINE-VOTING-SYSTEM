<?php
session_start();
include("connect.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];   
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

$_SESSION['formdata'] = $_POST;

if(!preg_match("/^[A-Za-z ]+$/", $name)){
    echo '
    <script>
    alert("Name should contain only letters!");
    window.location="../routes/register.php";
    </script>
    ';
    exit();
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo '
    <script>
    alert("Invalid Email Format!");
    window.location="../routes/register.php";
    </script>
    ';
    exit();
}

$allowed_domains = ["gmail.com", "yahoo.com", "outlook.com"];
$domain = substr(strrchr($email, "@"), 1);

if(!in_array($domain, $allowed_domains)){
    echo '
    <script>
    alert("Use valid email like gmail.com");
    window.location="../routes/register.php";
    </script>
    ';
    exit();
}

if($password != $cpassword){
    echo '
    <script>
    alert("Password and Confirm password does not match!");
    window.location="../routes/register.php";
    </script>
    ';
    exit();
}


$check_mobile = mysqli_query($connect,"SELECT * FROM user WHERE mobile='$mobile'");

if(mysqli_num_rows($check_mobile) > 0){
    echo '
    <script>
    alert("Mobile number already registered!");
    window.location="../routes/register.php";
    </script>
    ';
    exit();
}


$check_email = mysqli_query($connect,"SELECT * FROM user WHERE email='$email'");

if(mysqli_num_rows($check_email) > 0){
    echo '
    <script>
    alert("Email already registered!");
    window.location="../routes/register.php";
    </script>
    ';
    exit();
}

if(file_exists("../uploads/".$image)){
    echo '
    <script>
    alert("This photo is already uploaded!");
    window.location="../routes/register.php";
    </script>
    ';
    exit();
}

move_uploaded_file($tmp_name,"../uploads/$image");


$insert = mysqli_query($connect,"INSERT INTO user
(name,mobile,email,address,password,photo,role,status,votes)
VALUES
('$name','$mobile','$email','$address','$password','$image','$role',0,0)");

if($insert){

    unset($_SESSION['formdata']);

    echo '
    <script>
    alert("Registration Successful");
    window.location="../";
    </script>
    ';
}
else{
    echo '
    <script>
    alert("Some error occurred!");
    window.location="../routes/register.php";
    </script>
    ';
}
?>