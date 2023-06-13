<?php include 'elements/header.php';
$id = $_GET['id'];
$query = "SELECT * FROM categories WHERE id=$id";
$category_result = mysqli_query($db, $query);
$category = mysqli_fetch_assoc($category_result); ?>?>
  <!--category-title-->
  <header class="category-title">
    <h2><?=$category['title']?></h2>
  </header>

  <!--posts-->
  <section class="posts">
    <div class="container posts_container">
      <?php $query = "SELECT * FROM posts WHERE category_id=$id";
            $posts = mysqli_query($db, $query);
            while($post = mysqli_fetch_assoc($posts)): 
            ?>
      <article class="post">
        <div class="post_thumbnail">
          <img src="./images/<?=$post['thumbnail']?>">
        </div>
        <div class="post_body">
          <h3 class="post_title">
          <a href="post.php?id=<?= $post['id'] ?>"><?=$post['title']?></a>
          </h3>
          <p class="post_text">
           <?= substr ($post['body'],0,200) ?>
          </p>
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
          <div class="post_autor_details">
            <h5>By: <?= "{$author['first_name']} {$author['last_name']}" ?></h5>
            <small> <?= date("M, d, Y", strtotime($post['date_time'])) ?> </small>
          </div>
        </div>
        </div>
      </article>
      <?php endwhile ?>
    </div>
  </section>

  <?php include 'elements/categories.php';
include 'elements/footer.php' ?>