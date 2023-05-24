# Cross Mile
----------------
## Popis aplikace
>Aplikace bude sloužit k přihlašování na závody pořádané klubem SK Míle. Bude zde nejprve nutné vytvoření účtu uživatelem, které bude spojené s ověřením osoby pomocí odkliknutí odkazu v e-mailu. Poté se uživatel bude moci přihlásit do svého profilu a vybrat si aktuálně dostupné závody, kde bude zároveň i výpis přihlášených uživatelů. Na závod bude možné se registrovat i odregistrovat. 

### Architektura
| | |
| ------ | ------ |
| webový server | NGINX 1.14 (SSL + HTTP/2)|
| back-end | PHP 7.4|
| databáze| MySQL 8.0|
| front-end | HTML5, CSS, pure JS, Bootstrap 5|

#### Wireframy
* Krosová míle :: úvodní stránka s informacemi [[wireframe](https://drive.google.com/file/d/1Lab6BrF3B-95Y_m68jdt2h9LVOR6Aick/view?usp=sharing)]
* Seznam závodů :: výpis altuálních závodů [[wireframe](https://drive.google.com/file/d/1elnAl4S6kWawmQQ8I0woGOImbCv647Hp/view?usp=sharing)]
* Vytvořit účet :: formulář pro sběr dat o uživateli [[wireframe](https://drive.google.com/file/d/1GXGv-kPwIHpZgHBBAS6rUV8rIMR9Y3PU/view?usp=share_link)]
* Přihlásit :: stránka pro ty uživatele, kteří byli ověřeni (e-mail, OAuth2) [[wireframe](https://drive.google.com/file/d/1VY5MQoW47UJHMgKbl6DDbWkfLKcUsMBH/view?usp=share_link)]
* profil :: profil uživatele po přihlášení [[wireframe](https://drive.google.com/file/d/1djZnL_jp7N8JQ27cYEg1dWCSBi8ECe1W/view?usp=share_link)]
* Registrovat na závod :: po vytvoření účtu a následném přihlášení se na záložce "Seznam závodů" bude dát kliknout na "Registrovat" na závod [[wireframe](https://drive.google.com/file/d/1VSG4IVfom7WrW2nqAZO-RlbRY4bXDLa_/view?usp=share_link)]

#### Diagramy
1. [Usecase diagram](https://drive.google.com/file/d/1pme_zJtWRj69Nnet5BD4jcjgzJveUJmq/view?usp=share_link)
2. [Procesní diagram](https://drive.google.com/file/d/18OVnwcZ4oQ3bWHnAz131TcW1n8eg88km/view?usp=share_link)
3. [Sekvenční diagram](https://drive.google.com/file/d/1Gv7bl2x3th5RoDMeJ6KssCU-NPyKIlDT/view?usp=share_link)

#### Návrh databáze
[logický a fyzický model](https://drive.google.com/file/d/1YboTmn5Dm6ru0hkTPTnthseM-RJ1VNsh/view?usp=share_link)

1. logický model
= data a vztahy mezi nimi
2. fyzický model
= podrobný popis dat včetně klíčů (viz tabulky)

Oba modely jsou nakonec spojeny do jednoho dokumentu.