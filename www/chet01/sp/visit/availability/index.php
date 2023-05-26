<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../../req/metadata.php') ?>
    <title>Tables | SuperCafé</title>
</head>

<body>
    <?php $activePage = "aval";
    include_once('../../req/header_v.php') ?>
    <main id='aval' class="visit">
        <div class="visit__box half">
            <h2>My profile</h2>
            <div>
                <span>Pick month <sup>*</sup></span>
                <select v-model='month'>
                    <option v-for='m in months'>{{m}}</option>
                </select>
            </div>
            <div v-if='!loading'>
                <span>Pick a table <sup>*</sup></span>
                <label v-for='table in tables' :key='table.id' :style='table.full?"background-color:red":""'>
                    <input type="radio" name="table" :value='table.id' v-model='place'>
                    <span>{{table.name}}(max. {{table.capacity}} {{table.capacity>1?'people': 'person'}}), full: {{table.full}}</span>
                </label>
            </div>
        </div>
        <div class="visit__box half">
            <h2>Unavailable days</h2>
            <div v-for='b in blocked'>{{b}}</div>
        </div>
    </main>
    <script src='./script.js'></script>
</body>

</html>