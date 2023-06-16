<div class="flex flex-1 flex-col px-5 py-2">
    <div>
        <h1 class="whitespace-nowrap mt-4 text-2xl font-bold text-gray-700 dark:text-white">Způsob platby a doručení:</h1>
    </div>
    <div class="my-2">
        <form id="payment" method="POST">
            <select id="payment-select" name="delivery_method" class="block py-2.5 px-2 w-max text-sm text-gray-500 bg-transparent border-1 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200">
                <option selected value="0">Zvolte jednu z možností</option>
                <option value="0">Osobní převzetí, platba kartou nebo hotově (+0 Kč)</option>
                <option value="20">Doručení na adresu, platba kartou nebo hotově (+20 Kč)</option>
                <option value="50">Doručení na adresu, platba převodem (+50 Kč)</option>
                <option value="100">Doručení na adresu, dobírka (+100 Kč)</option>
            </select>
            <button class="my-2 whitespace-nowrap w-max text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-primary-800" type="submit">
                Přejít k souhrnu objednávky
            </button>
        </form>
    </div>

</div>