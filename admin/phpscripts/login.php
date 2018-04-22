<?php
function logIn($username, $password, $ip)
{
  require_once('connect.php');
  $username = mysqli_real_escape_string($link, $username);
  $password = mysqli_real_escape_string($link, $password);
  $loginstring = "Select * from tbl_user where user_name = '{$username}' and user_pass = '{$password}'";
  $loginUser = "Select * from tbl_user where user_name = '{$username}'";

  $user_set = mysqli_query($link, $loginstring);
  $user_only = mysqli_query($link, $loginUser);
if(mysqli_num_rows($user_set))
{
  $founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
  $id = $founduser['user_id'];
  $_SESSION['user_id'] = $id;
  $_SESSION['user_name'] = $founduser['user_name'];
  $_SESSION['user_date'] = $founduser['user_date'];
  $_SESSION['user_attempts'] = $founduser['user_attempts'];

  if(mysqli_query($link, $loginstring))
  {
    $noattempts = $founduser['user_attempts'];
    if($noattempts <= 3)
    {
    $update = "update tbl_user set user_ip='{$ip}' where user_id = {$id}  ";
    $updatequery = mysqli_query($link, $update);
    $lastlog = "select user_date from tbl_user where user_id = {$id}";
    $lastlogQuery = mysqli_query($link, $lastlog);
$time = "update tbl_user set user_date = CURRENT_TIMESTAMP where user_id = {$id}";
    $timeupdate = mysqli_query($link, $time);
    $attempsvalue =  "update tbl_user set user_attempts='0' where user_name = '{$username}'  ";
    $attempsvalueupdate = mysqli_query($link, $attempsvalue);
  }

  else{
    redirect_to("admin/admin_lockout.php");

  }
}

  {
  redirect_to("admin/admin_index.php");
}

}
elseif(mysqli_num_rows($user_only)){

  $founduser = mysqli_fetch_array($user_only, MYSQLI_ASSOC);
  $_SESSION['user_name'] = $founduser['user_fname'];
  $_SESSION['user_attempts'] = $founduser['user_attempts'];

$_SESSION['user_attempts'] += 1;
  $attempts =  $_SESSION['user_attempts'];
  $fail = "update tbl_user set user_attempts='{$attempts}' where user_name = '{$username}'  ";
  $failupdate = mysqli_query($link, $fail);
  $msg ="Wrong info";
  return $msg;
}

else{
  $msg ="Wrong ";
  return $msg;
}
  mysqli_close($link);
}
 ?>
