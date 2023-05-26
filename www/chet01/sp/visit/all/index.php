<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../../req/metadata.php') ?>
    <title>My Reservations | SuperCafé</title>
</head>

<body>
    <?php $activePage = "all";
    include_once('../../req/header_v.php') ?>
    <main id='all' class="visit">
        <div class="visit__box">
            <h2>My reservations</h2>
            <table v-if='reservations&&reservations.length>0' cellspacing="0" cellpadding="0">
                <tr>
                    <th>Date</th>
                    <th>Table</th>
                    <th>My note</th>
                    <th>Edit/Delete</th>
                </tr>
                <tr v-for='r in reservations'>
                    <td>{{r.date}}</td>
                    <td>{{r.name}} (max. {{r.capacity}}&nbsp;p.)</td>
                    <td>{{r.note}}</td>
                    <td><a v-if='r.date>new Date().toISOString().split("T")[0]' @click='editRes(r)'>&rarr;</a></td>
                </tr>
            </table>
            <p v-else>No reservations found.</p>
        </div>
        <div class="popup" v-if='edit!==null'>
            <form @submit.prevent='saveRes'>
                <span @click='edit=null' class="close">&times;</span>
                <label>
                    <p>Table</p>
                    <select v-if='available&&available.length>1' v-model='newTable'>
                        <option :value='edit.table_id'>Current: {{edit.name}}(max. {{edit.capacity}} {{edit.capacity>1?'people': 'person'}})</option>
                        <option v-for='a in available' :value='a.id'>{{a.name}}(max. {{a.capacity}} {{a.capacity>1?'people': 'person'}})</option>
                    </select>
                    <p v-else>There are no other available tables for this day.</p>
                </label>
                <label>
                    <p>Note</p>
                    <textarea v-model='newNote'></textarea>
                </label>
                <button @click.prevent='deleteRes(edit.id)' class="delete">Delete reservation</button>
                <button type="submit">Save reservation</button>
            </form>
        </div>
    </main>
    <script src='./script.js'></script>
</body>

</html>