<?php
include_once "/Users/camilleclipet/Documents/Epitech/MVC/PHP_Intro_Rush_MVC/Models/Db.php";
include_once "/Users/camilleclipet/Documents/Epitech/MVC/PHP_Intro_Rush_MVC/Models/config.php";

class Database {

    private static $db;
    public $pdo;

    private function __construct() {
        $this->pdo = connect_db("localhost", CONFIG_USER, CONFIG_PASSWORD, CONFIG_PORT, "MVC");
    }

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->pdo;
    }
}

class ManageTask
{

    private $_db;

    public function __construct()
    {
        $this->_db = Database::getConnection();
    }

    public function post_task ($title, $description = null)
	{
        if ($title == null) {
            return -1;
        } else {
            $query = 'INSERT INTO tasks (title, description, creation_date) VALUES ("'.$title.'", "'.$description.'", NOW())';
            $rep = $this->_db->prepare($query);
            $rep->execute();
        }
	}

	public function get_tasks()
	{
        $query = ("SELECT * FROM tasks");
        $rep = $this->_db->prepare($query);
        $rep->execute();
		$arr = $rep->fetchall(PDO::FETCH_ASSOC);
		if (count($arr) > 0) {
            return $arr;
        } else {
            return -1;
        }
	}

	public function get_task($id)
	{
       	$res = array();
        $query = ("SELECT * FROM tasks WHERE id=".$id);
        $rep = $this->_db->prepare($query);
        //var_dump($rep);
        $rep->execute();
		while ($d = $rep->fetch(PDO::FETCH_ASSOC)) {
			array_push($res, $d);
		}
		if (count($res) > 0) {
            return($res);
        } else {
            return -1;
        }
	}

  public function delete_task($id)
  {
      $query = 'DELETE FROM tasks WHERE id='.$id;
      $rep = $this->_db->prepare($query);
      $rep->execute();
  }

	public function put_task($id, $title = null, $description = null)
	{
        if ($title != null && $description != null) {
        	$query = ('UPDATE tasks SET title = "'.$title.'", description = "'.$description.'" WHERE id='.$id);
        } else if ($title != null && $description == null) {
        	$query = ('UPDATE tasks SET title = "'.$title.'" WHERE id='.$id);
        } else if ($title == null && $description != null) {
        	$query = ('UPDATE tasks SET description = "'.$description.'" WHERE id='.$id);
        } else {
            return -1;
        }

        $rep = $this->_db->prepare($query);
        $rep->execute();

	}
}

//$manager = new ManageTask();

//$manager->post_task("task3", "do step 3");
//var_dump($manager->get_task("10"));
//var_dump($manager->get_tasks());

//$manager->put_task(3,"task3" , "do step 3d");

?>
