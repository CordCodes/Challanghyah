<?php
  include_once("connect.php");
  session_start();

  $userCheck = $_SESSION['loggeduser'];
  $userCheck2 = mysqli_real_escape_string($conn, $userCheck);

  $sql = "SELECT * FROM `users` WHERE `username` = '$userCheck2'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

  if($result === FALSE) {
    die("Error");
  }

  $loginSession = $row['username'];

  if (!isset($_SESSION['loggeduser'])){
    header("location:index.html");
  }
?>
