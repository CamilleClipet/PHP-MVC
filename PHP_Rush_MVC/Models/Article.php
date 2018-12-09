<?php
include_once '../Config/core.php';

class Article
{

  private $_pdo;

  public function __construct()
  {
    $connexion = Database::getInstance();
    $this->_pdo = $connexion->getConnection();
  }

  // 0 : non banni
  public function createArticle ($title, $content, $id_author)
  {
    $db = $this->_pdo;
    $query = 'INSERT INTO articles (title, content, id_author, creation_date) VALUES ("'.$title.'", "'.$content.'", "'.$id_author.'", NOW())';
    $rep = $db->prepare($query);
    $rep->execute();
  }

  public function readAllArticles()
  {
    $db = $this->_pdo;
    $query = ("SELECT a.id AS article_id, title, content, a.creation_date, a.edition_date, id_author, username FROM articles a INNER JOIN users u ON a.id_author = u.id ORDER BY a.creation_date DESC");
    $rep = $db->prepare($query);
    $rep->execute();
    $arr = $rep->fetchall(PDO::FETCH_ASSOC);
    if (count($arr) > 0) {
      return $arr;
    } else {
      return -1;
    }
  }

  public function readAllArticlesbyAuthor($author)
  {
    $db = $this->_pdo;
    //$query = ("SELECT * FROM articles WHERE id_author = '{$author}' ORDER BY creation_date DESC");
    $query = ("SELECT a.id AS article_id, title, content, a.creation_date, a.edition_date, id_author, username FROM articles a INNER JOIN users u ON a.id_author = u.id WHERE id_author = '{$author}' ORDER BY a.creation_date DESC");

    $rep = $db->prepare($query);
    $rep->execute();
    $arr = $rep->fetchall(PDO::FETCH_ASSOC);
    if (count($arr) > 0) {
      return $arr;
    } else {
      return -1;
    }
  }

  public function readArticle($id)
  {
    $db = $this->_pdo;
    //$query = "SELECT * FROM articles WHERE id=".$id;
    $query = ("SELECT a.id AS article_id, title, content, a.creation_date, a.edition_date, id_author, username FROM articles a INNER JOIN users u ON a.id_author = u.id WHERE a.id = '{$id}' ORDER BY a.creation_date DESC");
    $rep = $db->prepare($query);
    $rep->execute();
    $d = $rep->fetch(PDO::FETCH_ASSOC);
    if ($d != null) {
      return($d);
    } else {
        return -1;
    }
  }

  public function editArticle($title = '', $content = '', $id)
  {
    $db = $this->_pdo;
    $query = "UPDATE articles SET title = '".$title."', content = '".$content."', edition_date = NOW() WHERE id =".$id;
    $rep = $db->prepare($query);
    $rep->execute();
  }

  public function deleteArticle($id)
  {
    $db = $this->_pdo;
    $query = 'DELETE FROM articles WHERE id='.$id;
    $rep = $db->prepare($query);
    $rep->execute();
  }

  public function do_search($word, $date_min , $date_max , $order = "creation_date ASC")
  {
    if ($date_min == NULL && $date_max == NULL && $word == NULL)
    {
      //$query = ("SELECT * FROM articles ORDER by ".$order."");
      $query = ("SELECT a.id AS article_id, title, content, a.creation_date, a.edition_date, id_author, username FROM articles a INNER JOIN users u ON a.id_author = u.id ORDER by ".$order."");
    } else if ($date_min == NULL && $date_max == NULL)
    {
      //$query = ("SELECT * FROM articles WHERE title LIKE '%".$word."%' ORDER by ".$order."");
      $query = ("SELECT a.id AS article_id, title, content, a.creation_date, a.edition_date, id_author, username FROM articles a INNER JOIN users u ON a.id_author = u.id WHERE title LIKE '%".$word."%' ORDER by ".$order."");
    } else if ($date_min == -1 && $date_max != -1)
    {
      // echo "Search $word, date before date_max";
      //$query = ("SELECT * FROM articles WHERE title LIKE '%".$word."%' AND creation_date <= '{$date_max}' ORDER by ".$order."");
      $query = ("SELECT a.id AS article_id, title, content, a.creation_date, a.edition_date, id_author, username FROM articles a INNER JOIN users u ON a.id_author = u.id WHERE title LIKE '%".$word."%' AND a.creation_date <= '{$date_max}' ORDER by ".$order."");

    } else if ($date_min != -1 && $date_max == -1)
    {
      // echo "Search $word, date after date_min";
      //$query = ("SELECT * FROM articles WHERE title LIKE '%".$word."%' AND creation_date >= '{$date_min}' ORDER by ".$order."");
      $query = ("SELECT a.id AS article_id, title, content, a.creation_date, a.edition_date, id_author, username FROM articles a INNER JOIN users u ON a.id_author = u.id WHERE title LIKE '%".$word."%' AND a.creation_date >= '{$date_min}' ORDER by ".$order."");
    } else
     {
       //$query = ("SELECT * FROM articles WHERE title LIKE '%".$word."%' AND creation_date >= '{$date_min}' AND creation_date <= '{$date_max}' ORDER by ".$order."");
       $query = ("SELECT a.id AS article_id, title, content, a.creation_date, a.edition_date, id_author, username FROM articles a INNER JOIN users u ON a.id_author = u.id WHERE title LIKE '%".$word."%' AND a.creation_date >= '{$date_min}' AND a.creation_date <= '{$date_max}' ORDER by ".$order."");
     }

      $rep = $this->_pdo->prepare($query);
      $rep->execute();
      $arr = $rep->fetchall(PDO::FETCH_ASSOC);
      return $arr;
  }


}



 ?>
