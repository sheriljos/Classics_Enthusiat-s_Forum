<?php
session_start();
require_once('connection.php');
?>

<!-- The html starts here -->
<html>

  <head>
    <title>Welcome to the classics forum</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="container">

      <!-- Here begins the navbar -->
        <nav class="navbar navbar-inverse bg-inverse">
          <h1 class="welcome">Classics  Enthusiats's F.O.R.U.M</h1>
        </nav>


      <!-- Here is the image -->
      <img width="1140px"src="shelves.jpg">

      <!-- If error is present  -->
      <?php
      if(isset($_SESSION['errors']))
        {
          foreach($_SESSION['errors'] as $error)
          {
      ?>
            <div class="alert alert-danger" >
            <?php echo $error ."<br/>";?>
            </div>
      <?php
          }
          unset($_SESSION['errors']);
        }
      ?>

      <!-- If successfully registered -->
      <?php
      if(isset($_SESSION['regSuccess']))
        {
      ?>
        <div class="alert alert-success" >
        <?php echo $_SESSION['regSuccess']; ?>
        </div>
      <?php
        unset($_SESSION['regSuccess']);
        }
      ?>


      <!-- Registration Form -->
      <div class="RegisterContainer">
        <h3><span class="glyphicon glyphicon-user"></span> Register please </h3>
        <form action="process.php" method="post">
          <input type="hidden" name="register" value="register">

          <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" placeholder="Enter first name" name="first_name">
          </div>

          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" placeholder="Enter last name" name="last_name">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" placeholder="Password" name="pass">
          </div>

          <div class="form-group">
            <label for="password">Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm password" name="confirm_pass">
          </div>

          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" placeholder="Enter your email" name="email">
          </div>

          <button type="submit" class="btn btn-danger" id="register-button">Register</button>
        </form>
      </div>


      <!-- Login Form -->
      <div class="LoginContainer">
        <?php
          if(isset($_SESSION['login_error']))
            {
              foreach ($_SESSION['login_error'] as $value)
              {
        ?>
                <div class="alert alert-danger" >
                <?php echo $value; ?>
                </div>
        <?php
              }
            }
        ?>

        <h3><span class="glyphicon glyphicon-lock"></span> Login here </h3>
        <form action="process.php" method="post">
          <input type="hidden" name="login" value="login">

          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" placeholder="Enter email" name="email">
          </div>

          <div class="form-group">
            <label for="password_login">Password</label>
            <input type="password" class="form-control" placeholder="Password" name="pass">
          </div>

          <button type="submit" class="btn btn-danger" id="login-button">Login</button>
        </form>
      </div>

  </body>

</html>
