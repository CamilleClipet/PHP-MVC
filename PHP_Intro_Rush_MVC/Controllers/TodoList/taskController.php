<?php

include_once "/Users/camilleclipet/Documents/Epitech/MVC/PHP_Intro_Rush_MVC/Models/TodoList/Task.php";

class TaskController
{
	private $_manager;

	public function __construct()
	{
		$this->_manager = new ManageTask();
	}


	public function secure_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return($data);
	}


	public function check_get_task($id)
	{
		$task = $this->_manager->get_task($id);
		if ($task == -1) {
			return -1;
		}
		//var_dump($tasks);
		foreach($task as $key => $onetask) {
			$task[$key]["title"] = htmlspecialchars($onetask["title"]);
			$task[$key]["description"] = nl2br(htmlspecialchars($onetask["description"]));
		}
		//var_dump($tasks);
		return $task;
	}

	public function check_input()
	{
		if (isset($_POST["title"]) && $_POST["title"] != null) {
			$title = $this->secure_input($_POST["title"]);
			if ($_POST["description"]) {
				$description = $this->secure_input($_POST["description"]);
			}
		} else {
			return -1;
		}
		$this->_manager->post_task($title, $description);
		return 0;
	}

	public function delete_task($id)
	{
		$this->_manager->delete_task($id);
	}

	public function update_task($id)
	{
		if (isset($_POST["new_title"]) && $_POST["new_title"] != null) {
			$title = $this->secure_input($_POST["new_title"]);
			if ($_POST["new_description"]) {
				$description = $this->secure_input($_POST["new_description"]);
			}
		}
		$this->_manager->put_task($id, $title, $description);
	}

}


//$toto = new TaskController;
//$toto->check_get_tasks();
//$toto->checkid(3);



?>
