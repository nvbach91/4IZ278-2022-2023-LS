# 4IZ278 - Semestrální práce: Restaurační systém

## Stručný popis aplikace

Aplikace bude umožňovat základní správu restaurace. V zásadě se bude jednat o jednoduchý informačná systém, který propojí správu restaurace s jejími zaměstnanci a hosty.

## Popis funkcionality

V závislosti na přihlášení a přidělených rolích bude aplikace nabízet následující funkcionality:

- Bez přihlášení
  - Zobrazení aktuálního menu pro daný den/týden
  - Zaregistrování nového uživatelského účtu typu `customer`
- Po přihlášení:
  - Správu nabídky restaurace
    - Přidání položek do nabídky
    - Úprava parametrů (cena, objem, apod.) již nabízených položek
    - Smazání (= archivace) položek nabídky
  - Správu menu
    - Vytvoření nového menu
    - Úprava položek a doby platnosti
    - Smazání již neplatného menu
  - Správu objednávek
    - Založení nové objednávky
    - Editace položek:
      - Přidávání nových položek
      - Úprava množství u položek
      - Odebrání položek z objednávky
    - Uzavření objednávky a vystavení účtu
  - Správu uživatelských účtů
    - Přidání nového účtu interního zaměstnance
    - Správa rolí zaměstnanců
    - Odebrání uživatelského účtu

## Uživatelské role

V aplikaci bude několik rolí, které mohou být přiřazeny uživateli

### Uživatel typu `customer`
- Základní role, kterou má každý externí uživatel. Tato role umožnuje v rámci restauračního IS vytvářet online objednávky. 

### Uživatel typu `waiter`
- Základní role interních uživatelů. Tato role bude umožňovat:
  - Tvorbu nových objednávek
  - Úpravu stávajících objednávek (přidání/odebrání položek, uzavření objednávek, vystavení účtu)

### Uživatel typu `cook`
- Role, jež bude přiřazena kuchařům. Tato role bude umožňovat:
  - Editaci aktivních objednávek: nastavení položky z objednávky jako připravené
  - Editaci menu: označení položky jako nedostupné.

### Uživatel typu `manager (aka admin)`
- Tato role obsahuje všechny pravomoci rolí `waiter` a `cook` a navíc ještě:
  - Správu uživatelských účtů
  - Správu rolí uživatelů
  - Správu položek: přidání/odebrání (tzn. archivace)/editace
  - Správu menu: přidání/odebrání menu, aktualizaci položek na menu


## Use case diagramy

- Objednávky
  - [Vytvoření](https://4iz278sp-zadani.lubosjansky.com/use_cases/order/new.png)
  - [Editace](https://4iz278sp-zadani.lubosjansky.com/use_cases/order/edit.png)
  - [Uzavření](https://4iz278sp-zadani.lubosjansky.com/use_cases/order/close.png)
- [Správa menu](https://4iz278sp-zadani.lubosjansky.com/use_cases/menu_management.png)
- [Správa nabídky restaurace](https://4iz278sp-zadani.lubosjansky.com/use_cases/offer_management.png)
- [Správa stolů](https://4iz278sp-zadani.lubosjansky.com/use_cases/table_management.png)
- [Správa uživatelských účtů](https://4iz278sp-zadani.lubosjansky.com/use_cases/user_accounts_management.png)

## Návrhy obrazovek

- Objednávky
  - [Vytvoření](https://4iz278sp-zadani.lubosjansky.com/wireframes/order/new.png)
  - [Editace](https://4iz278sp-zadani.lubosjansky.com/wireframes/order/edit.png)
- [Kuchyně - přehled](https://4iz278sp-zadani.lubosjansky.com/wireframes/kitchen_overview.png)
- [Uživatel - přihlášení](https://4iz278sp-zadani.lubosjansky.com/wireframes/user_login.png)

## Architektura

- Webserver: Apache (NGINX)
- Backend: PHP 8
- Databáze: MySQL (PostgreSQL)
- Backend:
  - [Nette](https://nette.org/cs/)
- Frontend:
  - [Nette](https://nette.org/cs/) [(resp. Latte)](https://latte.nette.org/cs/)
  - [MDBootstrap](https://mdbootstrap.com/)

## Návrh databáze

- [Logický model](https://4iz278sp-zadani.lubosjansky.com/database/logical_model.png)
- [Relační model](https://4iz278sp-zadani.lubosjansky.com/database/relation_model.png)

## Procesní diagramy

- [Objednávky - zjednodušené schema](https://4iz278sp-zadani.lubosjansky.com/process_diagrams/order/order.png)
  - [Vytvoření](https://4iz278sp-zadani.lubosjansky.com/process_diagrams/order/new.png)
  - [Obsloužení zákazníka](https://4iz278sp-zadani.lubosjansky.com/process_diagrams/order/customer_service/customer_service.png)
    - [Editace objednávky](https://4iz278sp-zadani.lubosjansky.com/process_diagrams/order/customer_service/manage_order_items.png)
  - [Uzavření](https://4iz278sp-zadani.lubosjansky.com/process_diagrams/order/close.png)
- [Kuchyně - potvrzení o přípravě jídla](https://4iz278sp-zadani.lubosjansky.com/process_diagrams/meal_confirmation.png)
- [Správa menu](https://4iz278sp-zadani.lubosjansky.com/process_diagrams/menu_management.png)

## Sekvenční diagramy

- Uživatelské účty
  - [Vytvoření](https://4iz278sp-zadani.lubosjansky.com/sequential_diagrams/account/new.png)
  - [Editace](https://4iz278sp-zadani.lubosjansky.com/sequential_diagrams/account/edit.png)
  - [Odstranění](https://4iz278sp-zadani.lubosjansky.com/sequential_diagrams/account/delete.png)
- Položky nabídky
  - [Nové jídlo](https://4iz278sp-zadani.lubosjansky.com/sequential_diagrams/item/new_meal.png)
  - [Nový nápoj](https://4iz278sp-zadani.lubosjansky.com/sequential_diagrams/item/new_drink.png)
- [Nová objednávka](https://4iz278sp-zadani.lubosjansky.com/sequential_diagrams/new_order.png)
