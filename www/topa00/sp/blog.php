<?php include 'elements/header.php'
?>
  <!--search-->
  <section class="search-bar">
    <form class="container search-bar_container" action="search.php" method="GET">
      <div>
        <img src="./images/search.png">
        <input type="search" name="search" placeholder="Search">
      </div>
      <button type="submit" name="go" class="button">Go</button>
    </form>
  </section>

  <section class="posts">
    <div class="container posts_container">
      <?php $query = "SELECT * FROM posts ORDER BY title";
            $posts_result = $db->prepare( $query);
            $posts_result->execute();
            $posts = $posts_result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($posts as $post): 
            ?>
      <article class="post">
        <div class="post_thumbnail">
          <img src="./images/<?=$post['thumbnail']?>">
        </div>
        <div class="post_body">
        <?php 
            $categories_buttons = generateCategories($db, $post);
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
      <?php endforeach ?>
    </div>
  </section>

<?php 
function generateCategories($db, $post) {
  $output = '';

  $post_id = $post['id'];
  $link_query = "SELECT * FROM posts_categories WHERE post_id = $post_id";
  $result = $db->prepare($link_query);
  $result->execute();
  $links = $result->fetchAll(PDO::FETCH_ASSOC);

  foreach ($links as $link) {
      $category_id = $link['category_id'];
      $category_query = "SELECT * FROM categories WHERE id=$category_id";
      $category_result = $db->prepare($category_query);
      $category_result->execute();
      $category = $category_result->fetch(PDO::FETCH_ASSOC);

      $output .= '<a href="category-posts.php?id=' . $category['id'] . '" class="category_button">' . $category['title'] . '</a>';
  }

  return $output;
}

function generatePostInfo($db, $post) {
$output = '';

$authorId = $post['author_id'];
$authorQuery = "SELECT * FROM users WHERE id=$authorId";
$result = $db->prepare($authorQuery);
$result->execute();
$author = $result->fetch(PDO::FETCH_ASSOC);

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