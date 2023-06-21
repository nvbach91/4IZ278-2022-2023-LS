# Grow Republic
E-Shop ekoproduktů. Kupující si mohou vybrat produkt, přidat jej do košíku a vytvořit si profil pro uložení dodací adresy a kontaktních údajů.
### Funkcionalita
* Řazení podle kategorií zboží
* Posuvník zboží na akci
* Přidání zboží do košíku
* Vytvoření profilu pro usnadnění dálší nákupů
* Možnost nákupu bez autorizáce
### [Usecase Diagram](https://vse-my.sharepoint.com/:u:/g/personal/kuza13_vse_cz/EbKKvl3zkexFjbgtWRz59VgB_LUdrD5sjWWAF6sq4pyWxw?e=ZYyMrV)
---
## Technologie
### Architektura

* WebServer: Apache
* BackEnd: PHP 8
* Database: MySQL
* FrontEnd: HTML + CSS
### Wireframe
* [Home page - Akční zboží, seznam všech zboží](https://www.figma.com/proto/XCXB3M1n3kDjqbKfllCHF2/GrowRepublic--e-shop?page-id=0%3A1&node-id=0-3&viewport=-659%2C329%2C0.29&scaling=scale-down&starting-point-node-id=0%3A3)
* [About us](https://www.figma.com/proto/XCXB3M1n3kDjqbKfllCHF2/GrowRepublic--e-shop?page-id=0%3A1&node-id=5-95&viewport=-659%2C329%2C0.29&scaling=scale-down&starting-point-node-id=0%3A3)
* [Products - seznam všech zboží](https://www.figma.com/proto/XCXB3M1n3kDjqbKfllCHF2/GrowRepublic--e-shop?page-id=0%3A1&node-id=5-112&viewport=-659%2C329%2C0.29&scaling=scale-down&starting-point-node-id=0%3A3)
* [Cart](https://www.figma.com/proto/XCXB3M1n3kDjqbKfllCHF2/GrowRepublic--e-shop?page-id=0%3A1&node-id=21-349&viewport=-659%2C329%2C0.29&scaling=scale-down&starting-point-node-id=0%3A3)

### Database
* User (ID, Name, e-mail, phone, password)
* Adress (User_ID, City, Street, Postal Code)
* Products
* Categories
* Discounts
#### [Logický model](https://vse-my.sharepoint.com/:u:/g/personal/kuza13_vse_cz/EUiLhZXZuEtGrfGRsr9Xpe4B1c6kP2E9CkarI2f2bcHvGg?e=wVJEY3)

#### [Fizický model](https://vse-my.sharepoint.com/:u:/g/personal/kuza13_vse_cz/EbSuNq_MXUhAmD_-qIZXsbgBjXPXQFF1RFCncTVfALQn_Q?e=xX1Jkc) 

### [Procesní diagram](https://vse-my.sharepoint.com/:u:/g/personal/kuza13_vse_cz/EbSuNq_MXUhAmD_-qIZXsbgBjXPXQFF1RFCncTVfALQn_Q?e=xX1Jkc)

### [Sekvenční diagram](https://vse-my.sharepoint.com/:u:/g/personal/kuza13_vse_cz/EZVoCV8gHktMqZRVARkhynsB1CCMqEGW5t7lxjzdemgGvw?e=T92rPT)