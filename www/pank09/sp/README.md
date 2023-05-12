# BookTickets

## Popis
Aplikace pro rezervování vstupenek na hudební koncerty.

## Funcionalita

- Vytváření, mazání a úpravy událostí a vstupenek adminem.
- Prohlížení událostí a vstupenek všemi uživateli.
- Rezervace vstupenek registrovanými uživateli.
- Oznámení e-mailem po rezervaci.

## Usecase diagram
[Odkaz](https://drive.google.com/file/d/1yf-KhG6y3_yHXTwGcPSLyYsnmQKTcPLR/view?usp=sharing)

## Wireframe
[Odkaz](https://drive.google.com/file/d/1OVSE28vWoQjoHmirjWLslfBWL1DYiy_s/view?usp=sharing)
- Home page - seznam koncertů/událostí.
- Event page - stránka s podrobnostmi o koncertu/události a možnosti rezervace.
- Tickets page - stránka, kde si uživatel může prohlížet rezervované vstupenky a správce si může prohlížet vstupenky všech uživatelů.
- Sign in/ Sign up - pro autentifikaci.

## Architektura
- Webserver: Apache
- Databáze: MySQL
- Backend: PHP 8
    - Knihovny: Laravel
- Frontend: HTML, CSS, JS

## Návrh databáze
- [Logický model](https://drive.google.com/file/d/1vHyb4-ukIhi3ue_3wV414TT4CTzZ7UHa/view?usp=sharing)
- [Fyzický model](https://drive.google.com/file/d/1tBJkl_5bmbOLqndBIjKWXL_FQEHrexCZ/view?usp=share_link)

## Procesní diagram
[Odkaz](https://drive.google.com/file/d/1Yx1E5o3ZXKZ9HiJwSwYchw2raU4-POJK/view?usp=sharing)

## Sekvenční diagram
[Odkaz](https://drive.google.com/file/d/1k-0N_HOwW0GgfhouYoWMezoxQ36OwvRR/view?usp=sharing)
