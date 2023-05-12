<?php
require './UsersDatabase.php';

// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "About us BEEBZZ", $buffer);
echo $buffer;


?>
<main>
    <section class="container-fluid text-center main-image">
        <h1>Welcome at BEEBZZ</h1>
    </section>
    <article class="container article">
        <h2 class="text-center">Who we are</h2>
        <p>Welcome to our family beekeeping business! We are a small, family-run operation that has been producing delicious, high-quality honey for generations. Our bees are treated with the utmost care and respect, and we take great pride in the purity and flavor of our honey.</p>
        <div class="image-container">
            <img src="../pictures/team.jpg" alt="">
        </div>
    </article>
    <article class="container article">
        <h2 class="text-center">The right way to do it</h2>
        <p>Our beekeeping practices are sustainable and environmentally friendly. We prioritize the health of our bees and the health of our ecosystem, using only natural and organic methods to maintain the health and well-being of our hives.</p>
        <div class="image-container">
            <img src="../pictures/bee_keeping1.jpg" alt="">
        </div>
    </article>
    <article class="container article last-article">
        <h2 class="text-center">No chemicals!</h2>
        <p>In addition to our pure, raw honey, we also offer a variety of other bee-related products, such as beeswax candles or wax papers. All of our products are made with the same dedication to quality and sustainability that we apply to our beekeeping practices.</p>
        <div class="image-container">
            <img src="../pictures/dripping_honey.jpg" alt="">
        </div>
        <p>When you purchase from our eshop, you can be assured that you are supporting a small, family-owned business that values both the quality of our products and the health of our planet. Thank you for considering our family beekeeping business, and we look forward to sharing our delicious honey and bee-related products with you!</p>
    </article>
</main>

<?php include './footer.php'; ?>