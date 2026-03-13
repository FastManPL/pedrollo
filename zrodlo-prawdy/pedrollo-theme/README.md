# Motyw Pedrollo Polska (WordPress)

Szablon statyczny – header i footer ładowane globalnie z `header.php` / `footer.php`. Treść stron z plików HTML w `zrodlo-prawdy/`.

## Wymagania

- WordPress z ustawioną stroną główną (Ustawienia → Czytanie → Strona główna) oraz stroną wpisów (opcjonalnie).
- W **Ustawienia → Odnośniki bezpośrednie** ustaw slugi stron zgodnie z mapowaniem (np. `faq`, `o-nas`, `kontakt`).

## Instalacja zasobów

**Przed użyciem motywu** skopiuj z katalogu `zrodlo-prawdy/` do katalogu motywu:

- **css/** – cały folder (styleguide, globals, pedrollou95*, pop-up-instalator.css itd.)
- **img/** – cały folder (obrazki, ikony, logo)

```bash
# Z poziomu katalogu zrodlo-prawdy/
cp -r css pedrollo-theme/
cp -r img pedrollo-theme/
```

Opcjonalnie **js/** – jeśli powstaną osobne skrypty (menu mobile, konfigurator) – skopiuj do `pedrollo-theme/js/`.

## Szablony

| Plik               | Użycie (slug strony w WP)     |
|--------------------|-------------------------------|
| front-page.php     | Strona główna                 |
| page-faq.php       | FAQ (`faq`)                  |
| page-kontakt.php   | Kontakt (`kontakt`)           |
| page-dystrybutor.php | Dystrybutor (`dystrybutor`) |
| page-onas.php      | O nas (`onas`)                |
| page-o-nas.php     | O nas (`o-nas` – domyślny slug WP) |
| page.php           | Domyślny szablon strony       |
| index.php          | Fallback                      |

Kolejne podstrony: dodać `page-{slug}.php` (np. `page-onas.php`, `page-kontakt.php`) i odpowiedni `template-parts/content-{slug}.php` z treścią z odpowiedniego pliku HTML.

## Mapowanie CSS

W `functions.php` w `pedrollo_get_page_css()` jest mapowanie slug → plik CSS. Nowe strony dodać do tablicy `$map`.

## Sekcje globalne

- **header.php** – `<head>`, otwarcie `<body>`, wrapper `.page`, mobile header, nawigacja desktop (menu_2-2).
- **footer.php** – stopka (frame-78-2), zamknięcie wrappera, `wp_footer()`.

Treść między headerem a footerem pochodzi z szablonu strony (front-page, page-faq itd.) lub z `template-parts/content-*.php`.

## Strona główna

Obecnie: hero (sekcja #header) + komentarz z miejscem na resztę treści z index.html (linie 161–2908). Pełną treść można przenieść do `template-parts/content-front-page.php` lub wstawić do `content-hero.php`.

## Strona FAQ

Treść w `template-parts/content-faq.php` – skrócona wersja pytań (7 pozycji). Pełną listę z faq.html można dopisać do tablicy `$faq_items` lub wkleić cały HTML z zamianą `img/` na `<?php echo esc_url( get_template_directory_uri() ); ?>/img/`.

---

## Gdy strona wygląda inaczej niż HTML (błędy, brak stylów)

1. **Strona główna**  
   W **Ustawienia → Czytanie** ustaw „Strona główna” na wybraną stronę (np. „Strona główna”). Dzięki temu WordPress używa `front-page.php` zamiast listy wpisów.

2. **Style bloków WordPress**  
   Motyw wyłącza style Gutenberga (`wp-block-library`, `global-styles`), żeby nie psuły layoutu. Jeśli coś nadal nadpisuje style, sprawdź w przeglądarce (F12 → zakładka „Sieć”), czy wszystkie pliki CSS z motywu ładują się (status 200).

3. **Brak folderów css / img w motywie**  
   W katalogu motywu (np. `wp-content/themes/pedrollo-theme/`) muszą być podkatalogi **css** i **img** z plikami skopiowanymi z `zrodlo-prawdy`. Jeśli wgrywałeś motyw jako ZIP, spakuj cały folder `pedrollo-theme` (wraz z css i img), a dopiero potem wgraj archiwum.

4. **Wielkość liter w nazwach plików**  
   Na serwerze Linux nazwy plików są rozróżniane (np. `styleguide-hFF9f.css` vs `styleguide-hff9f.css`). Upewnij się, że na serwerze nazwy plików CSS są takie jak w oryginalnym motywie.

5. **Konsola i sieć**  
   Otwórz DevTools (F12) → zakładka „Sieć”. Odśwież stronę i zobacz, które żądania mają status 404 (brak pliku). To wskaże brakujące CSS, obrazy lub skrypty.
