<?php
//init_set('display_errors', 1);//mac
//error_reporting(E_All); //mac

require_once('phpscripts/config.php');
 confirm_logged_in();

if(isset($_POST['submit'])){
  $fname = trim($_POST ['fname']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $email = trim($_POST['email']);
  $userlvl = $_POST['userlvl'];

if(empty($userlvl)){
  $message = "Please select user level";
}else {
  $result = createUser($fname, $username, $password, $email, $userlvl);
  $message = $result;
}
}

 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
      <link rel="stylesheet" href="../css/login.css">
    <title>Create User</title>
  </head>
  <body>
    <header>
      <ul>
      <li >
        <a class="loginimg" href="admin_index.php"> <img src="../images/back.png" alt="">
        </a>
      </li>
      </ul>
        <h1 class="header">CREATE USER</h1>
    </header>

    <?php if(!empty($message)){echo $message;} ?>

      <form action="admin_add.php" method="post" enctype="multipart/form-data"><!--default to text only in form. wont work for img or video. multipart expects something other than text there. Allows for upload of files. takes care of going to the server for us-->
        <label style="color:white;font-weight:bold;" class="mid">FIRST NAME</label>
        <input style="color:white;" class="center-input" type="text" name="fname"value="" <?php if(!empty($fname)){echo $fname;} ?>><br><br>

        <label style="color:white;font-weight:bold;" class="mid">USERNAME </label>
        <input class="center-input" type="text" name="username" value="" <?php if(!empty($username)){echo $username;} ?>><br><br>


          <label style="color:white;font-weight:bold;" class="mid ">PASSWORD </label>
          <input class="center-input" type="text" name="password" value="" <?php if(!empty($password)){echo $password;} ?>><br><br>

          <label style="color:white;font-weight:bold;" class="mid">E-MAIL</label>
          <input class="center-input" type="text" name="email" value="" <?php if(!empty($email)){echo $email;} ?>><br><br>

        <label style="color:white;font-weight:bold;" class="mid">USER LEVEL </label>
        <select class="mid center-input"  name="userlvl">
          <option value="">Please select user level</option>
      <option value="2">Web Admin</option>
      <option value="1">Web master</option>
    </select><br><br>

        <input style="margin-top:5%;" class="center-btn2" type="submit" name="submit" value="Create User">
      </form>

  </body>
</html>
