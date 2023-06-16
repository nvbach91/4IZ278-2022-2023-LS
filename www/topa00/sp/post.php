  <?php include 'elements/header.php';

  //getting data
  $post_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $_SESSION['post_id'] = $post_id;
  $query = "SELECT * FROM posts WHERE id=$post_id";
  $post = getData($db,$query);

  $query = "SELECT COUNT(*) AS likes FROM ratings WHERE post_id = $post_id AND rating_status = '1'";
  $likesCount = getData($db,$query)['likes'];

  $query = "SELECT COUNT(*) AS dislikes FROM ratings WHERE post_id = $post_id AND rating_status = '-1'";
  $dislikesCount = getData($db,$query)['dislikes'];

  //checking if user had already set a rating for the post
  if (isset($_SESSION['user_id'])):
  $user_id = $_SESSION['user_id'];
  $query = "SELECT rating_status FROM ratings WHERE post_id = $post_id AND user_id = $user_id";
  $status_result = $db->prepare($query);
  $status_result->execute();
  $num_rows = $status_result->rowCount();
  //the $status will then be used to make the chosen rating more visible
  if ($num_rows > 0) {
    $status = $status_result->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $status = 0;
  } endif;
  ?> 

  
  <section class="single-post">
    <div class="container single-post_container">      
      <h2><?=$post['title']?></h2>
      <div class="post_info">
        <?php generatePostInfo($db,$post) ?>  
      </div>
      <div class="single-post_thumbnail">
        <img src="./images/<?=$post['thumbnail']?>">
      </div>
      <p class="post_text">
        <?=$post['body'] ?>
      </p> 
      <div class="post_action">
      <?php if(isset($_SESSION['user_id'])) : { ?>        
          <td>
            <!--adding like and dislike "buttons". Changes in like/dislike counts shows only after reload-->            
            <a id="likeButton" href="#" class="button like <?php if ($status == '1') echo "selected";?>">
            <img src="./images/like.png"> <?=$likesCount?>
            </a>            
          </td>

          <td>
            <a id="dislikeButton" href="#" class="button dislike <?php if ($status == '-1') echo "selected";?>">
            <img src="./images/dislike.png"><?=$dislikesCount?>
            </a>
          </td>
          <?php if ($_SESSION['user_id'] == $post['author_id'] || isset($_SESSION['user_is_admin'])) : {?>
            <td><a href="./admin/edit-post.php?id=<?= $post['id'] ?>" class="button edit">Edit</a></td>
          <?php } endif;
          } else :{ ?>
            <td>
            <!--adding like and dislike "buttons". Changes in like/dislike counts shows only after reload-->            
            <a class="button like">
            <img src="./images/like.png"> <?=$likesCount?>
            </a>            
          </td>

          <td>
            <a class="button dislike">
            <img src="./images/like.png"> <?=$likesCount?>
            </a>  
          </td> 
        <?php } endif; ?>
        <h5>Last modified: <?= date("M, d, Y H:i", strtotime($post['last_modified']))?></h5>
      </div>      
    </div>
  </section>

  <script>
  //adding listeners and logic for like/dislike "buttons"
  document.getElementById("likeButton").addEventListener("click", function(event) {
  event.preventDefault();
  likeFunction();
  });

  document.getElementById("dislikeButton").addEventListener("click", function(event) {
  event.preventDefault();
  dislikeFunction();
  });

  function likeFunction() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "rating-logic.php?post_id=<?=$post_id?>&user_id=<?=$user_id?>&status=<?=$status?>&type=like", true);
    xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      console.log(xhr.status);
      console.log(xhr.responseText);
    }};
    xhr.send();
  }

  function dislikeFunction() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "rating-logic.php?post_id=<?=$post_id?>&user_id=<?=$user_id?>&status=<?=$status?>&type=dislike", true);
    xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      console.log(xhr.status);
      console.log(xhr.responseText);
    }};
    xhr.send();
  }
  </script>

  <section class="comments">
    <div class="container comments_container">
      <h2>Comments</h2>
      <?php if (isset($_SESSION['user_id'])): ?>
      <div class="new_comment">
        <a href="add-comment.php" class="button">Add new comment</a>
      </div> <?php endif;?>
      <?php 
        $query = "SELECT * FROM comments WHERE post_id = $post_id AND parent_id IS NULL";
        $getData = $db->prepare($query);
        $getData->execute();
        $comments = $getData->fetchAll(PDO::FETCH_ASSOC);
        foreach ($comments as $comment) :
          ?>
          <div class="comment">
          <?php generateComment($db,$comment); ?>
          </div>
        <?php
          $post_id = $comment['post_id'];
          $comment_id = $comment['id'];

        $query = "SELECT * FROM comments WHERE post_id = $post_id AND parent_id = $comment_id";
        $getData = $db->prepare($query);
        $getData->execute();
        $comments = $getData->fetchAll(PDO::FETCH_ASSOC);

        foreach ($comments as $comment): ?>
          <div class="comment comment-reply-inline">
          <?php generateComment($db,$comment); ?>
          </div>
        <?php
        endforeach;  
        endforeach; 
      ?>
    </div>
  </section>

  
<?php 
  function getData($db,$query) {
    $getData = $db->prepare($query);
    $getData->execute();
    $result = $getData->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function generatePostInfo($db, $post) {
    $output = '';

    $authorId = $post['author_id'];
    $authorQuery = "SELECT * FROM users WHERE id=$authorId";
    $author = getData($db,$authorQuery);

    $output .= '<div class="post_author_avatar">';
    $output .= '<img src="./images/' . $author['avatar'] . '">';
    $output .= '</div>';
    $output .= '<div class="post_autor_details">';
    $output .= '<h5>By: ' . $author['first_name'] . ' ' . $author['last_name'] . '</h5>';
    $output .= '<small>' . date("M, d, Y", strtotime($post['date_time'])) . '</small>';
    $output .= '</div>';

    echo $output;
  }

  function generateComment($db,$comment) {
    $output = '';
    
    $output .= '<div class="comment">';

    $output .= '<div class="author-info">';
    $output .= generatePostInfo($db,$comment);
    $output.= '</div>';

    $output .= '<p class="comment-text">';
    $output .= $comment['comment'];
    $output .= '</p>';

    if (isset($_SESSION['user_id'])) {
    $output .= '</div>'; 
    $output .= '<div class="comment-reply">';
    $output .= '  <a href="add-comment.php?id=' . $comment['id'] . 'class = "button">Reply</a>';
    $output .= '</div>';
    } else $output .= '</div>';
    echo $output;
  }

  include 'elements/footer.php' 
?>