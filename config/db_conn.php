<?php     
    // connect to database
    $conn = mysqli_connect('localhost', 'accoutn_name', 'account_password', 'database_name');

    // on connection error
    if(!$conn) {
      echo 'Connection error' . mysqli_connect_error();
    }
 ?>