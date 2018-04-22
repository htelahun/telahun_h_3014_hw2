<?php
//init_set('display_errors', 1);//mac
//error_reporting(E_All); //mac

require_once('phpscripts/config.php');
 //confirm_logged_in();

 //grab the id from the session
$id = $_SESSION['user_id'];
//echo $id;

//get single function on read.php file
$tbl = "tbl_user";
$col = "user_id";
$popform = getSingle($tbl, $col, $id);
//make info into array, echo in the HTML code
$found_user = mysqli_fetch_array($popform, MYSQLI_ASSOC);
//echo $found_user;

if(isset($_POST['submit'])){
  $fname = trim($_POST ['fname']);
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $email = trim($_POST['email']);

  $result = editUser($id, $fname, $username, $password, $email);
  $message = $result;

}

 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="../css/login.css">
    <title>Edit user</title>
  </head>
  <body>
    <header>
      <ul>
      <li >
        <a class="loginimg" href="admin_index.php"> <img src="../images/back.png" alt="">
        </a>
      </li>
      </ul>
        <h1 class="header">EDIT USER</h1>
    </header>

    <?php if(!empty($message)){echo $message;} ?>
      <form class="mid" action="admin_edit.php" method="post">
        <label style="color:white;font-weight:bold;" class="mid">FIRST NAME</label>
        <input style="color:white;" class="center-input" type="text" name="fname" value=" <?php echo $found_user['user_fname']; ?>"><br><br>

        <label style="color:white;font-weight:bold;" class="mid">USERNAME </label>
        <input class="center-input" type="text" name="username" value=" <?php echo $found_user['user_name']; ?>"><br><br>

        <label style="color:white;font-weight:bold;" class="mid ">PASSWORD </label>
        <input class="center-input" type="text" name="password" value=" <?php echo $found_user['user_pass']; ?>"><br><br>

        <label style="color:white;font-weight:bold;" class="mid">E-MAIL</label>
        <input class="center-input" type="text" name="email" value="<?php echo $found_user['user_email']; ?>"><br><br>

        <input style="margin-top:5%;margin-bottom:5%;" class="center-btn2"  type="submit" name="submit" value="Edit Account">

      </form>

</script>
  </body>
</html>
