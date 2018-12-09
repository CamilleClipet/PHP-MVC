<?php
include_once '../Config/core.php';
include_once 'AppController.php';

if(!isset($_SESSION))
{
  session_start();
}

class UsersController extends AppController
{
  private $_user;

  public function __construct()
  {
    $this->_user = $this->loadModel('User');
  }

  public function checkForm()
  {
    $alert = "";
    if ($_POST != null) {
      $verif = ($_POST['username'] != null && $_POST['password'] != null && $_POST['password_confirm'] != null && $_POST['email'] != null);
      if ($verif)
      {
        if ($this->_user->checkUserTaken($_POST['username'], $_POST['email']) == -1)
        {
          if ($_POST['password'] == $_POST['password_confirm'])
          {
            if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['email']) == 1) {

              $this->_user->createUser($_POST['username'], $_POST['password'], $_POST['email']);
              header('Location: ?url=UsersController/indexlogin');
              exit();
            }
            else{
              $alert .= '<div class="alert alert-danger" role="alert">
              Not a valid email address</br>
              </div>';
            }

          } else {
            $alert .= '<div class="alert alert-danger" role="alert">
            Password and password confirmation are different<br>
            </div>';
          }
        } else {
          $alert .= '<div class="alert alert-danger" role="alert">
          User or Email already exists, please chose something else<br>
          </div>';
        }
      } else
      {
        $alert .= '<div class="alert alert-danger" role="alert">
        Please fill all the fields<br>
        </div>';
      }
    }
    return $alert;
  }

  public function checkLogin()
  {
    //if (isset($_POST))
    if ($_POST != null)
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      if ($_POST['username'] != null && $_POST['password'] != null)
      {
        $data = $this->_user->login($_POST['username'], $_POST['password']);
        //var_dump($data);
        if ($data != FALSE)
        {
          $email = $data->email;
          $pass_hashed = $data->password;
          $name = $data->username;
          $id = $data->id;
          $group = $data->usergroup;
          $status = $data->status;
          if ($status == 1)
          {

            echo '<div class="alert alert-danger" role="alert">
          Sorry, you are banned for now
          </div>';
            return;
          }
          if (password_verify($_POST['password'], $pass_hashed) == true) {
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $name;
            $_SESSION["id"] = $id;
            $_SESSION["group"] = $group;
            $_SESSION["status"] = $status;
            //$this->redirect(["UsersController", "index"]);
            header('Location: ?url=ArticlesController/allArticles');
            exit();
          } else {
            echo '<div class="alert alert-danger" role="alert">
          Incorrect email/password
          </div>';
          }
        } else {
          echo '<div class="alert alert-danger" role="alert">
          Incorrect email/password
          </div>';
        }
      }
    }
  }

  public function index()
  {
    //var_dump($_POST);
    if (isset($_SESSION['id']) == NULL)
    {
      $data = $this->checkForm();
      $this->render('Users/signinForm', ['data'=> $data]);
    } else if ($_SESSION['group'] == 2)
    {
      $data = $this->checkForm();
      $this->render('Users/signinAdminForm',['data'=> $data]);
    }
  }

  public function indexlogin()
  {
    //var_dump($_POST);
    $this->render('Users/loginForm');
    $this->checkLogin();
  }

  public function showUsers()
  {
    $users = "";
    $result = $this->_user->readAllUsers();
    //var_dump($result);
    foreach($result as $data)
    {
      switch ($data['usergroup']) {
        case 0:
        $userType = 'Reader';
        break;
        case 1:
        $userType = 'Writer';
        break;
        case 2:
        $userType = 'Admin';
        break;
      }

      switch ($data['status']) {
        case 0:
        $userStatus = 'Authorized user';
        break;
        case 1:
        $userStatus = 'Banned user';
        break;
      }

      // $users .= '<div id="user">
      // <p>Username : '.$data['username'].'</p>
      // <p>E-Mail : '.$data['email'].'</p>
      // <p>'.$userType.'</p>
      // <p>'.$userStatus.'</p>
      // <a href="?url=UsersController/singleUser/'.$data['id'].' "> See </a></br>
      // </div>';
      $users .= '<div class="card" style="width: 28rem;">
      <div class="card-body">
      <h5 class="card-title">'.$data['username'].'</h5>
      <h6 class="card-subtitle mb-2 text-muted">'.$data['email'].'</h6>
      <p class="card-text">'.$userType.'</br>
      '.$userStatus.'</p>
      <a href="?url=UsersController/singleUser/'.$data['id'].' "> See </a>
      </div>
      </div>
      <p></p>';
    }
    return $users;
  }

  public function showSingleUser($id)
  {
    $data = $this->_user->readUser($id);
    switch ($data['usergroup']) {
      case 0:
      $userType = 'Reader';
      break;
      case 1:
      $userType = 'Writer';
      break;
      case 2:
      $userType = 'Admin';
      break;
    }

    // $user = '<div id="user">
    // <p>Username : '.$data['username'].'</p>
    // <p>E-Mail : '.$data['email'].'</p>
    // <p>Type of user : '.$userType.'</p>
    // <p><a href="?url=UsersController/deleteUser/'.$data['id'].'" onclick="return confirm(\'Are you sure you want to delete this user ?\');"> Delete </a> <a href="?url=UsersController/editionUser/'.$data['id'].'"> Edit </a></br>
    // </p>
    // </div>';
    $user = '<div class="card" style="width: 28rem;">
    <div class="card-body">
    <h5 class="card-title">'.$data['username'].'</h5>
    <h6 class="card-subtitle mb-2 text-muted">'.$data['email'].'</h6>
    <p class="card-text">'.$userType.'</br>
    '.$userStatus.'</p>
    <a href="?url=UsersController/editionUser/'.$data['id'].'"> Edit </a>
    <a href="?url=UsersController/deleteUser/'.$data['id'].'" onclick="return confirm(\'Are you sure you want to delete this user ?\');"> Delete </a>
    </div>
    </div>
    <p></p>';
    return $user;
  }

  public function editUser($id)
  {
    $data = $this->_user->readUser($id);
    if ($_POST != null)
    {
      $verif = ($_POST['username'] != null && $_POST['email'] != null);
      if ($verif != null)
      {
        //var_dump($data);
        if (password_verify($_POST['old_password'], $data['password']))
        {
          if ($_POST['new_password'] != '' && $_POST['new_password'] == $_POST['new_password_confirm'])
          {
            $this->_user->updateUser($id, $_POST['username'], $_POST['email'], $_POST['new_password']);
          } else if ($_POST['new_password'] == '' && $_POST['new_password_confirm'] == '')
          {
            $this->_user->updateUser($id, $_POST['username'], $_POST['email']);
          }
          header('Location: ?url=UsersController/singleUser/'.$id);
          exit();
        } else if ($_SESSION['group'] == 2)
        {
          $this->_user->updateUser($id, $_POST['username'], $_POST['email'], '', $_POST['group'], $_POST['status']);
          header('Location: ?url=UsersController/allUsers');
          exit();
        } else
        {
          echo "you don't have the rights to edit this user";
        }
      } else
      {
        echo "the username and email are required";
      }
    }
  }

  public function allUsers()
  {
    $data = $this->showUsers();
    $this->render('Users/seeUsers',['data'=> $data]);
  }

  public function singleUser($id)
  {
    $data = $this->showSingleUser($id);
    $this->render('Users/seeSingleUser',['data'=> $data]);
  }

  public function dashboard($id)
  {
    $data = $this->_user->readUser($id);
    $articles = new ArticlesController;
    $data2 = $articles->showArticlesbyAuthor($id);
    $this->render('Users/dashboard',['user'=> $data, 'articles' => $data2]);
  }

  public function editionUser($id)
  {
    $data = $this->_user->readUser($id);
    if ($data['id'] == $_SESSION['id'] && $_SESSION['group'] == 2)
    {
      $this->render('Users/editAdminforAdmin',['data'=> $data]);
    }
    else if ($data['id'] == $_SESSION['id'])
    {
      $this->render('Users/editUserforUser',['data'=> $data]);
    } else if ($_SESSION['group'] == 2)
    {
      $this->render('Users/editUserforAdmin',['data'=> $data]);
    } else
    {
      echo "you don't have the rights to edit this user";
      return;
    }
    $this->editUser($id);
  }


  public function deleteUser($id)
  {
    $this->_user->deleteUser($id);
    if ($_SESSION['group']== 2)
    {
      $this->allUsers();
    } else {
      $this->logout();
    }

  }

  public function logout()
  {
    session_start();
    session_unset();
    header('Location: ?url=UsersController/indexlogin');
    exit();
  }
}
//pour afficher la vue de signinform le dispatcher appelle la methode render de UserController avec le parametre Users/signinForm
?>
