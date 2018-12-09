<?php
include_once '../Config/core.php';
include_once 'AppController.php';

if(!isset($_SESSION))
    {
        session_start();
    }

class ArticlesController extends AppController
{
  private $_article;
  private $_comment;

  public function __construct()
  {
    $this->_article = $this->loadModel('Article');
    $this->_comment = $this->loadModel('Comment');
  }
  // public function index()
  // {
  //   $this->render('Articles/action');
  // }
  public function checkForm()
  {
    $alert = "";
    if ($_POST != null)
    {
      if ($_POST['title'] != '' && $_POST['content'] != '')
      {
        $this->_article->createArticle($_POST['title'],$_POST['content'],$_SESSION['id']);
        //AppController::redirect('ArticlesController/allArticles');
         header('Location: /?url=ArticlesController/allArticles');
        exit();
      } else
      {
        //echo "please fill all the fields";
        $alert = "please fill all the fields";
      }
    }
    return $alert;
  }

  public function deleteArticle($id)
  {
      $this->_article->deleteArticle($id);
      $this->_comment->deleteCommentsbyArticle($id);
      $this->allArticles();
  }

  public function showArticles()
  {
    $articles = '';
    $edition = "";
    $result = $this->_article->readAllArticles();
    //var_dump($result);
    foreach($result as $data)
    {
      if ($data['edition_date'] != null) {
        $ed_date = date("d-m-Y", strtotime($data['edition_date']));
        $edition = "Edited on ".$ed_date;
      }
      $date = date("d-m-Y", strtotime($data['creation_date']));
      $articles .= '<div id="article">
                    <h2>'.$data['title'].'</h2>
                    <p>By: '.$data['username'].'</p>
                    <p> '.$date.'</p>
                    <p>'.$data['content'].'</p>
                    <p>'.$edition.'</p>
        <p><a href="?url=ArticlesController/singleArticle/'.$data['article_id'].' "> Read </a></p>
                    </div>';
    }
    return $articles;
  }

  public function showArticlesbyAuthor($id)
  {
    $articles = '';
    $result = $this->_article->readAllArticlesbyAuthor($id);
    //var_dump($result);
    foreach($result as $data)
    {
      $articles .= '<div id="article">
                    <h2>'.$data['title'].'</h2>
                    <p>'.$data['content'].'</p>
                    <p>
          <a href="?url=ArticlesController/singleArticle/'.$data['id'].' "> Read </a></p>
                    </div>';
    }
    return $articles;
  }

  public function showSingleArticle($id)
  {
    //var_dump($_SESSION);
      $list = "";
      $article = "";
      $data = $this->_article->readArticle($id);
      $comments = $this->_comment->readComments($id);
      //var_dump($comments);
      if ($comments != NULL)
      {
        foreach($comments as $comment)
        {
          if ($_SESSION['group'] == 2 || $_SESSION['id'] == $data['id_author'])
          {
            $delete = '<a href="?url=ArticlesController/deleteComment/'.$comment['comment_id'].'/'.$data['article_id'].'">Delete</a>';
          }
          $list .= '<div id="comment">
                        '.$comment['username'].':
                        "'.$comment['comment'].'" on
                        '.$comment['creation_date']. '
                        '.$delete.'
                        </div>';
        }
        if ($data['edition_date'] != null) {
          $edition = "Edited on ".$data['edition_date'];
        }
        $article = '<div id="article">
                      <h2>'.$data['title'].'</h2>
                      <p>By: '.$data['username'].'</p>
                      <p> '.$data['creation_date'].'</p>
                      <p>'.$data['content'].'</p>
                      <p>'.$edition.'</p>
                      '.$list.'
                      <p> </p>
                      <form class="" action="?url=ArticlesController/postComment/'.$data['article_id'].'" method="post">
                      <input type="text" name="comment" placeholder="Leave a comment...">
                      <button type="submit" name="submit_comment">Post</button> </form></br>';

                      if($_SESSION['group'] == 2 || $_SESSION['id'] == $data['id_author']){
                        $article .= '<p><a href="?url=ArticlesController/deleteArticle/'.$data['article_id'].'" onclick="return confirm(\'Are you sure you want to delete this article?\');"> Delete </a> <a href="?url=ArticlesController/editionArticle/'.$data['article_id'].'"> Edit </a></br>
                      </p>
                        </div>';
                      }

        return $article;
      }

  }

  public function postComment($article_id)
  {
    if ($_POST != null)
    {
      if ($_POST['comment'] != NULL)
      {
        $this->_comment->createComment($_POST['comment'], $_SESSION['id'], $article_id);
        header("Location: ?url=ArticlesController/singleArticle/".$article_id);
        exit();
      } else
      {
        header("Location: ?url=ArticlesController/singleArticle/".$article_id);
        exit();
      }
    }
  }

  public function deleteComment($comment_id, $article_id)
  {
    $this->_comment->deleteComment($comment_id);
    header("Location: ?url=ArticlesController/singleArticle/".$article_id);
    exit();
  }


  public function editionArticle($id)
  {
      $alert = "";
      $redirect = "no";
      if(isset($_POST['title']))
      {
        if ($_POST['title'] != NULL && $_POST['content'] != NULL)
        {
          $this->_article->editArticle($_POST['title'], $_POST['content'], $id);
          $redirect = "yes";
        } else
        {
          $alert = "Please fill all the fields";
        }
      }
      $data = $this->_article->readArticle($id);
      $this->render('Articles/editArticle',['data' => $data, 'alert' => $alert]);
      if ($redirect == "yes")
      {
        header("Location: ?url=ArticlesController/seeSingleArticle/".$data['article_id']);
        exit();
      }
  }

  public function search()
  {
    if($_POST != NULL)
    {
      $word = $_POST['searchword'];
      $date_min = $_POST['StartDate'];
      $date_max = $_POST['EndDate'];
      if ($date_min != NULL) {
        $date_min .= " 23:59:59";
      }
      if ($date_max != NULL) {
        $date_max .= " 23:59:59";
      }
      $result = $this->_article->do_search($word, $date_min, $date_max, $order = "creation_date ASC");
      $articles = "";
      $edition = "";
      //var_dump($result);
      if ($result != NULL)
      {
        foreach($result as $data)
        {
          if ($data['edition_date'] != null) {
            $ed_date = date("d-m-Y", strtotime($data['edition_date']));
            $edition = "Edited on ".$ed_date;
          }
          $date = date("d-m-Y", strtotime($data['creation_date']));
          $articles .= '<div id="article">
                        <h2>'.$data['title'].'</h2>
                        <p>By: '.$data['username'].'</p>
                        <p> '.$date.'</p>
                        <p>'.$data['content'].'</p>
                        <p>'.$edition.'</p>
            <p><a href="?url=ArticlesController/singleArticle/'.$data['article_id'].' "> Read </a></p>
                        </div>';
        }
      }

    }
    $this->render('Search/search_result',['data'=> $articles]);
  }

  public function index()
  {
    $this->render('Articles/createArticle');
    $this->checkForm();
  }

  public function allArticles()
  {
    $data = $this->showArticles();
    $this->render('Articles/seeArticles',['data'=> $data]);
  }

  public function singleArticle($id)
  {
    $data = $this->showSingleArticle($id);
    $this->render('Articles/seeSingleArticle',['data'=> $data]);
  }

  public function goSearch()
  {
    $this->render('Search/search_form');
  }



}

 ?>
