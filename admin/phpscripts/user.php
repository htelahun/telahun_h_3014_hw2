<?php

function createUser($fname, $username,$email, $userlvl){
  include('connect.php');

  $password_string = '1234567890';
  $password = substr(str_shuffle($password_string), 0, 9);

  $userString = "INSERT INTO tbl_user VALUES (NULL, '{$fname}', '{$username}', '{$password}', '{$email}', NULL, '{$userlvl}', 'no', '0')";
//echo $userString;

  $userQuery = mysqli_query($link, $userString);

  if($userQuery){

    $to      = $email;
    $subject = 'Login Information';
    $message = " Hi {$fname} your user name is: {$username} and your password is: {$password}. You can login at: index.php" ;

    mail($to, $subject, $message);

    redirect_to("admin_index.php");

  }else{
    $message = "there was a problem setting up this user.";

    return $message;
  }


  mysqli_close($link);
}

function editUser($id, $fname, $username, $password, $email){
  include('connect.php');
$updatestring = "UPDATE tbl_user SET user_fname = '{$fname}', user_name = '{$username}', user_pass = '{$password}', user_email = '{$email}' WHERE user_id = {$id} ";
//echo $updatestring;
$updatequery = mysqli_query($link, $updatestring);
if($updatequery){
redirect_to("admin_index.php");
}else{
  $message="There was a problem changing your information, please contact your admin. ";
}
mysqli_close($link);
}

function deleteUser($id){
  //echo $id;
  include('connect.php');
  $delstring = "DELETE FROM tbl_user WHERE user_id = {$id}";
  $delquery = mysqli_query($link, $delstring);

  if($delquery){
    redirect_to("../admin_index.php");
  }else{
    $message = "Error, contact your admin";
    return $message;
  }

  mysqli_close($link);
}






 ?>
