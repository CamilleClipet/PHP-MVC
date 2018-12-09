<?php

if(!isset($_SESSION)) { session_start();}

if ($_SESSION['id'] == null)
{
  header('Location: localhost:8888/?url=UsersController/indexlogin');
  exit();
}

$id = $_SESSION['id'];
$strAdmin = "";
$strWriter = "";


if ($data['user']['usergroup'] == 0) {
  $userType = "Reader";
} else if ($data['user']['usergroup'] == 1) {
  $title = '<h2 class="textinwhite">My articles</h2>';
  $userType = "Writer";
  $strWriter = " <a href='?url=ArticlesController/index'><button type='button' class='btn btn-lg btn-dark'>Post an article</button></a>";
} else if ($data['user']['usergroup'] == 2) {
    $title = '<h2 class="textinwhite">My articles</h2>';
  $userType = "Admin";
  $strAdmin = "<a href='?url=ArticlesController/allArticles'><button type='button' class='btn btn-lg btn-dark'>All articles</button></a>
  <a href='?url=UsersController/allUsers'><button type='button' class='btn btn-lg btn-dark'>All users</button></a>
  <a href='?url=UsersController/index'><button type='button' class='btn btn-lg btn-dark'>Add a new user</button></a>";
  $strWriter = " <a href='?url=ArticlesController/index'><button type='button' class='btn btn-lg btn-dark'>Post an article</button></a><p></p>";
}

if ($data['articles'] == NULL && $data['user']['usergroup'] > 0)
{
  $data['articles'] = "You haven't written anything yet";
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type"text/css" href="../../Webroot/styles.css">
</head>
<body background="https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg" style="background-attachment:fixed;">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Blog</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link" href="?url=ArticlesController/allArticles">Home <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link active" href="?url=UsersController/dashboard/<?= $id?>">Dashboard</a>
        <a class="nav-item nav-link" href="?url=UsersController/logout">Logout</a>
      </div>
    </div>
    <a class="nav-item nav-link inline-block" href="?url=ArticlesController/goSearch">Search</a>
  </nav>

  <div class="container">
    <center>

  <div class="card " style="width: 28rem;">
  <div class="card-body">
    <h5 class="card-title"><?= $data['user']['username'] ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?= $data['user']['email'] ?></h6>
    <p class="card-text">Type of user : <?= $userType ?></p>
    <a href="?url=UsersController/editionUser/<?= $data['user']['id'] ?>" > Edit </a>
    <a href="?url=UsersController/deleteUser/<?= $data['user']['id']?>" onclick="return confirm('Are you sure you want to delete your account ?');"> Delete </a>
  </div>
</div>
<p></p>

  <div class="Actions">
    <?= $strAdmin ?>
    <?= $strWriter ?>
    <!--<a href="?url=UsersController/singleUser/<?= $id ?>">See my profile</a>-->
    <p></p>
  </div>
</center>

<?= $title ?>

  <div class="Articles">
    <?= $data['articles'] ?>
  </div>

</div>
</body>
</html>
