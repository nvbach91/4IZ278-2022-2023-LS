<?php 
include './elements/header.php';

$featured_query = "SELECT * FROM posts WHERE is_featured = 1";
$featured_result = mysqli_query($db, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);
?>
  <!--featured post-->
  <?php if (mysqli_num_rows($featured_result) == 1): ?>
  <section class="featured">
    <div class="container featured_container">
      <div class="post_thumbnail">
        <img src="./images/<?=$featured['thumbnail']?>">
      </div>
      <div class="post_body">
        <?php 
            $categories_buttons = generateCategories($db, $featured);
            echo $categories_buttons;?>
        <h2 class="post_title"><a href="post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
        <p class="post_text">
          <?= substr ($featured['body'],0,200) ?>
        </p>
        <div class="post_info">
        <?php
            $post_info = generatePostInfo($db, $featured);
            echo $post_info;
            ?>
        </div>
      </div>
    </div>
  </section>
  <?php endif ?>

  <!--posts-->
 
  <section class="posts">
    <div class="container posts_container">
      <?php $query = "SELECT * FROM posts ORDER BY title";
            $posts = mysqli_query($db, $query);
            while($post = mysqli_fetch_assoc($posts)): 
            ?>
      <article class="post">
        <div class="post_thumbnail">
          <img src="./images/<?=$post['thumbnail']?>">
        </div>
        <div class="post_body">
        <?php 
            $categories_buttons = generateCategories($db, $featured);
            echo $categories_buttons;
        ?>
        <h2 class="post_title">
          <h3 class="post_title">
          <a href="post.php?id=<?= $post['id'] ?>"><?=$post['title']?></a>
          </h3>
          <p class="post_text">
           <?= substr ($post['body'],0,200) ?>
          </p>
          <div class="post_info">
            <?php
            $post_info = generatePostInfo($db, $post);
            echo $post_info;
            ?>
        </div>
        </div>
      </article>
      <?php endwhile ?>
    </div>
  </section>

  

<?php 
  function generateCategories($db, $post) {
      $output = '';
  
      $postId = $post['id'];
      $linkQuery = "SELECT * FROM posts_categories WHERE post_id = $postId";
      $links = mysqli_query($db, $linkQuery);
  
      while ($link = mysqli_fetch_assoc($links)) {
          $categoryId = $link['category_id'];
          $categoryQuery = "SELECT * FROM categories WHERE id=$categoryId";
          $categoryResult = mysqli_query($db, $categoryQuery);
          $category = mysqli_fetch_assoc($categoryResult);
          $categoryTitle = $category['title'];
  
          $output .= '<a href="category-posts.php?id=' . $category['id'] . '" class="category_button">' . $category['title'] . '</a>';
      }
  
      return $output;
  }

  function generatePostInfo($db, $post) {
    $output = '';

    $authorId = $post['author_id'];
    $authorQuery = "SELECT * FROM users WHERE id=$authorId";
    $authorResult = mysqli_query($db, $authorQuery);
    $author = mysqli_fetch_assoc($authorResult);

    $output .= '<div class="post_author_avatar">';
    $output .= '<img src="./images/' . $author['avatar'] . '">';
    $output .= '</div>';
    $output .= '<div class="post_autor_details">';
    $output .= '<h5>By: ' . $author['first_name'] . ' ' . $author['last_name'] . '</h5>';
    $output .= '<small>' . date("M, d, Y", strtotime($post['date_time'])) . '</small>';
    $output .= '</div>';

    return $output;
  }

include 'elements/categories.php';
include 'elements/footer.php' ?>