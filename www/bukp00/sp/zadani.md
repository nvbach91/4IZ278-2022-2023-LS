# Easy tickets

Jednoduchá aplikace pro přihlašování na události. Základní funkcionalitou aplikace je přihlašování se na různé události. Zároveň zde tyto události mohou vytvářet. K událostem mohou účastníci přidávat zpětnou vazbu. Na profilu pořadatele lze vidět všechny události, které pořádal, a na stránce události se kromě základních informací o události zobrazí i zpětná vazba na tuto událost.

## Funcionalita

- Zobrazení seznamu všech událostí a možnost rozkliknutí události pro zobrazení její detailů
- Přihlášení a vytvoření uživatele pomocí účtu Google
  > Uživatelé se mohou přihlašovat na události a vytvářet je až po přihlášení
- Vytvoření a editování události
- Přihlášení na událost
  > po přihlášení obdrží uživatel potvrzovací email
- Přidání zpětné vazby na událost

## Usecase diagram

https://drive.google.com/file/d/1LC8Y65loehq1KT3IaVIoH5WQ_sOQluYT/view?usp=sharing


# Technologie

## Architektura

- Webserver: Apache
- Backend: PHP 8
- Databáze: MySQL
- Frontend: HTML, CSS + Tailwind

## Wireframe

- Home page - Seznam událostí
- Login page - Stránka pro přihlášení/registraci
- Event page - Detail + zpětná vazba
- Profile page - Stránka uživatele a jeho událostí (pořadatel a účastník)

https://drive.google.com/file/d/17FnzMlNbKA-vzPc5eY_2-rxwsZWb_ABJ/view?usp=sharing

## Databáze

- User - name, email
- Event - name, date, short description, description, seats, pořadatel
- Comment - author, content
- Ticket - event, user, seat

### Logický model

https://drive.google.com/file/d/1f8d1Vic2Id5iKfUkQYpzULhDwHc2tAoo/view?usp=sharing

### Fyzický model

https://drive.google.com/file/d/1aIwBkIO0hAYqmaGvHLfEQA_izPpgNoKi/view?usp=sharing

## Procesní diagram

https://drive.google.com/file/d/13uS72OnNmaIGjm24UAOeuZFh_KTyOJPy/view?usp=sharing

## Sekvenční diagram

https://drive.google.com/file/d/1HwFx9-9RMyPx2NljWrxJlXJPmh33LnwO/view?usp=sharing
