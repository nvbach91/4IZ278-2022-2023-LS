<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Avocado Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href=".">All Products</a></li>
                        <?php foreach ($categories as $category): ?>
                            <li class="nav-item"><a class="nav-link" href="?category_id=<?php echo $category['category_id']?>">
                            <?php echo $category['name'];?> </a></li>
                        <?php endforeach; ?>
                            <li class="nav-item"><a class="nav-link" aria-current="page" href="logout.php">Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>