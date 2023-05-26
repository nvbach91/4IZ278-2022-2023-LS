# OndryFans

DEPLOYMENT:
```bash
php vendor/dg/ftp-deployment/src/deployment.php -t config/deploy/deployment.dev.php
```

## Stručný popis aplikace

Aplikace OndryFans je jednoduchá sociální síť s jasným účelem. Propojit Ondřeje Tölga s jeho miliony fanoušků napřímo. Ondřej Tölg totiž
nemá příliš v oblibě mainstreamové sociální sítě jako je Facebook, Instagram, nebo nedejbože OnlyFans. Proto se rozhodl
vyvořit vlastní jednoduchou a bezpečnou platformu, ne které může sdílet své fotky a myšlenky a může vést diskuse a debazty
se svými fanoušky, kterých je nepřeberné množství.

## Popis funkcionality

- Aplikace bude defacto one-page aplikace s dynamickým obsahem
  - hlavní stránka je stránka s příspěvky od Ondřeje, nahoře se zobrazuje vždy nejnovější příspěvek, při scrollování dolů se asyncrhonně donačítají starší příspěvky
  - u příspěvku je vždy fotka, popisek, sekce s liky a komentáři
  - pro přihlášení fanouška bude vyvoláno modální okno a následně Facebook OAuth proces

- V aplikaci budou dva typy uživatelů
  - `Admin` - Ondřej - který může jako jediný přidávat příspěvky, mazat komentáře atd.
  - `User` - Fanoušek - který může přidávat komentáře, likovat příspěvky

### Uživatel typu `user`

- může příspěvky prohlížet i jako nepřihlášený
- chce-li podnikat jinou aktivitu než je prohlížení příspěvků, je vyzván k přihlášení pomocí Facebook OAuth
- po přihlášení má možnost
  - psát komentáře
  - dávat liky
  - psát do vlákna komentáře

### Uživatel typu `admin`

- pro přihlášení do aplikace klikne na skrytý odkaz někde na stránce, o tomto odkazu ví jenom on
- po přihlášení má možnost
  - editovat příspěvky (možnost se mu zobrazí nahoře na stránce s příspěvky)
  - editovat štítky
  - mazat komentáře

## Usecase diagram

- [Usecase diagram](https://drive.google.com/file/d/1pEPJSDIvbqcnPiXQ98CZOylAwT4t-pxI/view?usp=sharing)

## Stránky / stavy aplikace + wireframy

1. Výpis příspěvků / HP / hlavní stránka \[[wireframe](https://drive.google.com/file/d/1DfvtZPkl8mGQAcGpxeUQtZH4QHn3GZC7/view?usp=sharing)\]
2. Možné situace komentářů \[[wireframe](https://drive.google.com/file/d/131iOmJVhEmChq_Ji6203wayCGQ1HfRcC/view?usp=sharing)\]
3. Login modal fanouška \[[wireframe](https://drive.google.com/file/d/1DUjEWJN1YFMD_DXO_Fv2kwM2cNq5Z-FG/view?usp=sharing)\]
4. Login modal admina \[[wireframe](https://drive.google.com/file/d/1JDTCbE8nK7Xn0tWSDXwKMMTYaKbdmCjQ/view?usp=sharing)\]
5. Admin pohled výpisu a možnost přidat příspěvek \[[wireframe](https://drive.google.com/file/d/15-S5Lu1HOvZIix8KYzgS_0OIjyYnJ6t_/view?usp=sharing)\]
6. Editace příspěvku a štítku \[[wireframe](https://drive.google.com/file/d/1vma1dy9c_tN8EjoNY2qKe6ALo3BtjP61/view?usp=sharing)\]

## Architektura

- Webserver: Apache
- Backend: PHP 8
- Databáze: MySQL
- BE Knihovny:
  - [Nette](https://nette.org/cs/)
  - [Doctrine](https://www.doctrine-project.org/) - pro práci s databází
  - [League/oauth2-facebook](https://packagist.org/packages/league/oauth2-facebook) - pro FB oauth
- FE knihovny:
  - [Foundation framework](https://get.foundation/)
  - [jQuery](https://jquery.com/)
  - [Nette Forms](https://github.com/nette/forms)
  - [Naja](https://github.com/naja-js/naja) - pro AJAX

## Návrh databáze

- [Logický model](https://drive.google.com/file/d/1wMbF8-u5np3MRqIebb8GzeVG-MAPmQQW/view?usp=sharing)
- [Fyzický model](https://drive.google.com/file/d/1MGd3qIPFpMgwF8JCc-qlKRz91TbSVt8b/view?usp=sharing)

## Procesní diagram

- [Procesní diagram](https://drive.google.com/file/d/1E1ynbVnUx3nQ9XbkMvYmDDhWtn__0GbL/view?usp=sharing)

## Sekvenční diagram

- [Sekvenční diagram](https://drive.google.com/file/d/1wdPCwJI68AB2C1x4O8DfcUgX5fGrEdrd/view?usp=sharing)
