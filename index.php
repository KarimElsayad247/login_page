<!-- 
Frontend Based on template https://codepen.io/marcobiedermann/pen/qahmr?editors=0100
 -->


<!DOCTYPE html>
<html>
  <head>
    <title>Login page</title>
    <link rel='stylesheet' type='text/css' href='styles/style.css'>
    <script src="scripts/jquery.js"></script>
    <script src="scripts/validation.js"></script>
</head>

<body class="align">

  <div class="grid">

    <div id="login" class="dataentry-form">

      <h2>Log In</h2>
      <div id="form-container">
        <form name="login" action="login.php" method="POST" onSubmit="return loginFormValidation();">

          <fieldset>

            <p class="form-label"><label for="email">E-mail address</label></p>
            <p><input type="text" id="email" class="focusable-textbox input-box" name="email" placeholder="mail@address.com" required></p>

            <p class="form-label"><label for="password">Password</label></p>
            <p><input type="password" id="password" class="focusable-textbox input-box" name="password" placeholder="password" required></p>
            
            <p id="feedback-text"></p>
            
            <div class="buttons-row">
              <p><input type="button" class="generic-button hoverable" value="Log In"
               onClick="return loginFormValidation();"></p>
            </div>

          </fieldset>
        </form>

        <form  action="signup.php"> 
          <p><input class="generic-button hoverable" type="submit" value="Register" ></p>
        </form>
      </div>

    </div> <!-- end login -->

  </div>

 </body> 

</html>