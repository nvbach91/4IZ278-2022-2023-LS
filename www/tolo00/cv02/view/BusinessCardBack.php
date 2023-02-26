<?php

class BusinessCardBack
{

    public static function render(Person $person)
    {
        echo '
            <div class="page back-page">
                <div class="grid-x align-middle">
                    <div class="cell medium-7">
                        <div class="grid-y">
                            <div class="cell">
                                <h3>' . Company::COMPANY_NAME . '</h3>
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-person"></i> ' . $person->getFullName() . '
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-calendar-days"></i> ' . $person->getAge() . ' let
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-briefcase"></i> ' . $person->proffesion . '
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-location-dot"></i> ' . Company::getFullAddress() . '
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-envelope"></i> ' . $person->email . '
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-phone"></i> ' . $person->phone . '
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-link"></i> <a href="' . Company::COMPANY_URL . '" target="_blank">' . Company::COMPANY_URL . '</a>
                            </div>
                        </div>
                    </div>

                    <div class="cell medium-5">
                        <img class="logo" src="' . Company::COMPANY_AVATAR . '">
                    </div>
                </div>
            </div>
        ';
    }

}
