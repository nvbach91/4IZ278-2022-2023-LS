<?php
include('header.php');
require('database.php');
//Někdy příště
?>




<div class="container mt-5 mb-5">


    <div class="card w-100 shadow-sm p-3 mb-5 bg-body-tertiary rounded" style="width: 18rem;">
        <div class="card-body">
            <h2>Nový produkt</h2>
            <form>
                <div class="mb-3">
                    <label class="form-label">Název</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cena</label>
                    <input type="number" class="form-control" name="price">
                </div>
                <button type="submit" class="btn btn-primary">Odeslat</button>
            </form>
        </div>

    </div>
</div>


</body>

</html>