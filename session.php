<?php
   include('config.php');
   session_start();

   $user_check = $_SESSION['login_user'];
<<<<<<< HEAD

   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['username'];
=======
  $Myemail = $_SESSION['email'];

   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");


>>>>>>> 1ef82cc7bfaef69ac45ebbee6ed4777f99a40a34

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>
