<?php
include 'database.php'; 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            padding: 20px 50px;
            background-color: #f8f9fa;
            align-items: center;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 50px;
        }

        .product {
    width: 300px; 
    height: 300px; 
    margin: 10px;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 2px solid #3D3D3D; 
}



.product img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.product:hover img {
    transform: scale(1.1);
}

        
        .auth-buttons {
            display: flex;
            gap: 10px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
        .slider {
    width: 100%;
    height: 400px;
    position: relative;
    overflow: hidden;
}

.slider .slide {
    position: absolute;
    width: 100%;
    height: 100%;
    background-size: cover; 
    background-position: center; 
    transition: opacity 2s ease-in-out; 
    opacity: 0;
}

.slider .slide.active {
    opacity: 1;
}
footer img {
        width: 32px;
        height: 32px;
    }

    .footer-links {
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .footer-links a {
        margin: 0 10px;
        color: #000;
        text-decoration: none;
    }

    .footer-links a:hover {
        color: #007bff;
    }
    footer {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #ffffff; 
        }

h2.category-title {
            font-size: 2em;
            text-align: center;
        }

        
        .best-seller-title {
        font-size: 2em;
        text-align: center;
    }

    .best-seller {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px;
}

.product-bestseller {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 50px;
}

.product-image-round {
    width: 300px;
    height: auto;
    border-radius: 10px;
}

.product-description {
    margin-left: 80px;
}

.product-description h3 {
    font-size: 1.5em;
    margin-bottom: 0.5em;
}

.product-description p {
    font-size: 1.2em;
}
.product-bestseller img {
  border-radius: 10px;
}
.line-divider {
  width: 100%;
  height: 1px;
  background-color: #3D3D3D;
  margin-top: 20px; 
  margin-bottom: 20px; 
}





    </style>
</head>
<body>

<header>
    <h1>Welcome to My E-Shop</h1>
    <div class="auth-buttons">
        <a href="register.html"><button>Register</button></a>
        <a href="login.html"><button>Login</button></a>
    </div>
</header>

<div class="slider" id="slider">
    <div class="slide active" style="background-image: url('slider/slider.jpg');"></div>
    <div class="slide" style="background-image: url('slider/slider2.jpg');"></div>
    <div class="slide" style="background-image: url('slider/slider3.jpg');"></div>
</div>

<h2 class="category-title">Choose a Category:</h2>
<div class="products">
    <?php
   $categoriesImages = [
    'iPhone' => 'images/apple_category.png',
    'Samsung' => 'images/samsung_category.avif',
    'Huawei' => 'images/android_category.png',
];


    try {
        $stmt = $conn->prepare("SELECT DISTINCT category_id, category_name FROM category_name");
        $stmt->execute();

        
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $categories = $stmt->fetchAll();

        foreach ($categories as $index => $category) {
            // vezme image pre katekoriu
            $imageFile = isset($categoriesImages[$category['category_name']])
                ? $categoriesImages[$category['category_name']]
                : null;
            ?>
            <a href="product_details.php?category_id=<?php echo $category["category_id"]; ?>">
                <div class="product">
                    <?php if ($imageFile && file_exists($imageFile)) : ?>
                        <img src="<?php echo $imageFile; ?>" alt="<?php echo $category['category_name']; ?>">
                    <?php endif; ?>
                </div>
            </a>
            <?php
        }
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</div>


<div class="best-seller">
  <h2 class="best-seller-title">Best Selling Product</h2>
  <?php
    
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_name = 'iPhone 13 Pro Max'");
    $stmt->execute();
    $product = $stmt->fetch();

    if ($product) {
      $image = $product['image'];
      $description = $product['description'];
      $price = $product['price'];
      $productId = $product['product_id'];

      // bestseller
      ?>
      <div class="product-bestseller">
        <img src="<?php echo $image; ?>" alt="Product Image">
        <div class="product-description">
          <h3><?php echo $product['product_name']; ?></h3>
          <p><?php echo $description; ?></p>
          <p>Price: $<?php echo $price; ?></p>
          <a href="shopping_cart.php">
  <button>BUY NOW</button>
</a>

          
        </div>
      </div>
      <?php
    } else {
      echo 'Product not found.';
    }
  ?>
</div>


<script>
    let slides = document.querySelectorAll('.slide');
let currentSlide = 0;

function slideShow() {
    
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove('active');
    }

    
    slides[currentSlide].classList.add('active');
    currentSlide = (currentSlide + 1) % slides.length;
}

// slider kazde  2 sec
setInterval(slideShow, 3000);

</script>
<div class="line-divider"></div>
<footer>
    <div class="footer-links">
        <?php
            foreach ($categories as $category) {
                echo "<a href=\"product_details.php?category_id={$category["category_id"]}\">{$category["category_name"]}</a>";
            }
        ?>
    </div>
    <div class="socials">
        <a href="https://www.facebook.com/yourfacebookpage" target="_blank">
            <img src="socials/facebook.png" alt="Facebook">
        </a>
        <a href="https://www.instagram.com/yourinstagramprofile" target="_blank">
            <img src="socials/instagram.png" alt="Instagram">
        </a>
        
    </div>
</footer>



</body>
</html>
