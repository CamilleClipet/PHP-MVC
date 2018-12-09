<?php

if(!isset($_SESSION)) { session_start();}

if ($_SESSION['id'] == null)
{
  header('Location: localhost:8888/?url=UsersController/indexlogin');
  exit();
}

$id = $_SESSION['id'];


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>See Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type"text/css" href="../../Webroot/styles.css">
</head>
  <body background="https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg" style="background-attachment:fixed;">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Blog</a>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" href="?url=ArticlesController/allArticles">Home <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link" href="?url=UsersController/dashboard/<?= $id?>">Dashboard</a>
          <a class="nav-item nav-link" href="?url=UsersController/logout">Logout</a>
        </div>
      </div>
      <a class="nav-item nav-link inline-block" href="?url=ArticlesController/goSearch">Search</a>
    </nav>

    <div class="container">

      <form class="" action="" method="post">
          <div class="form-group">
       <label for="exampleInputEmail1"><span class="textinwhite">Username</span></label>
       <input type="test" name="username" class="form-control"  value='<?= $data['data']['username'] ?>'>
        </div>

        <div class="form-group">
     <label for="exampleInputEmail1"><span class="textinwhite">Email</span></label>
     <input type="test" name="email" class="form-control"  value='<?= $data['data']['email'] ?>'>
      </div>

        <div class="form-group">
     <label for="exampleInputPassword1"><span class="textinwhite">New password</span></label>
     <input type="password" name="new_password"class="form-control" id="exampleInputPassword1">
      </div>

        <div class="form-group">
        <label for="exampleInputPassword1"><span class="textinwhite">Confirm password</span></label>
        <input type="password" name="new_password_confirm"class="form-control" id="exampleInputPassword1">
        </div>

        <div class="form-group">
        <label for="exampleInputPassword1"><span class="textinwhite">Current password : </span></label>
        <input type="password" name="old_password"class="form-control" id="exampleInputPassword1">
        </div>
      <button type="submit" class="btn btn-dark" name="submit_form">Submit</button>
    </form>

  </div>
  </body>

</html>
