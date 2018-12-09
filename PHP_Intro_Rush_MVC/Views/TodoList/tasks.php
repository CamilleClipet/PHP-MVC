<?php

include_once "/Users/camilleclipet/Documents/Epitech/MVC/PHP_Intro_Rush_MVC/Controllers/TodoList/tasksController.php";

$task = new TaskController;

#send the form
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $result = $task->check_input();
  if ($result == -1) {
    $alert = "Please fill all fields<br>";
  }
}

#delete User
if (isset($_GET["delete"])) {
  $id = $_GET["delete"];
  $task->delete_task($id);
}


$data = $task->check_get_tasks();
$string = "";
$alert = "";

#view of the list
foreach ($data as $key => $value) {
  $string .= '<li> Titre: "'.$value["title"].'"  Description : "'.$value["description"].'" <a href="tasks.php?delete='.$value["id"].'" onclick="return confirm(\'Are you sure you want to delete this item?\');">Delete</a> <a href="task.php?edit='.$value["id"].'">Edit</a> </li>';
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
  <?php echo $alert ;?>
<form action="tasks.php" method="POST">
    <br>
   Title <input type="text"  name="title"><br><br>
   Description <br> <textarea name="description"  cols="30" rows="10"></textarea>
   <br>
   <button type="submit" name="submit" >Submit</button>
   </form>

      <?php echo $string ; ?>
</body>
</html>
