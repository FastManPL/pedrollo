# Checklista podstron do przeniesienia (WordPress)

Lista brakujących podstron z **źródła prawdy** (`zrodlo-prawdy/*.html`) do motywu **pedrollo-theme**. Dla każdej: szablon `page-{slug}.php` (lub `single.php`), `template-parts/content-{slug}.php`, ewentualnie sekcje globalne.

---

## Legenda

- **Slug WP** – slug strony w WordPress (np. `program-partnerski`).
- **CSS** – już w `pedrollo_get_page_css()` i `pedrollo_screen_class()`.
- **Sekcje globalne** – gdzie wstawić: `global-logotypy`, `global-instalator`, `global-referencje`, `global-dolacz-do-programu`, `global-dolacz-do-programu-dystrybutor`.

---

## Etap 1 – Strony prawne i listy (bez / z minimalnymi sekcjami globalnymi)

| # | Podstrona           | Slug WP               | Plik HTML                  | Szablon WP                      | Content part              | Sekcje globalne | Status |
|---|---------------------|------------------------|-----------------------------|---------------------------------|---------------------------|-----------------|--------|
| 1 | Polityka prywatności| `polityka-prywatnosci` | polityka-prywatnosci.html   | page-polityka-prywatnosci.php   | content-polityka-prywatnosci.php | — | ☑ |
| 2 | Regulamin           | `regulamin`            | regulamin.html              | page-regulamin.php              | content-regulamin.php     | —               | ☑ |
| 3 | Use case lista      | `usecase-lista`        | usecase-lista.html          | page-usecase-lista.php          | content-usecase-lista.php | referencje na dole | ☑ |

---

## Etap 2 – Blog (lista + pojedynczy wpis)

| # | Podstrona | Slug WP   | Plik HTML  | Szablon WP   | Content part      | Sekcje globalne | Status |
|---|-----------|-----------|------------|--------------|-------------------|-----------------|--------|
| 4 | Blog (lista) | `blog`  | blog.html  | page-blog.php | content-blog.php  | referencje na dole | ☑ |
| 5 | Blog wpis  | (single post) | blog-wpis.html | single.php | content-blog-wpis.php | — | ☑ |

---

## Etap 3 – Program partnerski, Produkt, Laboratorium (z sekcjami globalnymi)

| # | Podstrona        | Slug WP             | Plik HTML           | Szablon WP                 | Content part               | Sekcje globalne | Status |
|---|------------------|---------------------|---------------------|----------------------------|----------------------------|-----------------|--------|
| 6 | Program partnerski | `program-partnerski` | program-partnerski.html | page-program-partnerski.php | content-program-partnerski.php | referencje na dole; linki w CTA → /dystrybutor/, /program-partnerski/ | ☑ |
| 7 | Produkt          | `produkt`           | produkt.html         | page-produkt.php           | content-produkt.php        | referencje na dole | ☑ |
| 8 | Laboratorium     | `laboratorium`      | laboratorium.html    | page-laboratorium.php      | content-laboratorium.php   | referencje na dole | ☑ |

---

## Etap 4 – Use case (pojedynczy)

| # | Podstrona       | Slug WP   | Plik HTML  | Szablon WP        | Content part        | Sekcje globalne | Status |
|---|-----------------|-----------|------------|-------------------|---------------------|-----------------|--------|
| 9 | Use case (poj.) | `usecase` | usecase.html | page-usecase.php | content-usecase.php | referencje na dole | ☑ |

**Uwaga:** Use case pojedynczy w WP może być stroną z slugiem `usecase` (np. szablon dla konkretnej strony) lub custom post type – na start: zwykła strona + page-usecase.php (treść statyczna z usecase.html).

---

## Weryfikacja po przeniesieniu (każda podstrona)

- [ ] W WordPress: utworzona strona z odpowiednim **slugiem** (np. `program-partnerski`).
- [ ] Szablon ładuje się (page-{slug}.php lub single.php).
- [ ] Arkusz CSS strony ładuje się (sprawdzić w DevTools: `pedrollou95*.css`).
- [ ] Klasa wrappera: `.page--{klasa}` i `.screen.{screen-class}` (w header.php z `pedrollo_page_class()` / `pedrollo_screen_class()`).
- [ ] Obrazy: ścieżki `get_template_directory_uri() . '/img/...'`.
- [ ] Linki wewnętrzne: `home_url( '/slug/' )` (np. `/dystrybutor/`, `/program-partnerski/`).
- [ ] Sekcje globalne (logotypy, instalator, referencje, dołącz do programu) wstawione zgodnie z tabelą.
- [ ] Header i footer wyświetlają się (get_header() / get_footer()).

---

## Mapowanie slug → klasa strony (functions.php)

W `pedrollo_page_class()` już jest: `'o-nas' => 'onas'`. Pozostałe slugi zwracane są jako klasa bez zmiany (np. `program-partnerski` → `program-partnerski`). Dla single post zwracane jest `blog-wpis`. Nie trzeba dodawać nowych wpisów do tej mapy dla nowych podstron.
