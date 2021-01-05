<?php 
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $invalid = false;

    // connect to database
    require 'config/db_conn.php';

    $sql_statement = "SELECT u.user_id, u.email, u.password FROM appuser u WHERE u.email='$email'";
    $result = mysqli_query($conn, $sql_statement);
    $rows_array = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $encrypted_password = md5($password);

    if (count($rows_array) != 1 || $rows_array[0]['password'] != $encrypted_password) {
      $invalid = true;
      echo "Invalid email or password!";
    }
    else {
      // // redirect user to page
      // header('Location: http://localhost/login/home.php?');
      // echo "something";
      echo $rows_array[0]['user_id'];
    }
  }
    // print_r($rows_array);
?>