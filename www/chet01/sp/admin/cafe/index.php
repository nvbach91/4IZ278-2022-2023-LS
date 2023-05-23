<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../../req/metadata.php') ?>
    <title>Information | SuperCafé</title>
</head>

<body>
    <?php $activePage = "cafe";
    include_once('../../req/header_a.php') ?>
    <main id='cafedata' class="visit">
        <div class="visit__box">
            <form v-if='cafedata' @submit.prevent='saveData'>
                <label>
                    <p>Message</p>
                    <textarea v-model='cafedata.message'></textarea>
                </label>
                <label>
                    <p>Address</p>
                    <input type="text" v-model='cafedata.address'>
                </label>
                <label>
                    <p>Opening hours</p>
                    <input type="text" v-model='cafedata.hours'>
                </label>
                <label>
                    <p>Email</p>
                    <input type="text" v-model='cafedata.email'>
                </label>
                <label>
                    <p>Phone</p>
                    <input type="text" v-model='cafedata.phone'>
                </label>
                <button :disabled='!cafedata.address||!cafedata.hours||!cafedata.email||!cafedata.phone' type="submit">Save</button>
            </form>
        </div>
    </main>
    <script src='./script.js'></script>
</body>

</html>