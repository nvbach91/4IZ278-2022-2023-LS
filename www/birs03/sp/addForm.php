<?php require 'header.php'; ?>
        <section style="width: 40%;display: table;margin: auto;" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1 style="text-align: center;">Add item</h1>
            <form action="add.php" method="POST">
                <label for="">Name</label>
                <input name="name" value="">
                <label for="">Price</label>
                <input name="price" value="">
                <label for="">Description</label>
                <input name="description" value="">
                <label for="">Image URL</label>
                <input name="img" value="">
                <label for="">Category</label>
                <select name="category_id">
                    <option value="1">Basketball</option>
                    <option value="2">Football</option>
                    <option value="3">Hockey</option>
                    <option value="4">MMA</option>
                    <option value="5">Tennis</option>
                </select>
                <button>Add</button>
            </form>
        </section>
<?php require 'footer.php'; ?>