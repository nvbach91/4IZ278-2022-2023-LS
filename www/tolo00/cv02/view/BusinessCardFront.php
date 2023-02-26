<?php

class BusinessCardFront
{

    public static function render(Person $person)
    {
        echo '
            <div class="page front-page">
                <div class="grid-x align-middle">
                    <div class="cell medium-5">
                        <img class="logo" src="' . Company::COMPANY_AVATAR . '">
                    </div>

                    <div class="cell medium-7">
                        <div class="grid-y">
                            <div class="cell">
                                <h2 class="text-center name-main">
                                    ' . $person->getFullName() . '
                                </h2>
                            </div>

                            <hr>

                            <div class="cell">
                                <h4 class="text-center profession">
                                    ' . $person->proffesion . '
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }

}
