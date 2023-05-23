<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../../req/metadata.php') ?>
    <title>Tables | SuperCafé</title>
</head>

<body>
    <?php $activePage = "tables";
    include_once('../../req/header_a.php') ?>
    <main id='tables' class="visit">
        <div class="visit__box">
            <h2>Tables</h2>
            <p>Tables with zero capacity are hidden for reservations.</p>
            <div class="table" :class='{hidden: table.capacity==0}' v-for='table in tables'>
                <span>{{table.id}}.</span>
                <label>Name: <input :value='table.name' @focusin='(e)=>oldname=e.target.value' @focusout='(e)=>changeName({value:e.target.value,id:table.id})'></label>
                <div class="capacity">
                    Capacity:
                    <button :disabled='table.capacity==0' @click='minusTable(table.id)'>-</button>
                    <p>{{table.capacity}}</p>
                    <button @click='plusTable(table.id)'>+</button>
                </div>
            </div>
        </div>
    </main>
    <script src='./script.js'></script>
</body>

</html>