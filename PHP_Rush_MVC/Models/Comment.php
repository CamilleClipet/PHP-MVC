<?php
include_once '../Config/core.php';

class Comment
{

  private $_pdo;

  public function __construct()
  {
    $connexion = Database::getInstance();
    $this->_pdo = $connexion->getConnection();
  }

  // 0 : non banni
  public function createComment ($comment, $id_user, $id_article)
  {
    $db = $this->_pdo;
    $query = 'INSERT INTO comments (comment, id_user, creation_date, id_article) VALUES ("'.$comment.'", "'.$id_user.'", NOW(), "'.$id_article.'")';
    $rep = $db->prepare($query);
    $rep->execute();

  }

  public function readComments($article)
  {
    $db = $this->_pdo;
    //$query = ("SELECT * FROM comments WHERE id_article = '{$article}' ORDER BY creation_date ASC");
    $query = "SELECT c.id AS comment_id, comment, id_user, c.creation_date, u.id AS user_id, username FROM comments c INNER JOIN users u ON c.id_user = u.id WHERE id_article = '{$article}' ORDER BY creation_date ASC";
    $rep = $db->prepare($query);
    $rep->execute();

    $arr = $rep->fetchall(PDO::FETCH_ASSOC);
    if (count($arr) > 0) {
      return $arr;
    } else {
      return -1;
    }
  }


  public function deleteComment($id)
  {
    $db = $this->_pdo;
    $query = 'DELETE FROM comments WHERE id='.$id;
    $rep = $db->prepare($query);
    $rep->execute();
  }

  public function deleteCommentsbyArticle($article_id)
  {
    $db = $this->_pdo;
    $query = 'DELETE FROM comments WHERE id_article='.$article_id;
    $rep = $db->prepare($query);
    $rep->execute();
  }

}





 ?>
