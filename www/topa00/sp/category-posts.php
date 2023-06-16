<?php include 'elements/header.php';
$id = $_GET['id'];
$query = "SELECT * FROM categories WHERE id=$id";
$category_result = $db->prepare($query);
$category_result->execute();
$category = $category_result->fetch(PDO::FETCH_ASSOC); ?>
  <!--category-title-->
  <header class="category-title">
    <h2><?=$category['title']?></h2>
    <h5><?=$category['description']?></h5>
  </header>

  <!--posts-->
  <section class="posts">
    <div class="container posts_container">
      <?php $posts_id_query = "SELECT * FROM posts_categories WHERE category_id=$id";
            $posts_id_result = $db->prepare($posts_id_query);
            $posts_id_result->execute();
            $posts_id = $posts_id_result->fetchAll(PDO::FETCH_ASSOC);
            foreach($posts_id as $post_id): 
              $id = $post_id['post_id'];
              $posts_query = "SELECT * FROM posts WHERE id=$id";
              $posts_result = $db->prepare($posts_query);
              $posts_result->execute();
              $posts = $posts_result->fetchAll(PDO::FETCH_ASSOC);
              foreach($posts as $post): 
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
            $author_result = $db->prepare($author_query);
            $author_result->execute();
            $author = $author_result->fetch(PDO::FETCH_ASSOC);
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
      <?php endforeach;
      endforeach;?>
    </div>
  </section>

  <?php include 'elements/categories.php';
include 'elements/footer.php' ?>