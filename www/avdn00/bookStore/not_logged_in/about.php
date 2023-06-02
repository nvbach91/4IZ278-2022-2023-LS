<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>About us</h3>
        <p><a href="../index.php">home</a> / about</p>
    </div>

    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="../img/about.jpg" alt="">
            </div>
            <div class="content">
                <h3>Why you should choose us?</h3>
                <p>At Bookworms, we strive to provide exceptional customer service and ensure your satisfaction at every step. Our user-friendly website makes browsing and ordering a breeze, and our dedicated customer support team is always ready to assist you with any queries or concerns you may have. Your reading journey is important to us, and we are here to make it as seamless and enjoyable as possible.</p>
                <a href="./contact.php" class="button">Contact us</a>
            </div>
        </div>
    </section>

    <section class="reviews">
        <h1 class="title">client's reviews</h1>
        <div class="box-container">
            <div class="box">
                <img src="../img/user-logo.png">
                <p>Bookworms is my go-to online bookstore! They have an incredible selection of books across various genres. I love how easy it is to navigate their website and find exactly what I'm looking for. The ordering process is seamless, and my books always arrive in excellent condition. Highly recommended!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>John D.</h3>
            </div>

            <div class="box">
                <img src="../img/user-logo.png">
                <p>The customer service is exceptional. They are always prompt in answering my questions and providing recommendations. The quality of their books is top-notch, and they offer competitive prices. I've been a loyal customer for years, and I wouldn't shop anywhere else for my reading needs.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>Sarah M.</h3>
            </div>

            <div class="box">
                <img src="../img/user-logo.png">
                <p>As an avid reader, I'm thrilled to have discovered Bookworms. Their collection is a treasure trove of literary gems. The books I've purchased from Bookworms have opened up new worlds and enriched my reading journey. I'm grateful for their dedication to providing exceptional reading experiences</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Bob W.</h3>
            </div>

            <div class="box">
                <img src="../img/user-logo.png">
                <p>Bookworms carefully curated selection introduced me to new authors and genres I hadn't explored before. I appreciate the detailed book descriptions and customer reviews, which helped me make informed choices. Bookworms has become my one-stop-shop for literary inspiration and a valuable resource for expanding my reading horizons.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>Rachel D.</h3>
            </div>

            <div class="box">
                <img src="../img/user-logo.png">
                <p>Bookworms has become my favorite online bookstore. The packaging of the books is always secure, ensuring they arrive in pristine condition. The website is user-friendly, making it a breeze to browse through their extensive catalog. I've recommended Bookworms to all my book-loving friends, and they haven't been disappointed either!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>Michael R.</h3>
            </div>


            <div class="box">
                <img src="../img/user-logo.png">
                <p>I can't express how grateful I am for Bookworms' outstanding service. They went above and beyond to help me find a specific book that was out of stock everywhere else. Their team tirelessly searched and managed to locate a copy for me. That level of dedication and care is hard to find these days. Bookworms has earned my trust and loyalty as a customer.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Emily T.</h3>
            </div>
        </div>
    </section>



    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>

</body>

</html>