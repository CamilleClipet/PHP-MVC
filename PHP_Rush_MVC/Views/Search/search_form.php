<?php

if(!isset($_SESSION)) { session_start();}

if ($_SESSION['id'] == null)
{
  header('Location: localhost:8888/?url=UsersController/indexlogin');
  exit();
}



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
				</nav>

				<div class="container">
          <span class = "textinwhite"><h3>Search</h3></span>

		<form action="?url=ArticlesController/search" method="post">

      <div class="form-group">
        <label for="searchword"><span class="textinwhite"></span></label>
        <input type="word" name="searchword" class="form-control" id="exampleInputEmail1" placeholder="Search for a word in an article title">
      </div>

			<label for="date"><span class="textinwhite"><i>Refine search with dates</i></span></label></br>
			<span class="textinwhite">From </span> <input type="date" class = "datepicker" name = "StartDate" id="StartDate" placeholder = "Start Date" /> <span class="textinwhite">to </span>
      <input type="date" class = "datepicker" name = "EndDate" id="EndDate" placeholder = "End Date" /><br />
			<input name="order" type="hidden" value="name ASC">
      <p></p>
			<button type="submit" class="btn btn-dark">Submit</button>
		</form>

	</div>

	</body>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</html>
