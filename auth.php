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
      } else{
        eader('Location:./index.html?signuperror=signinerror');
      }

    }elseif (isset($_POST['signup'])) {
      $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);
      $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

      //Check to see if username or email already exists.
      $testForUE = "SELECT * FROM `users` WHERE `username` = '$username' OR `email` = '$email'";
      $result = mysqli_query($conn,$testForUE);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      if (($row['email']==$email)&&($row['username']==$username)){
        header('Location:./index.html?signuperror=eutaken');
      }elseif ($row['email']==$email){
        header('Location:./index.html?signuperror=emailtaken');
      }elseif ($row['username']==$username){
        header('Location:./index.html?signuperror=unametaken');
      }else{
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


    }

  } else {
    header("location:./index.html");
  }


?>
