  <?php include 'elements/header.php';

  $id = $_GET['id'];
  $query = "SELECT * FROM posts WHERE id=$id";
  $post_result = mysqli_query($db, $query);
  $post = mysqli_fetch_assoc($post_result);
  $post_id = $post['id'];
  $user_id = $_SESSION['user_id'];
  
  $likesCount = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(*) AS likes FROM ratings WHERE post_id = $post_id AND status = '1'"))['likes'];
  
  $dislikesCount = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(*) AS dislikes FROM ratings WHERE post_id = $post_id AND status = '-1'"))['dislikes'];

  $status = mysqli_query($db,"SELECT status FROM ratings WHERE post_id = $post_id AND user_id = $user_id");
  if (mysqli_num_rows($status) > 0) {
    $status = mysqli_fetch_assoc($status)['status'];
  } else {
    $status = 0;
  }
  ?> 

  
  <section class="single-post">
    <div class="container single-post_container">      
      <h2><?=$post['title']?></h2>
      <div class="post_info">
      <?php 
            $author_id = $post['author_id'];
            $author_query = "SELECT * FROM users WHERE id=$author_id";
            $author_result = mysqli_query($db, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            ?>
          <div class="post_author_avatar">
            <img src="./images/<?=$author['avatar']?>">
          </div>
          <div class="post_author_details">
            <h5>By: <?= "{$author['first_name']} {$author['last_name']}" ?></h5>
            <small> <?= date("M, d, Y", strtotime($post['date_time'])) ?> </small>
          </div>          
      </div>
      <div class="single-post_thumbnail">
        <img src="./images/<?=$post['thumbnail']?>">
      </div>
      <p class="post_text">
        <?=$post['body'] ?>
      </p> 
      <?php if(isset($_SESSION['user_id'])) : { ?>
        <div class="post_action">
          <td>            
            <a class="button like <?php if ($status == '1') echo "selected";?>">
            <img src="./images/like.png"> <?=$likesCount?>
            </a>
          </td>

          <td>
            <a class="button dislike <?php if ($status == '-1') echo "selected";?>">
            <img src="./images/dislike.png"><?=$dislikesCount?>
            </a>
          </td>
          
          <?php if ($_SESSION['user_id'] == $post['author_id'] || $_SESSION['user_is_admin']) : {?>
            <td><a href="./admin/edit-post.php?id=<?= $post['id'] ?>" class="button edit">Edit</a></td>
          <?php } endif; ?>          
        </div>
      <?php } endif; ?>     
    </div>
  </section>

  <section class="comments">
  </section>
<?php include 'elements/footer.php' ?>