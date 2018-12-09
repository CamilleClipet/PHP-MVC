<?php

if(!isset($_SESSION)) { session_start();}

if ($_SESSION['id'] == null)
{
  header('Location: localhost:8888/?url=UsersController/indexlogin');
  exit();
}

$id = $_SESSION['id'];

if ($_SESSION['group'] == 2)
{
  $back =  '<a href="?url=ArticlesController/allArticles"><button type="button" class="btn btn-dark"> Back to all articles </button> </a>';
} else
{
  $back = "";
}


 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="stylesheet" type"text/css" href="../../Webroot/styles.css">
     <title>See Single Article</title>
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

     <?php echo $data['data'];?>
      <?= $back ?>
    </div>
   </body>
 </html>
