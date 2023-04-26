<?php
session_start();

require_once('../database/loadData.php');


include('../components/header.php');




?>




<div class="card w-100 shadow my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
    </div>
    <div class="card-body text-dark p-5 pt-1">
        <h1 class="text-center mb-3">Světový čas</h1>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow rounded">
                    <div class="card-body text-center mx-auto">
                        <link rel="stylesheet" href="../clock.css">

                        <div class="justify-content-center align-items-center" id="clock">
                            <div id="time">
                                <div class="shadow bg-dark"><span id="hour-CEST">00</span></div>
                                <div class="shadow bg-dark"><span id="minutes-CEST">00</span></div>
                                <div class="shadow bg-dark"><span id="seconds-CEST">00</span></div>
                            </div>
                        </div>

                        <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">

                        <h2 class="card-title mb-1"><span class="badge shadow bg-dark">Praha</span></h2>
                        <p class="card-texttext-muted mb-0"><span class="badge shadow bg-dark">CEST (+2)</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-lg rounded">
                    <div class="card-body text-center mx-auto">
                        <link rel="stylesheet" href="../clock.css">

                        <div class="justify-content-center align-items-center" id="clock">
                            <div id="time">
                                <div class="shadow bg-dark rounded"><span id="hour-EDT">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="minutes-EDT">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="seconds-EDT">00</span></div>
                            </div>
                        </div>

                        <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">

                        <h2 class="card-title mb-1"><span class="badge shadow bg-dark">New York</span></h2>
                        <p class="card-texttext-muted mb-0"><span class="badge shadow bg-dark">EDT (-4)</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-lg rounded">
                    <div class="card-body text-center mx-auto">
                        <link rel="stylesheet" href="../clock.css">

                        <div class="justify-content-center align-items-center" id="clock">
                            <div id="time">
                                <div class="shadow bg-dark rounded"><span id="hour-GMT">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="minutes-GMT">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="seconds-GMT">00</span></div>
                            </div>
                        </div>

                        <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">

                        <h2 class="card-title mb-1"><span class="badge shadow bg-dark">Greenwich</span></h2>
                        <p class="card-texttext-muted mb-0"><span class="badge shadow bg-dark">GMT (0)</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                <div class="card shadow-lg rounded">
                    <div class="card-body text-center mx-auto">
                        <link rel="stylesheet" href="../clock.css">

                        <div class="justify-content-center align-items-center" id="clock">
                            <div id="time">
                                <div class="shadow bg-dark rounded"><span id="hour-JST">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="minutes-JST">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="seconds-JST">00</span></div>
                            </div>
                        </div>

                        <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">

                        <h2 class="card-title mb-1"><span class="badge shadow bg-dark">Tokio</span></h2>
                        <p class="card-texttext-muted mb-0"><span class="badge shadow bg-dark">JST (+9)</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                <div class="card shadow-lg rounded">
                    <div class="card-body text-center mx-auto">
                        <link rel="stylesheet" href="../clock.css">

                        <div class="justify-content-center align-items-center" id="clock">
                            <div id="time">
                                <div class="shadow bg-dark rounded"><span id="hour-AEST">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="minutes-AEST">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="seconds-AEST">00</span></div>
                            </div>
                        </div>

                        <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">

                        <h2 class="card-title mb-1"><span class="badge shadow bg-dark">Sydney</span></h2>
                        <p class="card-texttext-muted mb-0"><span class="badge shadow bg-dark">AEST (+10)</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                <div class="card shadow-lg rounded">
                    <div class="card-body text-center mx-auto">
                        <link rel="stylesheet" href="../clock.css">

                        <div class="justify-content-center align-items-center" id="clock">
                            <div id="time">
                                <div class="shadow bg-dark rounded"><span id="hour-MSK">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="minutes-MSK">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="seconds-MSK">00</span></div>
                            </div>
                        </div>

                        <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">

                        <h2 class="card-title mb-1"><span class="badge shadow bg-dark">Moskva</span></h2>
                        <p class="card-texttext-muted mb-0"><span class="badge shadow bg-dark">MSK (+3)</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                <div class="card shadow-lg rounded">
                    <div class="card-body text-center mx-auto">
                        <link rel="stylesheet" href="../clock.css">

                        <div class="justify-content-center align-items-center" id="clock">
                            <div id="time">
                                <div class="shadow bg-dark rounded"><span id="hour-CST">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="minutes-CST">00</span></div>
                                <div class="shadow bg-dark rounded"><span id="seconds-CST">00</span></div>
                            </div>
                        </div>

                        <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">

                        <h2 class="card-title mb-1"><span class="badge shadow bg-dark">Peking</span></h2>
                        <p class="card-texttext-muted mb-0"><span class="badge shadow bg-dark">CST (+8)</span></p>
                    </div>
                </div>
            </div>


        </div>

    </div>

</div>

<script src="../clock.js"></script>

<?php

include('../components/footer.php');

?>