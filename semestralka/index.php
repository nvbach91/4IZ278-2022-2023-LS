<?php
include 'header.php';
include 'database.php'; 

$isAuthenticated = isset($_SESSION['user_id']);
$userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;  
$successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NayEshop</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="icon" href="images/favicon.png" type="image/png">
</head>
<body>






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


<?php include 'bestseller.php'; ?>


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


<?php include 'footer.php'; ?>

</body>
</html>
