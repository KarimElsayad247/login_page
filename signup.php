<!-- 
    If there are errors, redirect back to signup page.
    signup page shoul take care to display errors received,
    as well as keeping field inputs the same before submittin
 -->
 

<!-- 
    Upon receiving a request, must validate email at server side
    to make sure it doesn't exist. 
    If all goes well, redirect to home.php
 -->
<?php 
    // initialize emtpy string for form entries    
    $inputs = [
        'email'=>'',
        'name'=>'',
        'password'=>'',
        'confirm_password'=>''
    ];


    // flag to handle duplicate email entries (user with email already exists)
    $email_exists = false;


    if (isset($_POST['submit'])) {

        // connect to database.
        // connection is $conn
        require 'config/db_conn.php';

        $inputs = [
            'email'=>$_POST['email'],
            'name'=>$_POST['name'],
            'password'=>$_POST['password'],
            'confirm_password'=>$_POST['confirm_password']
        ];


        $email_to_check = $inputs['email'];

        // fetch emails from database
        $sql_statement = "SELECT u.email FROM appuser u  WHERE u.email='$email_to_check'";
        $result = mysqli_query($conn, $sql_statement);
        $rows_array = mysqli_fetch_all($result, MYSQLI_ASSOC);



        // check resulting array for email
        // if exists, set error flag to true
        if (count($rows_array) > 0) {
          $email_exists = true;
        }

        // if not exist, create new user
        if (!$email_exists) {


          // echo $inputs["email"] . $inputs["name"] . $encrypted_password;

          // construct arguments
          $arg_email = mysqli_real_escape_string($conn, $inputs['email']);
          $arg_name =  mysqli_real_escape_string($conn, $inputs['name']);

          // encrypt password using md5
          $encrypted_password = md5($inputs["password"]);
 
          // insert into database
          $sql_statement = "INSERT INTO appuser(email, name, password, registration_date) VALUES('$arg_email', '$arg_name', '$encrypted_password', CURRENT_TIMESTAMP)";

          // redirect on successful insertion
          if (mysqli_query($conn, $sql_statement)) {


          $id = mysqli_insert_id($conn);

            header('Location: home.php?id=' . $id);
          } else {
              echo 'Connection error' . mysqli_error($conn);
          }
        }

        // close connection
        mysqli_free_result($result);
        mysqli_close($conn);

    }
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Login page</title>
    <link rel='stylesheet' type='text/css' href='styles/style.css'>
    <script src="scripts/validation.js"></script>

</head>

<body class="align">

  <div class="grid">

    <div id="signup" class="dataentry-form">

      <h2>Sign up!</h2>
      <div id="form-container">
      <form name="signup" action="signup.php" method="POST" onSubmit="return signupFormValidation();">

        <fieldset>

          <p class="form-label"><label for="name">Name</label>
          <p><input type="text" id="name" class="focusable-textbox input-box" name="name" 
          placeholder="name" value="<?php echo $inputs['name']?>" required ></p>

          <p class="form-label"><label for="email">E-mail address</label></p>
          <p><input type="text" id="email" class="focusable-textbox input-box" name="email" 
          placeholder="user@domain.tld" value="<?php echo $inputs['email']?>" required></p>

          <p class="form-label"><label for="password">Password</label></p>
          <p><input type="password" class="password focusable-textbox input-box" name="password" id="password" placeholder="password" required></p>

          <p class="form-label"><label for="confirm_password">Confirm Password</label></p>
          <p><input type="password" class="password focusable-textbox input-box" id="confirm_password" name="confirm_password" placeholder="password" required></p>

          <p id="feedback-text">
            <?php if ($email_exists) {echo "Email already exists!"; } ?>
          </p>

          <div class="buttons-row">
            <p><input class="hoverable" type="submit" name="submit" value="Sign up!"></p>
          </div>

        </fieldset>

      </form>
      <form  action="index.php"> 
        <p><input class="generic-button hoverable" type="submit" value="Back"></p>
      </form>
    </div>

    </div> <!-- end login -->

  </div>

 </body> 

</html>