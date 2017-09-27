<?php
  $host = "mysql5.gear.host";
  $username = "challanghyahdb";
  $password = "Nw64F?DDv~oo";
  $database = "challanghyahdb";

  mysqli_connect($host,$username,$password,$database);
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
