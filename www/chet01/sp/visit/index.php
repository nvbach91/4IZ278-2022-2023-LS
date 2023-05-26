<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../req/metadata.php') ?>
    <title>Visit | SuperCafé</title>
</head>

<body>
    <?php $activePage = "new";
    include_once('../req/header_v.php') ?>
    <main id='visit' class="visit">
        <div class="visit__box">
            <h2>New reservation</h2>
            <div>
                <span>Pick a date <sup>*</sup></span>
                <input type="date" :min='new Date().toISOString().split("T")[0]' v-model='date' required>
            </div>
            <div>
                <span>Pick a table <sup>*</sup></span>
                <label v-for='table in tables' :key='table.id'>
                    <input type="radio" name="table" :value='table.id' v-model='place'>
                    <span>{{table.name}}(max. {{table.capacity}} {{table.capacity>1?'people': 'person'}})</span>
                </label>
            </div>
            <div>
                <span>Leave a note</span>
                <textarea v-model='note'></textarea>
            </div>
            <p><sup>*</sup> Required field</p>
            <button @click.prevent='sendForm' :disabled='!place||!date'>Make a reservation</button>
        </div>
    </main>
    <script src='./script.js'></script>
</body>

</html>