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