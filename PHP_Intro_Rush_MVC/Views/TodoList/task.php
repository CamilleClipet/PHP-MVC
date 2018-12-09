<?php

include_once "/Users/camilleclipet/Documents/Epitech/MVC/PHP_Intro_Rush_MVC/Controllers/TodoList/taskController.php";

$description  = "";
$title = "";

$task = new TaskController;

if (isset($_GET["edit"])) {
  $id = $_GET["edit"];
  $resultat = $task->check_get_task($id);
  $title = $resultat[0]["title"];
  $description = $resultat[0]["description"];
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $result = $task->update_task($id);
  if ($result == -1) {
    $alert = "Please make sure no field is empty<br>";
  }
}



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="" method="POST">
    <br>
   Title <input type="text"  name="new_title" value="<?php echo $title ;?>"><br><br>
   Description <br> <textarea name="new_description"  cols="30" rows="10" ><?php echo $description ;?></textarea>
   <br>
   <button type="submit" name="submit" >Submit</button> <a href="tasks.php">Back to list</a>
   </form>


</body>
</html>
