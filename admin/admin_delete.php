<?php
//init_set('display_errors', 1);//mac
//error_reporting(E_All); //mac

require_once('phpscripts/config.php');
 //confirm_logged_in();
$tbl = "tbl_user";
$user = getAll($tbl);

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="../css/login.css">
    <title>Delete User</title>
  </head>
  <body>
    <header>
      <ul>
      <li >
        <a class="loginimg" href="admin_index.php"> <img src="../images/back.png" alt="">
        </a>
      </li>
      </ul>
        <h1 class="header">DELETE USER</h1>
    </header>

<section>
  <div >
  <ul class="position">
    <li class="movies">
      <?php
    while($row = mysqli_fetch_array($user)){
      //
      echo "<p style=\"margin-left:20%;\" >{$row['user_fname']}</p> <a style=\"margin-top:-45px;margin-left:200px;width:90px;padding: 10px;border: solid 1px white;background-color: #464646;color: white;float: left;text-decoration:none;\" href=\"phpscripts/caller.php?caller_id=delete&id={$row['user_id']}\">Delete User</a><br>";


      }
     ?>
     </li>
   </ul>
 </div>
</section>

  </body>
</html>
