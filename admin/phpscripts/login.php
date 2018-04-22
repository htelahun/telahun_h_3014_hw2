<?php

function logIn($username, $password, $ip){

  require_once('connect.php');
  //use mysqli only, need to connect to server then variable inside brackets
  $username = mysqli_real_escape_string($link, $username);
  $password = mysqli_real_escape_string($link, $password);

    $loginstring = "SELECT * FROM tbl_user WHERE user_name = '{$username}' AND user_pass= '{$password}'";

    $userString = "SELECT * FROM tbl_user WHERE user_name = '{$username}'";
    //echo $loginstring;

    $user_set = mysqli_query($link, $loginstring);
    $user_only= mysqli_query($link, $userString);

    if (mysqli_num_rows($user_set)) {
      $found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
      $id = $found_user['user_id'];
      //echo $id;

      $_SESSION['user_id'] = $id;
      $_SESSION['user_name'] = $found_user['user_fname'];
      $_SESSION['user_date'] = $found_user['user_date'];
      $_SESSION['user_attempts'] = $found_user['user_attempts'];

    //  echo $_SESSION['user_date'];

      if (mysqli_query($link, $loginstring)) {
        $attempts = $founduser['user_attempts'];

        if ($attempts <= 3) {
//update ip address
        $updatestring = "UPDATE tbl_user SET user_ip = '$ip' WHERE user_id = {$id}";
        $updatequery = mysqli_query($link, $updatestring);
//update login time and date
        $lastLogin = "SELECT user_date FROM tbl_user where user_id = {$id}";
        //echo $lastLogin;
        $time = "UPDATE tbl_user SET user_date = CURRENT_TIMESTAMP WHERE user_id = {$id}";

        $updateTime = mysqli_query($link, $time);
//reset attempts
        $reset =  "UPDATE tbl_user SET user_attempts='0' WHERE user_id = {$id}";
        $resetQuery = mysqli_query($link, $reset);

      redirect_to('admin/admin_index.php');

      }else{
  // if logged in more then 3 times -> send to lockout page which i dont know how to actually lock, hopefully this counts

      redirect_to('admin/admin_lockout.php');
      }
    }
  }
  //if they only have the user name -> log the attempts
  elseif(mysqli_num_rows($user_only)){
    //increment the attempts
    $found_user = mysqli_fetch_array($user_only, MYSQLI_ASSOC);
    $id = $found_user['user_id'];
    //echo $id;

    $_SESSION['user_id'] = $id;
    $_SESSION['user_name'] = $found_user['user_name'];
    $_SESSION['user_attempts'] = $found_user['user_attempts'];

    $username = $found_user['user_name'];

    $logginIn =  $found_user['user_attempts'];

          $_SESSION['user_attempts'] += 1;
          $logAttempts =  $_SESSION['user_attempts'];

          $fail = "UPDATE tbl_user SET user_attempts = '{$logAttempts}' WHERE user_name = '{$username}' ";
          $updateFail = mysqli_query($link, $fail);

//if logged in less than 3 give them chances
    if ($logginIn < 3) {
      $message = "Username and/or password is incorrect.";
      return $message;
  } //if looged in more than 3 times, lockout
      else {
          redirect_to('admin/admin_lockout.php');
      }
  }else{
            $message = "Username and/or password is incorrect.";
            return $message;
    }

  mysqli_close($link);
}



 ?>
