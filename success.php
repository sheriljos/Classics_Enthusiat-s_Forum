<?php
session_start();
require_once('connection.php');
?>

<html>
  <head>
    <title>Success</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
      body {
              background-image: url("shelves.jpg");
              background-repeat: repeat;
              background-color: #cccccc;
            }
    </style>
  </head>
  <body>
    <?php if($_SESSION['logged_in'])
      {
    ?>
    <div class="row">
      <div class="Red-block">

        <div class='welcome'>
          <h1 class="success-login">Succesful Login!</h1>
          <h3 class="welcome-login">Welcome <?php echo $_SESSION['first_name'] ?></h3>
        </div>

        <hr/>

        <div class="welcome">
          <a href="wall.php"><h3 class="go-to-form">Go to Classics's Forum</h4></a>
        </div>

        <hr/>

        <div class="welcome">
          <a href="process.php"><h4 class="logout-action">Log Out</h4></a>
        </div>

      </div>
    </div>

<?php }
  else{
    header('Location: process.php');
  }
?>

  </body>
</html>
