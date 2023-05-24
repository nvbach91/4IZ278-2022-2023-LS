# Cross Mile
----------------
## Popis aplikace
>Aplikace pro správu závodů, uživatelů a registrací uživatelů na závody.
Ověření uživatele probíhá pomocí OAuth2 serveru Google a SK Míle, nebo pomocí potvrzovacího odkazu v e-mailu.
Při absenci OAuth2 je vytváření účtů chráněno Google reCaptcha V2.
Přihlašování do aplikace pomocí OAuth2 serverů nebo pomocí jména a hesla.  
Správa aplikace na základě jemně nastavitelné ACL bitmapy rozšířením funkčnosti běžných stránek.  
Aplikace je připravena v byznys kvalitě vhodná a určená k nasazení do reálného provozu.  
Vytvořeno jako demonstrační PHP projekt s převažujícím Server Side Rendering a pouze nezbytným množstvím JS.

### Architektura
| | |
| ------ | ------ |
| webový server | NGINX 1.14 (SSL + HTTP/2)|
| back-end | PHP 7.4|
| databáze| MySQL 8.0|
| cache| Redis 5.0|
| front-end | HTML5, CSS, pure JavaScript, Bootstrap 5|

#### Webserver
>Pro ověřenou spolehlivost, vysoký výkon a dobrou podporu HTTP/2 byl vybrán NGINX server.  
SSL certifikát pochází od LetsEncrypt a server je nakonfigurován tak, aby permanentně přesměrovával nešifrovaný provoz na šifrovanou verzi.  
V nastavení jsou použity obvyklé optimalizace bezpečnosti a výkonu dle Best Practices jako HSTS, povolení pouze TLSv1.2 TLSv1.3, 4kb Diffie-Hellman prvočíslo a podobně.

#### Databázový model
>Aplikace se opírá o kvalitní a komplexní datový model s využitím všech možností moderních databázových systémů.
Celý model je normalizován, vazby mezi tabulkami používají cizí klíče, datová pole jsou optimalizována vůči ukládaným datům i zarovnávání C struktur.  
Všechna relevantní pole s dynamickými daty používají CONSTRAINTS CHECKS a další kontroly a úpravy dat zajišťují TRIGGERS.  
Údržbu tabulek zajišťují procedury spouštěné interním databázovým plánovačem.  
Model je připraven na další využití a svým rozsahem přesahuje zbytek aplikace a umožňuje tak její další vývoj.

#### Asynchronní zpracování
>Jako každá byznys aplikace i tato zaznamenává přihlášení uživatelů i neúspěšné pokusy a pro lepší použitelnost dat provádí jak překlad IP pomocí reverzní DNS, tak dohledání geolokace pomocí lokalizační služby.  
Oboje je časově velmi náročné, mnohdy ve stovkách ms, proto jsou obě činnosti prováděny asynchronně pomocí konzolového programu v PHP, spouštěnému z crontab.  
Výsledky dotazů geolokační služby jsou masivně kešovány pomocí Redisu.