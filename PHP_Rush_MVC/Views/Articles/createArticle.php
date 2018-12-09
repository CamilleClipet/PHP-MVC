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
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="stylesheet" type"text/css" href="../../Webroot/styles.css">
     <title>Login</title>
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

  <!--   <div class="container">
     <form class="" action="" method="post">
       Title :  <input type="text" name="title" placeholder="Title here..."></input><br>
       Content :  </br><textarea rows="15" cols="90" placeholder="Content here..." name="content"></textarea>
     </br><button type="submit" name="submit_form">Submit</button>
     </form>
   </div> -->

   <div class="container textinwhite">
     <h3>Write an article</h3>
    <form class="" action="" method="post">
       <label for="exampleFormControlTextarea1">Title :</label>
      <input class="form-control" type="text" name="title" placeholder="Title..."><br>
      </br><div class="form-group">
   <label for="exampleFormControlTextarea1">Content : </label>
   <textarea class="form-control" placeholder="Content here..." name="content" id="exampleFormControlTextarea1" rows="15" cols="90"></textarea>
 </div>
    </br><button type="submit" name="submit_form" class="btn btn-dark">Submit</button>
    </form>
     </div>
   </body>
 </html>
