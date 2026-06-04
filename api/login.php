<?php
session_start();
date_default_timezone_set('Asia/Kolkata');

include("connect.php");
include("email_otp.php");

if(isset($_POST['login'])){
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $check = mysqli_query($connect,
        "SELECT * FROM user 
        WHERE mobile='$mobile' 
        AND password='$password' 
        AND role='$role'");

    if(mysqli_num_rows($check) > 0){
        $userdata = mysqli_fetch_array($check);

        $otp = rand(100000,999999);
        $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

        mysqli_query($connect,
            "UPDATE user 
            SET otp='$otp', otp_expiry='$expiry' 
            WHERE mobile='$mobile'");

        sendEmailOTP($userdata['email'], $otp);
        
        $_SESSION['otp_mobile'] = $mobile;
        $_SESSION['otp_role'] = $role;

        echo "<script>
                alert('OTP Sent to your Email');
                window.location='../login.php?otp=1';
            </script>";
    }
    else{
        echo "<script>
                alert('Invalid Credentials!');
                window.location='../login.php';
            </script>";
    }
}
if(isset($_POST['verify'])){

    $mobile = $_SESSION['otp_mobile'];
    $role = $_SESSION['otp_role'];
    $user_otp = $_POST['otp'];

    $check = mysqli_query($connect, "SELECT * FROM user WHERE mobile='$mobile'AND role='$role'");

    $data = mysqli_fetch_array($check);

    if($data['otp'] == $user_otp && strtotime($data['otp_expiry']) > time()){

        $groups = mysqli_query($connect, "SELECT * FROM user WHERE role=2");
        
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        $_SESSION['userdata'] = $data;
        $_SESSION['groupsdata'] = $groupsdata;

        echo "<script>
                alert('Login Successful');
                window.location='../routes/dashboard.php';
            </script>";
    }
    else{
        echo "<script>
                alert('Invalid or Expired OTP!');
                window.location='../login.php';
            </script>";
    }
}
?>