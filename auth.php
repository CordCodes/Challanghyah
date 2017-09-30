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
        header("location:./dashboard/index.php");
      }

    }elseif (isset($_POST['signup'])) {
      $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);

      $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

      $sql = "INSERT INTO `users` (name, email, username, password)
VALUES ('$fullname', '$email', '$username','$hashedPassword')";
      $result = mysqli_query($conn,$sql);
      if (!$result==1){
        echo "There was an error signing you in. <a href='./index.html'>Go back!</a>";
      } else {
        $_SESSION['loggeduser'] = $username;
        header("location:./dashboard/index.php");
      }
    }
  } else {
    header("location:./index.html");
  }
?>
