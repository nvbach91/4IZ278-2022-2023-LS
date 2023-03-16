<?php $htmlTitle = 'Softball championship';
require_once 'templates/htmlHeader.php'; ?>
    <main>
        <div class="d-flex justify-content-center align-items-center">
            <div class="container mt-4 mb-4">
                <div class="row animation fade-in">
                    <div class="col-md-5 col-xl-6 mb-4 text-white text-center text-md-start">
                        <h1 class="tournament-name">Softball championship</h1>
                    </div>
                    <div class="col-md-7 col-xl-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="h3 text-center">Začněte zde:</p>
                                <hr>
                                <div class="md-form mt-4 mb-4">
                                    <a href="login.php" class="btn btn-lg btn-primary text-white d-block py-3"><i
                                                class="fa-solid fa-right-to-bracket me-3 fa-lg"></i>Přihlásit se</a>
                                </div>
                                <div class="md-form">
                                    <a href="registration.php" class="btn btn-secondary text-white d-block py-3"><i
                                                class="fa-solid fa-address-card me-3"></i>Zaregistrovat se</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require_once 'templates/htmlFooter.php'; ?>