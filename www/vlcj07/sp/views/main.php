<?php $pageTitle = 'Fruitopia' ?>
<?php $metaKW = 'Fruitopia, about, contact, reviews, shopping, eshop, fruits, products' ?>
<?php $metaDescription = 'Našim zákazníkům přinášíme to nejčerstvější a nejlahodnější exotické ovoce dostupné na trhu za ty nejpříznivější ceny. Jsme Fruitopia, váš svět exotického ovoce.' ?>
<?php session_start(); ?>
<?php require '../controllers/mainController.php'; ?>
<?php include './incl/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold text-center sm:text-5xl m-10 text-slate-900 dark:text-white">Vítejte ve Fruitopii!</h1>
    <p class="text-xl text-center sm:text-sm m-10 text-slate-900 dark:text-white">Ve světě exotického ovoce 🥑🍌🍉🍆</p>
    <div class="relative m-10 ">
        <div class="relative transition-transform flex drop-shadow-xl">
            <div id="slide1-container" class="slide-container w-full h-full overflow-hidden">
                <img src="../public/img/carousel/dragon-fruit.jpeg" alt="Dračí ovoce" class="slide absolute inset-0 w-full h-full object-cover active">
            </div>
            <div id="slide2-container" class="slide-container w-full h-full overflow-hidden">
                <img src="../public/img/carousel/litchi.jpeg" alt="Liči" class="slide absolute inset-0 w-full h-full object-cover opacity-0">
            </div>
            <div id="slide3-container" class="slide-container w-full h-full overflow-hidden">
                <img src="../public/img/carousel/passion-fruit.webp" alt="Mučenka" class="slide absolute inset-0 w-full h-full object-cover opacity-0">
            </div>
        </div>
    </div>

    <hr class="mx-auto bg-black dark:bg-white w-1/2">

    <section id="products" class="flex justify-center  mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Naše produkty</h2>
            <?php if (!isset($_SESSION['user_id'])) : ?>
                <p class="text-xl text-center sm:text-sm m-10 text-slate-900 dark:text-white">Pro nákup a detaily produktů musíte být přihlášeni. </p>
            <?php endif; ?>
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <!-- product -->
                <?php include './displays/ProductDisplay.php' ?>
            </div>
            <div class="text-center mt-4 text-gray-700 dark:text-white text-xl p-5 m-5 gap-1">
                <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
                    <a class="p-0.5" href="<?php echo './main.php?limit=' . $limit . '&offset=' . $i * 4; ?>"><?php echo $i + 1 ?></a>
                <?php } ?>
            </div>
        </div>
    </section>

    <hr class="mx-auto bg-black dark:bg-white w-1/2">

    <section id="about" class="p-6 my-12 scroll-mt-20 widescreen:section-min-height tallscreen:section-min-height">
        <h2 class="text-4xl font-bold text-center sm:text-5xl mb-6 text-slate-900 dark:text-white">O nás</h2>

        <figure class="my-12">
            <blockquote class="bg-orange-100 dark:bg-black pl-14 pr-8 py-12 rounded-xl relative">
                <p class="text-2xl sm:text-3xl text-left mt-2 text-black dark:text-slate-400">
                    Našim zákazníkům přinášíme to nejčerstvější a nejlahodnější exotické ovoce dostupné na trhu za ty nejpříznivější ceny. Ovoce doručujeme do 24 hodin od objednání, nebo se můžete o kvalitě přijít přesvědčit na jednu z našich kamenných prodejen. Jsme Fruitopia, váš svět exotického ovoce již od roku 2023.
                </p>
            </blockquote>
        </figure>

        <h3 class="text-2xl font-bold text-center sm:text-2xl mb-6 text-slate-900 dark:text-white">Jak o nás mluví zákaznící</h3>
        <figure class="my-12">
            <blockquote class="bg-orange-100 dark:bg-black pl-14 pr-8 py-12 rounded-xl relative">
                <p class="text-2xl sm:text-3xl text-left mt-2 text-black dark:text-slate-400">
                    Fruitopia je dle mě jedním z nejlepších obchodů s exotickým ovocem.
                    Všechno mi vždy dorazí čerstvé a lahodné. Doporučuji všem milovníkům exotického ovoce.
                    Už se mi podařilo přesvědčit svoji rodinu a všechny své přátele.
                </p>
            </blockquote>
            <figcaption class="italic text-xl sm:text-2xl text-right mt-2 text-slate-500 dark:text-slate-400">
                &#8212;Josef Dvořák, Praha
            </figcaption>
        </figure>
        <figure class="my-12">
            <blockquote class="bg-orange-100 dark:bg-black pl-14 pr-8 py-12 rounded-xl relative">
                <p class="text-2xl sm:text-3xl text-left mt-2 text-black dark:text-slate-400">
                    Začít den kusem exotického ovoce bylo vždy pouhým snem. Fruitopia mé sny přeměnila v realitu.
                    Když mám hlad, dám si jedno z jejich lahodných avokád nebo banánů.
                    Raději vždy nosím nějaké to ovoce ve své KPZ, kdybych se opět dostala do jakékoliv krizové situace.
                </p>
            </blockquote>
            <figcaption class="italic text-xl sm:text-2xl text-right mt-2 text-slate-500 dark:text-slate-400">
                &#8212;Paní Zdena, Kořen
            </figcaption>
        </figure>

    </section>
</main>
<script src="../public/js/main-carousel.js"></script>
<?php include './incl/footer.php'; ?>