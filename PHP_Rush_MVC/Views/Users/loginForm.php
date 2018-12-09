<?php

if(!isset($_SESSION)) { session_start();}


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
       <a class="nav-item nav-link" href="?url=UsersController/index">Not registered? Sign up</a>
     </div>
   </div>
 </nav>

 <div class="container">

    <h3 class="textinwhite">Welcome. Please sign in</h3>

   <form method="post">
    <div class="form-group">
      <label for="exampleInputEmail1"><span class="textinwhite">Username</span></label>
      <input type="test" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1"><span class="textinwhite">Password</span></label>
      <input type="password" name="password"class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-dark">Submit</button>
  </form>
</div>
</body>

</html>
