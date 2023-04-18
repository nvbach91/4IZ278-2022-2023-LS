<?php require './header.php'; ?>
        <section style="height:100%" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1>Add item</h1>
            <form action="./add.php" method="POST">
                <p>Name</p>
                <input name="name">
                <p>Price</p>
                <input name="price">
                <p>Description</p>
                <input name="description">
                <p>Image link</p>
                <input name="img">
                <button>Add</button>
            </form>
        </section>
<?php require './footer.php'; ?>