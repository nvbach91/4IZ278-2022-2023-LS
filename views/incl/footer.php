<footer id="contact" class="bg-orange-100 dark:bg-gray-900 dark:text-white sticky top-[100vh]">
    <section class="max-w-4xl mx-auto p-4 flex flex-col sm:flex-row sm:justify-between">
        <address>
            <h2>Fruitopia</h2>
            123 Okružní<br>
            Slaný 27401<br>
            Email: <a href="mailto:info@fruitopia.com">info@fruitopia.com</a><br>
            Phone: <a href="tel:+420333222111">+420 111 222 333</a>
        </address>
        <nav class="hidden md:flex flex-col gap-2" aria-label="footer">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="main.php" class="hover:opacity-90">Home</a>
                <a href="main.php#about" class="hover:opacity-90">O nás</a>
            <?php else : ?>
                <a href="main.php" class="hover:opacity-90">Home</a>
                <a href="main.php#about" class="hover:opacity-90">O nás</a>
            <?php endif; ?>
        </nav>
        <div class="flex flex-col sm:gap-2">
            <p class="text-right">Jan Vlček &copy;<span id="year"></span></p>
        </div>
    </section>
</footer>

</body>

</html>