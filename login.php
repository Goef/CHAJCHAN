<?php
   include("config.php");
   session_start();

   if(isset($_POST['submit'])) {
      // username and password sent from form

      $myemail    = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['pwd']);

      $sql = "SELECT id, name, username FROM users WHERE email = '$myemail' and pwd = '$mypassword'";
      $result = mysqli_query($db,$sql);
      // $row = mysqli_fetch_assoc($result);

      // $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if(!$row = mysqli_fetch_assoc($result)) {
        $error = "Je bent een homo";
      } else {
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['login_user'] = $row['username'];
        $_SESSION['email']      = $row['email'];
        header("location: welcome.php");
      }



         // header("location: welcome.php");
      // }else {
      //    $error = "Your Login Name or Password is invalid";
      // }
   }
?>





<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lets Get Social</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by gettemplates.co" />
    <meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="gettemplates.co" />

    <!--
        Oxygen by gettemplates.co
        Twitter: http://twitter.com/gettemplateco
        URL: http://gettemplates.co
    -->

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <!-- <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'> -->

    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<div class="gtco-loader"></div>

<div id="page">
    <!--<nav class="gtco-nav" role="navigation">-->
    <!--<div class="gtco-container">-->
    <!--<div class="row">-->
    <!--<div class="col-xs-2">-->
    <!--<div id="gtco-logo"><a href="index.html">Lets Get Social</a></div>-->
    <!--</div>-->
    <!--<div class="col-xs-2 text-right hidden-xs menu-2">-->
    <!--<ul>-->
    <!--<li class="btn-cta" ><a href="#"><span>Login</span></a></li>-->
    <!--</ul>-->
    <!--</div>-->
    <!--</div>-->
    <!---->
    <!--</div>-->
    <!--</nav>-->

    <header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(images/img_bg_1.jpg);">
      <a href="#"> <img src="images\arrowback.png" onclick="history.go(-1)" height="25" width="25"</a>

        <div class="container">

            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                </div>
            
                <button name="submit" type="submit" class="btn btn-default" autocomplete="on">Submit</button>
            </form>
            <p><a href="create.php" class="btn btn-default">Create your account now!</a></p>

        </div>
    </header>

</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Carousel -->
<script src="js/owl.carousel.min.js"></script>
<!-- countTo -->
<script src="js/jquery.countTo.js"></script>
<!-- Magnific Popup -->
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/magnific-popup-options.js"></script>
<!-- Main -->
<script src="js/main.js"></script>

</body>
</html>
