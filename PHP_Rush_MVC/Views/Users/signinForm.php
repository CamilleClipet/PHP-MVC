<?php

if(!isset($_SESSION)) { session_start();}

if (isset($_SESSION['id']) != null)
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
           <a class="nav-item nav-link" href="?url=UsersController/indexlogin">Already registered? Sign in</a>
         </div>
       </div>
     </nav>

     <div class="container">

     <form class="" action="" method="post">
       <div class="form-group">
    <label for="exampleInputEmail1"><span class="textinwhite">Username</span></label>
    <input type="test" name="username" class="form-control" id="exampleInputEmail1" placeholder="Between 3 and 10 characters">

  </div>
       <div class="form-group">
    <label for="exampleInputPassword1"><span class="textinwhite">Email</span></label>
    <input type="text" name="email"class="form-control" id="exampleInputPassword1" placeholder="johndoe@example.com">
  </div>
       <div class="form-group">
    <label for="exampleInputPassword1"><span class="textinwhite">Password</span></label>
    <input type="password" name="password"class="form-control" id="exampleInputPassword1" placeholder="Between 8 and 20 characters">
  </div>
       <div class="form-group">
    <label for="exampleInputPassword1"><span class="textinwhite">Confirm password</span></label>
    <input type="password" name="password_confirm"class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
  </div>
       <button type="submit" class="btn btn-dark">Submit</button></br>
       <?= $data['data']?>
     </form>

      </div>
   </body>
 </html>
