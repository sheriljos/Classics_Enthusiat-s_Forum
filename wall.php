<?php
session_start();
require_once('connection.php');
?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Success</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
      body {
              background-image: url("prides.jpg");
              background-repeat: repeat;
              background-color: #cccccc;
            }
    </style>
  </head>
  <body>
    <div class="container">

      <!-- Here begins the navbar -->
        <nav class="navbar navbar-inverse bg-inverse">
          <div class="welcome-wall">
          <h4>Welcome <?php echo $_SESSION['first_name'] ?></h4>
        </div>
        <div class="title-wall">
          <h1>Classics  Enthusiats's F.O.R.U.M</h1>
        </div>
        <div class="logout-wall">
          <a href="process.php">Log Out</a>
        </div>
        </nav>


    <!-- The post submission starts here -->
    <div class="form-group">
      <form action="process.php" method="post">
        <input type="hidden" name="post" value="post">
        <label for="textarea1" class="share-mind">Share your favourite classic quote here:</label>
        <textarea class="form-control" rows="5" name="content"></textarea>
        <br/>
        <button type="submit" class="btn">Share</button>
      </form>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>


    <!-- Selecting all posts from the database -->
    <?php
      $query = "SELECT * FROM users
    			     LEFT JOIN messages
    			     ON messages.users_id=users.id
    			     ORDER BY messages.created_at DESC";
      $results = fetch($query);


      // Displaying all the posts
      foreach ($results as $value) {
        if(strlen($value['message'])!=0)
          {
      ?>
      <div class="alert alert-success"id="post-alert">
        <strong><?php echo $value['first_name'] ;?></strong>
      <?php
        echo "<br/>";
        echo $value['message'];
        echo "<br/>";
      ?>
      </div>

      <!-- Let us collapse -->
      <button type="button" id="coll-button" class="btn btn-warning" data-toggle="collapse" data-target="#demo">Comment about this post </button>
      <div id="demo" class="collapse">


      <!-- Add Comments -->
      <div id="comment">
        <form action="process.php" method="post">
          <input type="hidden" name="comment" value="comment">
          <input type="hidden" name="post_id" value=<?= $value['id'] ?>>
          <label for="textarea1" class="comment">Comment on it:</label>
          <textarea class="form-control" rows="5" name="comment_content"></textarea>
          <br/>
          <button type="submit" class="btn">Comment</button>
        </form>
      </div>


      <!-- The comment display -->
      <?php
      $print_comments="SELECT * FROM users
                      LEFT JOIN messages
                      ON messages.users_id=users.id
                      LEFT JOIN comments
                      ON comments.messages_id=messages.id
                      WHERE messages.id={$value['id']}";
      $comments_results=fetch($print_comments);

      foreach ($comments_results as $each_comment)
       {
        if(isset($each_comment['comment']))
          {

       // <!-- Find the name of comment poster -->

      $get_name_query="SELECT * FROM users
               WHERE users.id={$each_comment['users_id']}";
       $get_name=fetch($get_name_query);

       foreach ($get_name as $get_name_result)
       {
         $commented_by=$get_name_result['first_name']." ".$get_name_result['last_name'];
       }
      ?>

       <div class="alert alert-warning"id="post-alert">
             <?php echo $each_comment['comment'];
             echo $commented_by;
             ?>
       </div>
      <?php
          }
      }

      ?>

 </div>
 <!-- collapse div -->

    <?php
      }
      }
    ?>


<!-- ................................................................................       -->
    </div>
  </body>
</html>
