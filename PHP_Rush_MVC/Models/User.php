<?php
include_once '../Config/core.php';

class User
{

  private $_pdo;

  public function __construct()
  {
    $connexion = Database::getInstance();
    $this->_pdo = $connexion->getConnection();
  }

  // 0 : non banni
  public function createUser ($username, $password, $email)
  {
    $db = $this->_pdo;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = 'INSERT INTO users (username, password, email, creation_date) VALUES ("'.$username.'", "'.$password.'", "'.$email.'", NOW())';
    $rep = $db->prepare($query);
    $rep->execute();

  }

  public function readAllUsers()
  {
    $db = $this->_pdo;
    $query = ("SELECT * FROM users ORDER BY username ASC");
    $rep = $db->prepare($query);
    $rep->execute();

    $arr = $rep->fetchall(PDO::FETCH_ASSOC);
    if (count($arr) > 0) {
      return $arr;
    } else {
      return -1;
    }
  }

  public function readUser($id)
  {
    $db = $this->_pdo;
    $query = 'SELECT * FROM users WHERE id='.$id;
    $rep = $db->prepare($query);
    $rep->execute();

    $d = $rep->fetch(PDO::FETCH_ASSOC);
    if (count($d) > 0) {
      return($d);
    } else {
        return -1;
    }
  }

  public function updateUser($id, $username, $email, $password = '', $group = '', $status = '')
  {

    $db = $this->_pdo;
    if ($password != '')
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    if ($password == '' && $group == '' && $status == '')
    {
      $query = "UPDATE users SET username = '{$username}', email = '{$email}', edition_date = NOW() WHERE id=".$id;
    } else if ($password != '' && $group == '' && $status == '')
    {
      $query = "UPDATE users SET username = '{$username}', email = '{$email}', password = '{$password}', edition_date = NOW() WHERE id=".$id;
    } else if ($password == '' && $group != '' && $status != '')
    {
      $query = "UPDATE users SET username = '{$username}', email = '{$email}', usergroup = '{$group}', status = '{$status}', edition_date = NOW() WHERE id=".$id;
    } else if ($password == '' && $group != '' && $status == '')
    {
      $query = "UPDATE users SET username = '{$username}', email = '{$email}', usergroup='{$group}', edition_date = NOW() WHERE id=".$id;
    } else if ($password == '' && $group == '' && $status != '')
    {
      $query = "UPDATE users SET username = '{$username}', email = '{$email}', status = '{$status}', edition_date = NOW() WHERE id=".$id;
    }
    $rep = $db->prepare($query);
    $rep->execute();
  }

  public function deleteUser($id)
  {
    $db = $this->_pdo;
    $query = 'DELETE FROM users WHERE id='.$id;
    $rep = $db->prepare($query);
    $rep->execute();
  }

  public function login($username, $password)
  {
    $db = $this->_pdo;
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    //$query = 'SELECT * FROM users WHERE username="camille"';
    $result = $db->query($query);
	  $data = $result->fetch(PDO::FETCH_OBJ);
    //var_dump($data);
    return $data;
  }

  public function checkUserTaken($username, $email)
  {
    $db = $this->_pdo;
    $query = "SELECT * FROM users WHERE email='{$email}' OR username = '{$username}' ";
    $rep = $db->prepare($query);
    $rep->execute();
    $d = $rep->fetch(PDO::FETCH_ASSOC);
    if ($d != null) {
      return 0;
    } else {
      return -1;
    }

  }

}





 ?>
