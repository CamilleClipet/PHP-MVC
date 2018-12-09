<?php

if(!isset($_SESSION)) { session_start();}

if ($_SESSION['id'] != null)
{
  $id = $_SESSION['id'];
}


 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <link rel="stylesheet" type"text/css" href="../../Webroot/styles.css">
     <title>Sign In Form</title>
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
     </nav>

     <div class="container">

     <!--<form class="" action="" method="post">
       Username <input type="text" name="username" value="" minlength="3" maxlength="10"></input><br>
       Email <input type="text" name="email" value=""></input><br>
       Password <input type="password" name="password" value="" minlength="8" maxlength="20"></input><br>
       Confirm Password <input type="password" name="password_confirm" value="" minlength="8" maxlength="20"></input><br>
       <button type="submit" name="submit_form">Submit</button></br>
       <?= $data['data']?>
     </form>-->

     <div class="container textinwhite">

     <form class="" action="" method="post">
       <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="test" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username" minlength="3" maxlength="10">

  </div>
       <div class="form-group">
    <label for="exampleInputPassword1">E-Mail</label>
    <input type="text" name="email"class="form-control" id="exampleInputPassword1" placeholder="E-Mail">
  </div>
       <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password"class="form-control" id="exampleInputPassword1" placeholder="Password" minlength="8" maxlength="20">
  </div>
       <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" name="password_confirm"class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
  </div>
       <button type="submit" class="btn btn-dark">Submit</button></br>
       <?= $data['data']?>
     </form>

      </div>

   </body>
 </html>
