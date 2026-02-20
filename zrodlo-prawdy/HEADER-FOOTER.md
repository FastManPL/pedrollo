# Header i footer – Faza 4 (przygotowanie pod WordPress)

Fragmenty headera i stopki wyodrębnione do osobnych plików, żeby w WordPressie można je wstawiać jako `header.php` i `footer.php`.

---

## Gdzie dopracowywać: partiale czy pełna strona?

**Rekomendacja: dopracowuj header i footer na pełnej stronie** (np. `dystrybutor.html` lub `index.html`), a **nie** w plikach `header.html` / `footer.html`.

- **Partiale** (`header.html`, `footer.html`) to tylko fragmenty HTML – **bez** `<head>` i CSS. Otwierane w przeglądarce widać jako „goły” tekst. Służą jako wzorzec pod WP, nie do edycji wizualnej.
- **Pełna strona** ładuje style, więc widzisz prawdziwy wygląd. Wszystkie klasy (np. `menu_2-2`, `frame-78-2`) są tam stylowane. Edytując np. `dystrybutor.html`, zmieniasz header i footer w kontekście całej strony.
- **Gdy skończysz dopracowanie** jednej strony wzorcowej – z niej ponownie wyciągniemy zaktualizowany header i footer do `partials/` (albo od razu do `header.php` / `footer.php` w WordPressie).

**Podgląd partiali ze stylami:** otwórz w przeglądarce plik **`partials/partials-preview.html`** (ścieżki do CSS i img są względem katalogu `zrodlo-prawdy/`). Zobaczysz header + placeholder + footer. Do faktycznego dopracowania i tak lepiej pracować na pełnej stronie (np. dystrybutor.html).

---

## Pliki

| Plik | Zawartość | Źródło |
|------|-----------|--------|
| **partials/header.html** | Nawigacja desktop (logo, menu, telefon, „Dobierz pompę”) | `dystrybutor.html`, blok `.page.page--dystrybutor`, element `.menu_2-2` |
| **partials/footer.html** | Stopka desktop (Polska, Strefa partnera, linki, kontakt, social, copyright) | `dystrybutor.html`, blok `.page.page--dystrybutor`, element `.frame-78-2` |

Ścieżki do obrazów w fragmentach: `img/...` (względem katalogu strony). W motywie WP użyj np. `<?php echo get_template_directory_uri(); ?>/img/...`.

---

## Granice na stronie referencyjnej (dystrybutor.html)

- **Header (desktop):** od początku `<div class="menu_2-2">` do końca tego diva (nawigacja z logo, rozwijane menu, przycisk CTA, „Dobierz pompę”).
- **Footer (desktop):** od początku `<div class="frame-78-2">` do końca tego diva (ciemna sekcja z tekstem „Polska”, linkami w kolumnach, danymi kontaktowymi, ikonami social, copyright).

Na stronach all-breakpoints header i footer występują **dwa razy** (blok mobile i blok desktop). Fragmenty w `partials/` odpowiadają wersji **desktop**. Wersja mobile (hamburger `menu_2`, uproszczona stopka) pozostaje w pełnym HTML każdej strony.

---

## Użycie w WordPress

1. **header.php** – w motywie: `<!DOCTYPE html>`, `<html>`, `<head>` (meta, style), `</head>`, `<body>`, ewent. `<div class="page page--NAZWA screen">` (wrapper strony), potem zawartość `partials/header.html` (lub jej odpowiednik z `get_template_part('partials/header')`).
2. **Treść strony** – w szablonie (np. `page.php`, `front-page.php`): pętla, treść, ACF.
3. **footer.php** – zawartość `partials/footer.html`, potem `</div>` (zamknięcie wrapera), skrypty, `</body>`, `</html>`.

Obecne pliki HTML w `zrodlo-prawdy/` **nie są** zmieniane – nadal zawierają pełną strukturę (mobile + desktop). Fragmenty służą jako wzorzec do zbudowania szablonów WP.

---

## Uwagi

- Na innych podstronach (index, kontakt, blog itd.) klasy headera/footera mogą mieć sufiksy (np. `menu_2-3`, `frame-78`). W WP warto ujednolicić na jeden zestaw klas lub dopuścić warianty w zależności od szablonu.
- Linki w stopce (O nas, Kontakt, Blog itd.) w WP można podmienić na `<?php wp_nav_menu(); ?>` lub pola ACF.
