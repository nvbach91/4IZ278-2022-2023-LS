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
          $category_id = $featured['category_id'];
          $category_query = "SELECT * FROM categories WHERE id=$category_id";
          $category_result = mysqli_query($db, $category_query);
          $category = mysqli_fetch_assoc($category_result);
          $category_title = $category['title'];
        ?>
        <a href="category-posts.php?id=<?= $category['id']?>" class="category_button"><?= $category['title'] ?></a>
        <h2 class="post_title"><a href="post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
        <p class="post_text">
          <?= substr ($featured['body'],0,200) ?>
        </p>
        <div class="post_info">
          <div class="post_author_avatar">
            <img src="./images/avatar.jpg">
          </div>
          <div class="post_autor_details">
            <?php 
            $author_id = $featured['author_id'];
            $author_query = "SELECT * FROM users WHERE id=$author_id";
            $author_result = mysqli_query($db, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            ?>
            <h5>By: <?= "{$author['first_name']} {$author['last_name']}" ?></h5>
            <small> <?= date("M, d, Y", strtotime($featured['date_time'])) ?> </small>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif ?>

  <!--posts-->
 
  <section class="posts">
    <div class="container posts_container">
      <article class="post">
        <div class="post_thumbnail">
          <img src="./images/thumbnail2.jpg">
        </div>
        <div class="post_body">
          <a href="category-posts.php" class="category_button">Lifehacks</a>
          <h3 class="post_title">
            <a href="post.php">How to run away from guars in less then 5 minutes?</a>
          </h3>
          <p class="post_text">
            Hiding in the hay, jumping from roof to roof and lots of other helpful advices from your one and only.
          </p>
          <div class="post_info">
            <div class="post_author_avatar">
              <img src="./images/avatar6.jpg">
            </div>
            <div class="post_autor_details">
              <h5>By: Ezio Auditore da Firenze</h5>
              <small> April 25, 2023 - 04:04</small>
            </div>
          </div>
        </div>
      </article>

      <article class="post">
        <div class="post_thumbnail">
          <img src="./images/thumbnail3.jpg">
        </div>
        <div class="post_body">
          <a href="" class="category_button">Help</a>
          <h3 class="post_title">
            <a href="post.php">Where to buy a new controller?</a>
          </h3>
          <p class="post_text">
            The combat is just as fluid as your tears will be
          </p>
          <div class="post_info">
            <div class="post_author_avatar">
              <img src="./images/avatar3.jpg">
            </div>
            <div class="post_autor_details">
              <h5>By: Dark Souls Enjoyer</h5>
              <small> March 13, 2023 - 13:13</small>
            </div>
          </div>
        </div>
      </article>

      <article class="post">
        <div class="post_thumbnail">
          <img src="./images/thumbnail4.jpg">
        </div>
        <div class="post_body">
          <a href="" class="category_button">Diary</a>
          <h3 class="post_title">
            <a href="post.php">Why did I think this was a good idea?</a>
          </h3>
          <p class="post_text">
            As a journalist I often find myself at places no other man will go to. And I do usually enjoy it... but this time I really made the wrong choice.
          </p>
          <div class="post_info">
            <div class="post_author_avatar">
              <img src="./images/avatar4.jpg">
            </div>
            <div class="post_autor_details">
              <h5>By: Miles Upsur</h5>
              <small> June 09, 2023 - 06:09</small>
            </div>
          </div>
        </div>
      </article>

      <article class="post">
        <div class="post_thumbnail">
          <img src="./images/thumbnail5.jpg">
        </div>
        <div class="post_body">
          <a href="" class="category_button">Lifehacks</a>
          <h3 class="post_title">
            <a href="post.php">There is no one who loves pain itself</a>
          </h3>
          <p class="post_text">
            In semper dignissim augue, eleifend pretium dolor porta sit amet. Aenean non posuere leo. Nam sagittis eleifend nibh, nec convallis urna aliquet euismod. Donec pharetra iaculis neque id viverra. Quisque pretium, ante id consequat condimentum, diam erat aliquet nibh, sit amet feugiat purus dui sit amet eros. 
          </p>
          <div class="post_info">
            <div class="post_author_avatar">
              <img src="./images/avatar5.jpg">
            </div>
            <div class="post_autor_details">
              <h5>By: White</h5>
              <small> January 07, 2023 - 07:07</small>
            </div>
          </div>
        </div>
      </article>

      <article class="post">
        <div class="post_thumbnail">
          <img src="./images/thumbnail7.jpg">
        </div>
        <div class="post_body">
          <a href="" class="category_button">Help</a>
          <h3 class="post_title">
            <a href="post.php">Who seeks after it and wants to have it</a>
          </h3>
          <p class="post_text">
            Phasellus vel libero condimentum, finibus orci vitae, iaculis velit. Sed accumsan vehicula arcu ut tempor. Ut in pharetra ligula. Quisque vestibulum ac est a fermentum. Quisque eleifend a lacus a ornare. Curabitur at odio dolor. Sed dapibus nunc vehicula metus tincidunt, vitae mattis risus ultricies. Nam maximus vitae eros quis sollicitudin. 
          </p>
          <div class="post_info">
            <div class="post_author_avatar">
              <img src="./images/avatar.jpg">
            </div>
            <div class="post_autor_details">
              <h5>By: Brown</h5>
              <small> February 10, 2023 - 02:03</small>
            </div>
          </div>
        </div>
      </article>

      <article class="post">
        <div class="post_thumbnail">
          <img src="./images/thumbnail6.jpg">
        </div>
        <div class="post_body">
          <a href="" class="category_button">Diary</a>
          <h3 class="post_title">
            <a href="post.php">Simply because it is pain</a>
          </h3>
          <p class="post_text">
            Suspendisse potenti. Maecenas porta lacus vitae blandit finibus. In consectetur vel tellus et convallis. Suspendisse malesuada lectus sed tellus dictum sagittis. Cras nec lectus euismod, interdum leo non, sollicitudin arcu. Nam posuere, purus id auctor egestas, tellus nunc maximus odio, in finibus tellus sem a lorem. In hac habitasse platea dictumst. 
          </p>
          <div class="post_info">
            <div class="post_author_avatar">
              <img src="./images/avatar2.jpg">
            </div>
            <div class="post_autor_details">
              <h5>By: Green</h5>
              <small> July 30, 2023, 03:23</small>
            </div>
          </div>
        </div>
      </article>
    </div>
  </section>

  <!--categories-->
  <section class="category-buttons">
    <div class="container category-buttons_container">
      <a href="" class="category_button">Category 1</a>
      <a href="" class="category_button">Category 2</a>
      <a href="" class="category_button">Category 3</a>
    </div>
  </section>

<?php include 'elements/footer.php' ?>