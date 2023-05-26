<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../../req/metadata.php') ?>
    <title>Blocks | SuperCafé</title>
</head>

<body>
    <?php $activePage = "blocks";
    include_once("../../req/header_a.php") ?>
    <main id='blocks' class="visit">
        <div class="visit__box">
            <button v-show='!add' @click.prevent='add=true'>New block</button>
            <h2 v-show='add'>New block</h2>
            <div v-show='add'>
                <span>Pick a date <sup>*</sup></span>
                <input type="date" :min='new Date().toISOString().split("T")[0]' v-model='dateNew' required>
            </div>
            <div v-show='add'>
                <span>Pick a table <sup>*</sup></span>
                <label v-for='table in tables' :key='table.id'>
                    <input type="radio" name="table" :value='table.id' v-model='place'>
                    <span>{{table.name}}(max. {{table.capacity}} {{table.capacity>1?'people': 'person'}})</span>
                </label>
            </div>
            <div v-show='add'>
                <span>Leave a note</span>
                <textarea v-model='noteNew'></textarea>
            </div>
            <button v-show='add' @click.prevent='saveNewBlock' :disabled='!place||!dateNew'>Add new block</button>


            <h2>Blocks</h2>
            <table v-if='blocks&&blocks.length>0' cellspacing="0" cellpadding="0">
                <tr>
                    <th>Date</th>
                    <th>Table</th>
                    <th>Note</th>
                    <th>Edit/Delete</th>
                </tr>
                <tr v-for='r in blocks' :key='r.id'>
                    <td>{{r.date}}</td>
                    <td>{{r.name}}</td>
                    <td>{{r.note}}</td>
                    <td><a @click='editBlock(r)'>&rarr;</a></td>
                </tr>
            </table>
            <p v-else>No blocks found.</p>
        </div>
        <div class="popup" v-if='edit!==null'>
            <form @submit.prevent='saveBlock'>
                <span @click='edit=null' class="close">&times;</span>
                <label>
                    <p>Table</p>
                    <select v-if='available&&available.length>1' v-model='newTable'>
                        <option :value='edit.table_id'>Current: {{edit.name}} (max. {{edit.capacity}} {{edit.capacity>1?'people': 'person'}})</option>
                        <option v-for='a in available' :value='a.id'>{{a.name}} (max. {{a.capacity}} {{a.capacity>1?'people': 'person'}})</option>
                    </select>
                    <p v-else>There are no other tables without bookings for this day.</p>
                </label>
                <label>
                    <p>Note</p>
                    <textarea v-model='newNote'></textarea>
                </label>
                <button @click.prevent='deleteBlock(edit.id)' class="delete">Delete block</button>
                <button type="submit">Save block</button>
            </form>
        </div>
    </main>
    <script src='./script.js'></script>
</body>

</html>