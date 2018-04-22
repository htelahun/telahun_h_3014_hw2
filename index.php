<?php
//init_set('display_errors', 1);//mac
//error_reporting(E_All); //mac

require_once('admin/phpscripts/config.php');

//what ip address youre signing in at
//test it localhost/MMED_3014_18/admin/admin_login.php
//php.net there are $_SERVER options
$ip = $_SERVER['REMOTE_ADDR'];
//echo $ip;

if (isset($_POST['submit'])) {
  //trim gets rid of whitespace
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  if ($username !=="" && $password !=="") {
  //  echo "you can type";
  $result = logIn($username, $password, $ip);
  $message = $result;
  }else{
    $message ="Please fill in the required fields";
    //echo $message;
  }
}



 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
  
<!-- <div class="forgot-box">
  <p>Username : Hana <br><br> Password: 123</p>
</div> -->

    <div class="login-box">

    <h1 class="center-t">ADMIN LOGIN</h1>
    <p class="center1">
    <?php
      if(!empty($message)){
        echo $message;
      }
     ?>
     </p>
      <form action="index.php" method="post">
        <input class="center" type="text" name="username" placeholder="USERNAME">
        <img  alt="">
          <br><br>
        <input class="center" type="text" name="password" placeholder="PASSWORD">
          <br><br>

          <a class="forgot" href="#">Forgot Password?</a>

        <input class="center-btn" type="submit" name="submit" value="LOGIN">
      </form>


    </div>

    <script src="js/main.js">

    </script>
  </body>
</html>
