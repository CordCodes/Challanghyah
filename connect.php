<?php
  $host = "mysql5.gear.host";
  $username = "challanghyahdb";
  $password = "Nw64F?DDv~oo";
  $database = "challanghyahdb";

  $conn = mysqli_connect($host,$username,$password,$database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>
