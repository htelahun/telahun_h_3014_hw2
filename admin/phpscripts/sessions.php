<?php
//protecting the admin_index page, only shows info on page if logged in
session_start();

function confirm_logged_in(){

  if (!isset($_SESSION['user_id'])) {
    redirect_to("admin_login.php");
  }
}

function logged_out(){
  session_destroy();
  redirect_to("admin_index.php");

}


//link to function in admin_index.php, sends you to the index page if you kill the browser then sign in again
function first_log(){
    if (!isset($_SESSION['FirstVisit'])) {

    $_SESSION['FirstVisit'] = 1;
    redirect_to("admin_edit.php");

  }
}
 ?>
