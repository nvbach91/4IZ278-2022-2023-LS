<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../req/metadata.php') ?>
    <title>Admin | SuperCafé</title>
</head>

<body>
    <?php $activePage = "reservations";
    include_once("../req/header_a.php") ?>
    <main id='admin' class="visit">
        <div class="visit__box">
            <button v-show='!add' @click.prevent='add=true'>New reservation</button>
            <h2 v-show='add'>New reservation</h2>
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
                <span>Customer</span>
                <select v-if='customers' v-model='customerNew'>
                    <option v-for='c in customers' :value='c.id'>{{c.firstname}} {{c.surname}} {{c.email?' ('+c.email+')':''}}</option>
                </select>
            </div>
            <div v-show='add'>
                <span>Leave a note</span>
                <textarea v-model='noteNew'></textarea>
            </div>
            <button v-show='add' @click.prevent='saveNewRes' :disabled='!place||!dateNew||!customerNew'>Create a reservation</button>


            <h2>Reservations</h2>
            <div>
                <!-- <span>Pick a date <sup>*</sup></span> -->
                <input type="date" v-model='date' required>
            </div>
            <table v-if='reservations&&reservations.length>0' cellspacing="0" cellpadding="0">
                <tr>
                    <th>Table</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Note</th>
                    <th>Edit/Delete</th>
                </tr>
                <tr v-for='r in reservations' :key='r.id'>
                    <td>{{r.name}}</td>
                    <td>{{r.firstname}} {{r.surname}}</td>
                    <td>{{r.email}}</td>
                    <td>{{r.phone}}</td>
                    <td>{{r.note}}</td>
                    <td><a @click='editRes(r)'>&rarr;</a></td>
                </tr>
            </table>
            <p v-else>No reservations for this date.</p>
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