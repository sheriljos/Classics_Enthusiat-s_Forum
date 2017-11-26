<?php
session_start();
require_once('connection.php');
//$_POST is an array which holds the input deatils var_dump($_POST) and see
// Routing to different controllers

if(isset($_POST['register']) && $_POST['register']=='register')
  {
        register_user($_POST);
  }
if(isset($_POST['login']) && $_POST['login'] == 'login')
  {
    login_user($_POST);
  }
if(isset($_POST['post']) && $_POST['post']=='post')
  {
    submit_post($_POST);
  }
if(isset($_POST['comment']) && $_POST['comment'] == 'comment')
  {
    submit_comment($_POST);
  }
else
  {
  session_destroy();
  header('Location:index.php');
  }

//Register function
function register_user($post)
  {
    $_SESSION['errors'] = array();
    if(strlen($post['first_name']) < 3)
      {
        $_SESSION['errors'][] = "Please insert your first name properly";
      }
    if(strlen($post['last_name']) < 3)
      {
        array_push($_SESSION['errors'],"Please insert your last name properly");
      }
    if(strlen($post['pass']) < 6)
      {
        $_SESSION['errors'][] = "Your password has to be at least 6 characters.";
      }
    if($post['pass'] != $post['confirm_pass'])
      {
        $_SESSION['errors'][] = "Password doesn't match";
      }
    if(!filter_var($post['email'],FILTER_VALIDATE_EMAIL))
      {
        $_SESSION['errors'][] =  "The email doesn't look right";
      }
    if(count($_SESSION['errors'])!= 0){
      header('Location: index.php');
      exit();
    }
   else{
     $query = "INSERT INTO users (first_name, last_name, email, password)
              VALUES ('{$post['first_name']}', '{$post['last_name']}', '{$post['email']}', '{$post['pass']}')";

    run_mysql_query($query);
    $_SESSION['regSuccess'] = "You have successfully registered. Please login.";
    header('Location:index.php');
     exit();
   }
  }

  //Login function
  function login_user($post)
    {
      $_SESSION['login_error'] = array();

      $query = "SELECT * FROM mywall.users
      WHERE users.email='{$_POST['email']}' AND users.password = '{$_POST['pass']}'";

      $user = fetch($query);

      if(count($user)>0)
        {
          $_SESSION['user_id'] = $user[0]['id'];
          $_SESSION['first_name'] = $user[0]['first_name'];
          $_SESSION['logged_in']= TRUE;
          header('Location:success.php');
          exit();
        }
        else
        {
          $_SESSION['login_error'][] = "Email or Password is incorrect. Please try again";
          header('Location:index.php');
          exit();
        }
    }

    //post your favourite quote function
    function submit_post($post)
      {
        $query = "INSERT INTO messages(message, users_id)
        VALUES('{$post['content']}', {$_SESSION['user_id']})";
        run_mysql_query($query);
        header('Location:wall.php');
        exit();
      }

      //post your comment function
      function submit_comment($post)
        {
          $query = "INSERT INTO comments (comment, users_id, messages_id)
                    VALUES ('{$post['comment_content']}', '{$_SESSION['user_id']}', '{$post['post_id']}')";
          run_mysql_query($query);
          header('Location:wall.php');
          exit();
        }
?>
