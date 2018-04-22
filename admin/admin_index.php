<?php
require_once('phpscripts/config.php');
 confirm_logged_in();
 first_log();

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS Homepage</title>
    <link rel="stylesheet" href="../css/login.css">
  </head>
  <body>
    <header>
      <ul>
      <li >
        <a class="logout" href="../index.php">LOGOUT</a>
      </li>

      </ul>
    </header>

    <section class="login-box">
    <div class="center-2">
        <?php
        echo "<h1> Hello {$_SESSION['user_name']}!</h1>";
        echo "<p> Your last log in was on : {$_SESSION['user_date']}</p>";

        ?>
    </div>


      <a class="link1 click" href="admin_add.php">CREATE USER</a>
      <a class=" click" href="admin_edit.php">EDIT USER</a>
      <a class="click" href="admin_delete.php">DELETE USER</a>
    </section>
  </body>
</html>
