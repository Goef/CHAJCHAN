<?php
   include('config.php');
   session_start();

  $user_check = $_SESSION['login_user'];
  $Myemail    = $_SESSION['email'];

  $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");



  if(!isset($_SESSION['login_user'])){
      header("location:login.php");
  }
?>
