<?php require 'header.php'; ?>
        <section style="width: 40%;display: table;margin: auto;" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1 style="text-align: center;">Add category</h1>
            <form action="addCategory.php" method="POST">
                <label for="">Name</label>
                <input name="name" value="">
                <button>Add</button>
            </form>
        </section>
<?php require 'footer.php'; ?>