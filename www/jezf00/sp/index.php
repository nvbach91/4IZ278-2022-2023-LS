<?php require __DIR__ . '/header.php'; ?>

<div class="container mt-3">
    <?php require __DIR__ . '/navbar.php'; ?>
    <div class="row">
        <div class="col-lg-3">
            <h3 class="mb-4">Categories</h3>
            <?php require_once "./categoryDisplay.php" ?>
        </div>
        <div class="col-lg-9">
            <h3 class="mb-4">Products</h3>
            <form action="index.php" method="get" class="mb-3">
                <div class="form-group">
                    <label for="sort">Sort by Price:</label>
                    <?php if(isset($_GET['category_id'])):?>
                    <input type="hidden" name="category_id" value="<?php echo $_GET['category_id']; ?>">
                    <?php endif ?>
                    <select name="sort" id="sort" class="form-control">
                        <option value="">-- Select --</option>
                        <option value="asc">Low to High</option>
                        <option value="desc">High to Low</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Sort</button>
            </form>
            <?php require_once __DIR__ . '/productDisplay.php'; ?>
        </div>
    </div>
</div>

</body>

<?php require __DIR__ . '/footer.php'; ?>
