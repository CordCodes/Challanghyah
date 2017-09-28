<?php
  require_once("./connect.php");
  session_start();

  if (isset($_POST)) {
    if (isset($_POST['login'])){
      $username = mysqli_real_escape_string($conn,$_POST['uname']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);
      $sql = "SELECT * FROM `users` WHERE '$username' = `username`";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $realpassword = password_verify($password, $row['password']);
      if ($realpassword){
        $_SESSION['loggeduser'] = row['username'];
        header("location:./dashboard.php");
      }

    }elseif (isset($_POST['signup'])) {
      echo "Signing up...";
    }
  } else {
    header("location:./index.html");
  }
?>
