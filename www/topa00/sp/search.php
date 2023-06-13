<?php 
require 'elements/header.php';

if(isset($_GET['search']) && isset($_GET['go'])) {
  $search = filter_var($_GET['search'], FILTER_SANITIZE_SPECIAL_CHARS);
  $query = "SELECT * FROM posts WHERE title LIKE '%$search%'";
  $posts = mysqli_query($db, $query);
} else {
  header('location: blog.php');
  die();
}
?>

<section class="posts">
<div class="container posts_container">
  <?php while($post = mysqli_fetch_assoc($posts)):?>
  <article class="post">
    <div class="post_thumbnail">
      <img src="./images/<?=$post['thumbnail']?>">
    </div>
    <div class="post_body">
    <?php
          $categories_buttons = generateCategories($db, $post);
          ?>
      <h3 class="post_title">
      <a href="post.php?id=<?= $post['id'] ?>"><?=$post['title']?></a>
      </h3>
      <p class="post_text">
       <?= substr ($post['body'],0,200) ?>
      </p>
      <div class="post_info">
      <?php
            $post_info = generatePostInfo($db, $post);
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
      echo $output;
  }

  echo $output;
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

    echo $output;
  }
include 'elements/categories.php';
include 'elements/footer.php' ?>