# Plan migracji na WordPress (szablon statyczny)

Dokument opisuje kroki przeniesienia strony z plików HTML w `zrodlo-prawdy/` na szablon WordPress. **Treści na razie statyczne** – bez zarządzania treścią z poziomu WP (bloki, edytor itd.); to ewentualnie w kolejnej fazie.

---

## Stan wyjściowy (z instrukcji .md w projekcie)

- **LISTA-STRON.md** – lista 15 podstron głównych + komponenty (pop-upy, logowanie). Wszystkie pliki HTML gotowe (desktop + mobile).
- **index.html** – strona główna z sekcją **navbar** (mobile: `.mobile-header`, desktop: `.menu_2-3`) i **footer** (`.frame-78-3`).
- **HEADER-FOOTER.md** – Faza 4: fragmenty headera i stopki w `partials/header.html` i `partials/footer.html` (wersja desktop z dystrybutor.html). Partiale służą jako wzorzec pod `header.php` / `footer.php`.
- **Konwencje projektu** – menu i footer to **sekcje globalne**; na podstronach były/usuwane są z HTML i mają być dołączane wspólnie.
- **produkt.html** – przykład strony z usuniętym footerem i komentarzem: `<!-- footer usunięty – dołączany globalnie -->`.
- **STRATEGIA-CSS.md**, **FAZA1-INSTRUKCJA.md** – jedna struktura HTML, pliki CSS per strona (all-breakpoints), wspólne style w globals/styleguide.
- **KLASY-CSS.md** – wspólne klasy przycisków (`.btn`, `.btn--primary` itd.).
- **OPTIMIZATION.md** – PurgeCSS pod index; opcjonalnie minifikacja i łączenie plików.

---

## Cel

1. Działać jako **motyw WordPress** (theme).
2. **Sekcje globalne**: header (nawigacja desktop + mobile) i footer ładowane z jednego miejsca (`header.php`, `footer.php`).
3. **Treść statyczna**: każda podstrona = szablon WP, który wyświetla odpowiedni fragment HTML (bez Gutenberga/ACF na start).
4. **Ścieżki do zasobów**: CSS, JS, img przez `get_template_directory_uri()` (lub child theme).
5. Później: ewentualne włączenie zarządzania treścią (strony WP, menu, ACF itd.).

---

## Faza A: Przygotowanie struktury motywu WordPress

### A.1 Katalog motywu

Proponowana struktura (w repozytorium lub osobny katalog, np. `pedrollo-theme/`):

```
pedrollo-theme/
├── style.css                 # metadane motywu (Theme Name, opis, wersja)
├── functions.php             # enqueue CSS/JS, wsparcie dla menu WP (opcjonalnie)
├── index.php
├── header.php                # z partials/header.html + <head> + otwarcie <body>, wrapper
├── footer.php                # z partials/footer.html + zamknięcie wrappera, skrypty, </body></html>
├── front-page.php            # szablon strony głównej (treść z index.html bez header/footer)
├── page.php                  # domyślny szablon strony (fallback)
├── page-onas.php             # szablon „O nas” (opcjonalnie: nazwa po slugu)
├── page-kontakt.php
├── page-produkt.php
├── …                         # po jednym szablonie na podstronę lub mapowanie w page.php
├── template-parts/           # opcjonalnie: fragmenty treści (content-*.php)
├── css/                      # kopia/ link do css z zrodlo-prawdy
├── img/
├── js/                       # skrypty (menu, Flickity, konfigurator itd.)
└── partials/                 # ewentualnie kopie header/footer do podglądu (opcjonalnie)
```

**Uwaga:** Można trzymać CSS/img w `zrodlo-prawdy` i w theme tylko enqueue’ować ścieżki (np. do katalogu nadrzędnego), ale na produkcji zwykle kopiuje się zasoby do motywu lub do katalogu uploadów.

### A.2 style.css (metadane motywu)

Minimum do rozpoznania przez WordPress:

```css
/*
Theme Name: Pedrollo Polska
Theme URI: ...
Description: Szablon statyczny Pedrollo (header/footer globalne, treść z HTML).
Version: 1.0.0
*/
```

### A.3 functions.php

- **Enqueue stylów**: styleguide, globals, pedrollou95polskau95mainu953, potem arkusz specyficzny dla strony (np. na podstawie `body_class()` lub szablonu).
- **Enqueue skryptów**: jQuery (jeśli używany), Flickity, jQuery UI, launchpad.js, własne skrypty (menu mobile, FAQ, konfigurator).
- **Ścieżki**: `get_template_directory_uri() . '/css/...'`, `get_template_directory_uri() . '/img/...'`.
- Opcjonalnie: `add_theme_support('title-tag')`, menu rejestracja (`register_nav_menus`) – na później, gdy będą linki z WP.

---

## Faza B: Sekcje globalne (header i footer)

### B.1 header.php

- Zawartość `<head>` (charset, viewport, favicon, meta og/twitter).
- Wywołanie `wp_head()` (na końcu `<head>`).
- Linki do CSS (przeniesione z index/podstron lub przez `wp_enqueue_style` w functions.php).
- Otwarcie `<body>`, ewentualnie wrapper strony (np. `<div class="page page--??? screen">` – klasa strony może być ustawiana w szablonie).
- **Treść headera**:
  - Wersja **mobile**: `.mobile-header` (logo + hamburger) – z index.html.
  - Wersja **desktop**: odpowiednik `partials/header.html` (np. `.menu_2-2` z dystrybutor lub `.menu_2-3` z index – ujednolicenie klas według HEADER-FOOTER.md).
- W partials są ścieżki `img/...` – w WP zamienić na `<?php echo get_template_directory_uri(); ?>/img/...`.

**Uwaga:** Na różnych podstronach w HTML występują klasy typu `menu_2-2`, `menu_2-3`, `frame-78`, `frame-78-2`, `frame-78-3`. W WP warto **ujednolicić** jeden zestaw klas (np. z index lub z dystrybutor) i używać go w header.php/footer.php, żeby jeden zestaw CSS stylował header/footer na wszystkich stronach.

### B.2 footer.php

- Treść stopki: odpowiednik `partials/footer.html` (np. `.frame-78-2`).
- Ścieżki do obrazów: `get_template_directory_uri() . '/img/...'`.
- Zamknięcie wrappera strony (np. `</div>`).
- Skrypty (np. jQuery, Flickity, własne) – albo w footerze, albo przez `wp_footer()`.
- `wp_footer()` (przed `</body>`).
- `</body></html>`.

### B.3 Wspólny wrapper strony

- W **header.php** po otwarciu `<body>`: np. `<div class="page page--<?php echo esc_attr( $page_slug_or_class ); ?> screen">` (zmienna ustawiana w szablonie lub przez `body_class()`).
- W **footer.php** przed skryptami: `</div>` zamykający ten wrapper.
- Dzięki temu każda podstrona może mieć inną klasę `.page--onas`, `.page--produkt` itd., co już jest w CSS.

---

## Faza C: Mapowanie stron na szablony WP

### C.1 Strona główna

- **front-page.php**: zawiera tylko **treść** z index.html (bez `<head>`, bez bloku header, bez bloku footer). Czyli sekcja hero (`#header`), ewentualnie slider, sekcje poniżej – do miejsca przed stopką. Wywołania: `get_header()` na górze, `get_footer()` na dole.

### C.2 Podstrony

Opcja 1 (prostsza na start): **jeden page.php** z warunkiem – np. po slugu strony (`get_post_field('post_name')`) lub po ID – include’uje odpowiedni fragment HTML (np. `template-parts/content-onas.php`, `content-kontakt.php`). W każdym takim fragmencie: tylko treść (bez header/footer).

Opcja 2: **osobny szablon na podstronę**: `page-onas.php`, `page-kontakt.php`, `page-produkt.php` itd. W każdym: `get_header()`, zawartość strony (skopiowana z odpowiedniego .html), `get_footer()`.

Mapowanie (z LISTA-STRON.md):

| Podstrona           | Plik HTML              | Szablon WP (propozycja)   |
|---------------------|------------------------|----------------------------|
| Strona główna       | index.html             | front-page.php             |
| O nas               | onas.html              | page-onas.php lub content-onas |
| Kontakt             | kontakt.html           | page-kontakt.php           |
| Laboratorium        | laboratorium.html      | page-laboratorium.php      |
| Use Case (poj.)     | usecase.html           | single-usecase lub page-usecase |
| Program partnerski  | program-partnerski.html| page-program-partnerski.php|
| Produkt             | produkt.html           | page-produkt.php           |
| Dystrybutor         | dystrybutor.html       | page-dystrybutor.php       |
| Dystrybutor rejestr.| dystrybutor-rejestracja-krok1.html (2, podziękowanie) | page-rejestracja-krok1.php itd. |
| Blog                | blog.html              | home.php lub page-blog.php |
| Blog wpis           | blog-wpis.html         | single.php                 |
| FAQ                 | faq.html               | page-faq.php               |
| Polityka prywatności| polityka-prywatnosci.html | page-polityka-prywatnosci.php |
| Regulamin           | regulamin.html         | page-regulamin.php         |
| Use case lista      | usecase-lista.html     | page-usecase-lista.php     |

### C.3 Wyciąganie „tylko treści” z istniejących HTML

Dla każdej podstrony:

1. Otwórz plik .html (np. `onas.html`).
2. **Usuń**: `<!DOCTYPE>`, `<html>`, `<head>…</head>`, `<body>`, otwierający `<div class="page ...">`, cały blok **headera** (mobile + desktop: `.mobile-header`, `.menu_2-*` lub odpowiednik), cały blok **footera** (`.frame-78*` lub odpowiednik).
3. **Zostaw**: tylko wewnętrzną treść strony (np. od pierwszego `<div class="frame-...">` specyficznego dla treści do ostatniego przed footerem).
4. Zapisz jako fragment do wklejenia do szablonu WP (np. `template-parts/content-onas.php`) lub wklej do `page-onas.php` między `get_header()` a `get_footer()`.

Strony, na których jest już komentarz typu „footer usunięty – dołączany globalnie” (np. produkt.html), mają footer już usunięty; wystarczy wyciągnąć header (jeśli jeszcze jest w pliku) i oznaczyć granice treści.

---

## Faza D: Zastępowanie sekcji globalnych w plikach źródłowych (zrodlo-prawdy)

Cel: w każdym .html **nie** trzymać pełnej kopii headera i footera, tylko miejsce na wstawkę (dla podglądu statycznego można zostawić komentarz lub jeden wspólny include, jeśli używasz np. prostego SSI lub build step).

- **Opcja A (bez build):** W plikach .html w `zrodlo-prawdy/` zostawiasz obecny stan: część stron z pełnym headerem/footerem (np. index, dystrybutor), część z komentarzem. W WP i tak używamy tylko fragmentów treści wyciągniętych do szablonów; pliki .html służą jako źródło prawdy do „wycinania” contentu i do podglądu przed WP.
- **Opcja B (z build / SSI):** Przed wdrożeniem do WP możesz w katalogu `zrodlo-prawdy/` zastąpić bloki header/footer znacznikiem, np. `<!--#include virtual="partials/header.html" -->`, i generować pełne HTML przez narzędzie (np. SSI przy serwerze lub skrypt Node), żeby mieć spójność z WP (jeden header/footer). To opcjonalne.

Rekomendacja na teraz: **Opcja A**. W WP szablony ładują header/footer z `header.php`/`footer.php`. W `zrodlo-prawdy/` dopilnuj tylko, żeby w dokumentacji było widać, które sekcje uznajemy za globalne (header, footer) i że w WP są one wstawiane z jednego miejsca.

---

## Faza E: Zasoby (CSS, JS, img)

- **CSS**: Skopiować do motywu (np. `pedrollo-theme/css/`) pliki: styleguide.css, styleguide-hFF9f.css, globals.css, globals-hFF9f.css, pedrollou95polskau95mainu953.css oraz pliki per strona (pedrollou95faq.css, pedrollou95produkt-all-breakpoints.css itd.). W functions.php enqueue’ować:
  - wspólne (styleguide, globals, main) na wszystkich stronach;
  - arkusz strony – warunkowo (np. po `body_class()` lub po szablonie).
- **JS**: jQuery (CDN lub z theme), Flickity, jQuery UI, launchpad.js, skrypty własne (menu, pop-upy, konfigurator) – enqueue w functions.php (header lub footer).
- **Obrazy**: Skopiować `img/` do motywu; w header.php/footer.php i w szablonach zamienić `img/` na `<?php echo get_template_directory_uri(); ?>/img/`.
- **Fonty**: Zgodnie z LISTA-STRON – fonty z zewn. CDN; jeśli w CSS są odwołania do lokalnych fontów, dodać je do theme (np. `fonts/`).

---

## Faza F: Menu i linki (na później, opcjonalnie)

- Linki w headerze i footerze na razie **statyczne** (href do odpowiednich stron).
- Gdy będzie gotowe zarządzanie treścią: zamiana na `wp_nav_menu()` lub ACF, wtedy w header.php/footer.php podmieniasz listy linków na wywołania WP.

---

## Kolejność realizacji (skrót)

1. **Stworzenie struktury motywu** – katalog, style.css, functions.php, index.php, header.php, footer.php (Faza A, B).
2. **Przeniesienie headera i footera** – konwersja partials na header.php/footer.php z ujednoliconymi klasami i ścieżkami (Faza B).
3. **front-page.php** – wyciągnięcie treści z index.html (bez header/footer), wstawienie między get_header() a get_footer() (Faza C).
4. **Jedna podstrona pilotażowa** – np. kontakt lub FAQ: page-kontakt.php + content z kontakt.html/faq.html (Faza C).
5. **Pozostałe szablony stron** – po kolei lub szablonem (page-onas, page-produkt itd.) (Faza C).
6. **Przeniesienie CSS/JS/img** do motywu i enqueue (Faza E).
7. **Testy** – wszystkie podstrony otwierają się z poprawnym headerem/footerem i stylami.
8. **Dokumentacja** – aktualizacja LISTA-STRON.md lub osobny plik (np. WORDPRESS-MAPOWANIE.md) z listą szablonów i plików HTML źródłowych.

---

## Pliki do aktualizacji po migracji

- **LISTA-STRON.md** – dodać sekcję „Faza WordPress” z mapowaniem: plik HTML → szablon WP, informacja że header/footer są w header.php/footer.php.
- **HEADER-FOOTER.md** – dopisać, że docelowo używane są header.php i footer.php z ujednoliconymi klasami; partials/ pozostają jako wzorzec/wersja do podglądu.
- **.cursor/rules/project-conventions.mdc** – już mówi o sekcjach globalnych (menu, footer); można dodać zdanie, że w WordPress są one wstawiane z header.php/footer.php.

---

## Podsumowanie

| Etap | Działanie |
|------|-----------|
| A | Struktura motywu (katalog, style.css, functions.php, header.php, footer.php) |
| B | Sekcje globalne: konwersja partials → header.php/footer.php, ujednolicenie klas, ścieżki `get_template_directory_uri()` |
| C | Mapowanie stron: front-page + page-*.php (lub page.php + template-parts), wyciągnięcie „tylko treści” z każdego .html |
| D | (Opcjonalnie) W zrodlo-prawdy zastąpić powtarzające się bloki komentarzem/include – lub zostawić jako źródło do wycinania |
| E | Zasoby: CSS, JS, img w theme + enqueue i zamiana ścieżek |
| F | (Później) Menu/linki z WP (wp_nav_menu, ACF) |

Treść na razie **statyczna** w szablonach; zarządzanie treścią (strony WP, wp_nav_menu, ACF) – w kolejnej fazie.
