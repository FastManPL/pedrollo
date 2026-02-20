# Plan działania – optymalizacja projektu Anima → WordPress

## Stan wyjściowy (z analizy)

- **~26 plików HTML** w wielu folderach eksportu Anima (`AnimaPackage-Flex-*`).
- **~44 pliki CSS** (w każdym pakiecie: `globals.css`, `styleguide.css`, pliki per-strona).
- Strony typu „all-breakpoints” mają **4 zduplikowane drzewa DOM** (360px, 768px, 1366px, 1920px), przełączane w CSS przez `display: none` w media queries.
- Przyciski tego samego wyglądu mają różne klasy (`button_to_white`, `button_to_white-2`, …).
- Teksty i obrazy na razie na sztywno w HTML; docelowo WordPress + ACF.

---

## Zasada ogólna: najpierw statyka, potem WordPress

Zgadza się – **najpierw doprowadzamy do porządku statyczne HTML/CSS**, a dopiero na końcu:
- wyciągamy header/footer jako komponenty,
- podpinamy WordPress (szablony, ACF).

Dzięki temu:
- mniej tokenów (jedna baza kodu),
- mniej ryzyka (WordPress nie blokuje refaktoru),
- łatwiej testować w przeglądarce bez WP.

---

## Kolejność etapów (optymalna)

**Zasada:** Najpierw doprowadzamy do porządku **każdą podstronę** (Faza 1 na wszystkich). Dopiero gdy wszystkie strony są ogarnięte (mobile + desktop działają), przechodzimy do Faz 2–6 (wspólne klasy, optymalizacja CSS, header/footer, WordPress).

---

### Faza 0: Ustalenie jednego „źródła prawdy” (minimalnie, bez dużego refaktoru)

- **Decyzja:** który folder eksportu Anima traktujemy jako główny (np. `AnimaPackage-Flex-hFF9f kopia org str gl` lub jeden konkretny `AnimaPackage-Flex-*`).
- **Działanie:** skopiować/połączyć brakujące podstrony z innych pakietów do jednego katalogu projektu (np. `build/` lub `static/`), żeby dalej pracować na jednym zestawie plików.
- **Efekt:** jedna struktura katalogów, jedna lista plików HTML do refaktoru. Unikamy rozproszenia i dublowania pracy.

---

### Faza 1: Ogarnięcie każdej podstrony (punkt 1) – **najpierw na wszystkich, potem Fazy 2–6**

**Cel:** Każda podstrona ma działający layout na mobile i desktop (bez rozjeżdżania). Strony „all-breakpoints” (4 bloki) → redukcja do **2 bloków** (mobile 360 + desktop 1366) + przełączanie w CSS, tak jak na dystrybutorze. Strony z jednym breakpointem – weryfikacja, że ładują się poprawnie.

**Wzorzec (strony all-breakpoints):**  
- HTML: zostawić blok 360 (mobile) i 1366 (desktop), usunąć 768 i 1920. Root mobile: `.page--NAZWA-mobile`, root desktop: `.page .page--NAZWA`.  
- CSS: `@media (max-width: 767px)` → style 360, ukryć desktop; `@media (min-width: 768px)` → style 1366, ukryć mobile.  
- Źródło: oryginalny plik z odpowiedniego pakietu Anima (v74Ij, TVr8o, egxs6, EWJUC itd.).

**Kolejność stron do ogarnięcia (Faza 1):**

| Strona | Plik | Typ | Uwagi |
|--------|------|-----|--------|
| Dystrybutor | `dystrybutor.html` | all-breakpoints | ✅ Zrobione (2 bloki) |
| Produkt | `produkt.html` | all-breakpoints | ✅ |
| Program partnerski | `program-partnerski.html` | all-breakpoints | ✅ |
| O nas | `onas.html` | all-breakpoints | ✅ |
| Blog | `blog.html` | all-breakpoints | ✅ |
| Dystrybutor rejestracja krok 1 | `dystrybutor-rejestracja-krok1.html` | all-breakpoints | ✅ |
| Strona główna | `index.html` | wieloblok | ✅ Faza 1 (2 bloki) |
| Kontakt | `kontakt.html` | 1366px | ✅ Faza 1 (2 bloki) |
| Blog wpis, FAQ, Polityka, Regulamin, Use case lista | odpowiednie .html | po 1 breakpoincie | ✅ viewport + styleguide/globals z pakietów |
| Laboratorium | `laboratorium.html` | placeholder | Pomijamy do uzupełnienia |

**Faza 1 zakończona.** Przechodzimy do Fazy 2 (wspólne klasy przycisków) – inwentaryzacja i mapowanie w **`zrodlo-prawdy/KLASY-CSS.md`**.

---

### Faza 2: Wspólne klasy dla przycisków i powtarzalnych elementów (punkty 3 i 6)

**Cel:** Jeden przycisk „biały” = jedna klasa (np. `.btn .btn--primary`), to samo dla innych powtarzających się elementów; mniej duplikacji w CSS i prostsze zarządzanie.

**Kolejność:**

1. **Inwentaryzacja:**  
   - zebrać wszystkie warianty przycisków (np. `button_to_white`, `button_to_dark_navi`, `krok`, `strefa_partnera`),  
   - ewentualnie: nagłówki, karty, listy (te same style, różne klasy typu `frame-6`, `frame-5`).
2. **Wprowadzić system klas:**  
   - np. `.btn`, `.btn--primary`, `.btn--secondary`, `.btn--outline`,  
   - mapowanie: stara klasa → nowa klasa (np. `button_to_white` + `button_to_white-2` → `.btn .btn--primary`).
3. **W globals.css (lub jednym pliku „komponentów”):**  
   - zdefiniować style dla `.btn`, `.btn--primary` itd.,  
   - usunąć lub zredukować zduplikowane bloki dla `button_to_white-*`.
4. **W HTML:** zamienić stare klasy na nowe (np. `<div class="button_to_white button_to_white-2">` → `<a class="btn btn--primary" href="…">` lub `<button class="btn btn--primary">`).
5. **Opcjonalnie:** to samo dla powtarzalnych sekcji (np. `.card`, `.section-title`) – najlepiej po ustabilizowaniu przycisków.

**Efekt:** Mniej tokenów przy dalszych zmianach (edycja w jednym miejscu), łatwiejsze późniejsze podpięcie ACF (np. „klasa przycisku” jako pole).

---

### Faza 3: Optymalizacja i konsolidacja CSS (punkt 4)

**Cel:** Mniej plików, mniej duplikacji, czytelna kolejność ładowania.

**Kolejność:**

1. **Jedna paleta i typografia:**  
   - jeden plik `styleguide.css` (lub wariant) z `:root`, fontami, kolorami – używany we wszystkich stronach.
2. **Jeden plik „globals”:**  
   - jeden `globals.css` z resetem, wspólnymi komponentami (np. `.btn`, `.screen`, `.hidden`), bez powielania między pakietami.
3. **Strony:**  
   - jeden plik CSS na stronę (np. `page-dystrybutor.css`, `page-blog.css`) lub grupowanie kilku małych podstron w jeden plik (np. `page-popup.css`).  
   - Usunąć duplikaty: jeśli kilka stron ma ten sam blok CSS – wyciągnąć do `globals.css` lub `components.css`.
4. **Kolejność w HTML:**  
   `styleguide.css` → `globals.css` → `components.css` (jeśli jest) → `page-*.css`.
5. **Minimalizacja (opcjonalnie):** na koniec buildu można łączyć i minifikować (np. skryptem), ale na etapie refaktoru wygodniej trzymać pliki czytelne.

**Efekt:** Jedna baza CSS, łatwiejsze szukanie i zmiany, mniej requestów przy późniejszym łączeniu.

**Stan konsolidacji (Faza 3):**
- **Kolejność CSS** – ujednolicona: `styleguide.css` → `styleguide-*.css` (wariant) → `globals.css` → `globals-*.css` (wariant) → (na rejestracja-krok1: `globals-JbcrW-full.css`) → plik strony.
- **Warianty muszą być ładowane.** Pliki `styleguide-*.css` i `globals-*.css` zawierają nie tylko `:root`, ale setki klas używanych w HTML. Linki do wariantów pozostają. Optymalizacja bez utraty styli: z **globals-hFF9f.css** usunięto duplikaty – blok `.overlay-base` + `@keyframes reveal` oraz reguły `.screen a`, `.hidden`, `* { box-sizing }` i `@import` (są w `globals.css` ładowanym wcześniej). Wariant zawiera tylko unikalne klasy (np. `.frame-3673268`, `.strefa_partnera`). Inne warianty (egxs6, TVr8o, JbcrW, EWJUC) nie miały overlay-base; ich treść pozostawiona.

---

### Faza 4: Przygotowanie pod WordPress – header i footer (punkt 5)

**Cel:** Header i footer jako osobne fragmenty, żeby w WordPressie wstawić je jako np. `header.php` / `footer.php` lub części szablonu.

**Zrobione:** Utworzono `zrodlo-prawdy/partials/header.html` i `partials/footer.html` (fragmenty z dystrybutor.html – wersja desktop). Opis granic i użycia w WP: `zrodlo-prawdy/HEADER-FOOTER.md`. Obecne pliki HTML nie są zmieniane – fragmenty służą jako wzorzec do szablonów WP.

**Kolejność:**

1. **Wyodrębnienie w HTML:**  
   - w jednej stronie referencyjnej zaznaczyć granice: od początku `<body>` do końca headera → `header.html` (lub tylko wewnętrzna część, bez `<html>`/`<head>`), od początka stopki do `</body>` → `footer.html`.
2. **Wspólna struktura strony:**  
   - szablon strony = `header` + `main` (zawartość strony) + `footer`.  
   - W statycznym HTML: np. `<div class="site-header">...</div>`, `<main class="page-content">...</main>`, `<div class="site-footer">...</div>`.
3. **Identyfikacja:**  
   - upewnić się, że header/footer są wizualnie i strukturalnie takie same na każdej podstronie (jeśli nie – ujednolicić wcześniej w Fazie 1/2).
4. **Dla WordPress:**  
   - przygotować pliki `header.php` i `footer.php` (zawierające tylko znacznik HTML + klasy używane w CSS),  
   - w szablonach stron: `get_header()`, treść, `get_footer()`.

**Efekt:** Na tym etapie nadal można testować statycznie (np. SSI, albo po prostu spójna struktura w każdym pliku), a podpięcie WP to zamiana bloków na `get_header()`/`get_footer()`.

---

### Faza 5: WordPress + ACF (punkt 2)

**Cel:** Strona jako szablon WordPress; teksty (i ewentualnie obrazy) z ACF.

**Kolejność:**

1. **Motyw / child theme:**  
   - stworzyć minimalny motyw z odpowiednimi plikami (np. `page.php`, `front-page.php`, szablony dla typów stron).
2. **Mapowanie treści:**  
   - lista bloków do podmiany: nagłówki, paragrafy, przyciski (tekst + link), listy.  
   - Dla każdego: pole ACF (np. „Hero – tytuł”, „Hero – opis”, „CTA – tekst”).
3. **W szablonach:**  
   - zamienić sztywne teksty na `<?php the_field('nazwa_pola'); ?>` (lub odpowiednie funkcje ACF).  
   - Zachować klasy CSS z Faz 1–3 (np. `btn btn--primary`).
4. **Header/Footer:**  
   - już jako `header.php`/`footer.php`; ewentualne linki w menu/stopce też z ACF lub z menu WP.

**Efekt:** Edycja treści z poziomu WordPress + ACF bez ruszania kodu; struktura i klasy pozostają z poprzednich faz.

---

### Faza 6: Optymalizacje dodatkowe (punkt 6 – ciąg dalszy)

- **Wspólne klasy dla sekcji:** np. `.section`, `.section--dark`, `.container`, żeby layout był spójny i łatwy do zmiany w jednym miejscu.
- **Uporządkowanie nazw klas:** stopniowe zastępowanie nazw z Figmy (`frame-367`, `frame-6482`) nazwami semantycznymi tam, gdzie to ułatwia pracę (np. `.hero`, `.benefits-list`); można robić stopniowo, strona po stronie.
- **Dokumentacja:** krótki plik (np. `KLASY-CSS.md`) z listą: przyciski, sekcje, typografia – żeby przy kolejnych zmianach nie szukać po całym projekcie.

---

## Podsumowanie kolejności

| Kolejność | Faza | Opis |
|-----------|------|------|
| 0 | Źródło prawdy | ✅ Jeden folder (`zrodlo-prawdy`), jedna lista plików |
| 1 | Ogarnięcie każdej podstrony | ✅ Zakończone: 2 bloki (mobile + desktop), viewport, styleguide/globals z pakietów. Szczegóły: `zrodlo-prawdy/LISTA-STRON.md`. |
| 2 | Wspólne klasy (przyciski, powtarzalne elementy) | ✅ Zakończone: `.btn`, `.btn--primary`, `.btn--secondary`, `.btn--dark`, `.btn--cta`, `.btn--cta-dark` w globals; wszystkie `button_to_*` i `call_button*` zamienione w HTML. Szczegóły: `zrodlo-prawdy/KLASY-CSS.md`. |
| **3** | **Optymalizacja CSS** | **Zakończona:** Martwe reguły przycisków usunięte. Strony ładują `styleguide.css` + wariant `styleguide-*.css` oraz `globals.css` + wariant `globals-*.css` (warianty zawierają klasy używane w HTML – nie można ich pominąć). |
| 4 | Header/Footer jako komponenty | W toku: partials/header.html i partials/footer.html + HEADER-FOOTER.md. Docelowo: header.php/footer.php w WP. |
| 5 | WordPress + ACF | Szablony, pola, edycja treści |
| 6 | Optymalizacje dodatkowe | Wspólne sekcje, nazewnictwo, dokumentacja |

---

## Jak oszczędzać tokeny przy realizacji

1. **Pracować strona po stronie:** każda strona to ten sam schemat (1 struktura, media queries, klasy). Po zrobzeniu pierwszej można używać krótkich instrukcji w stylu: „to samo co na dystrybutorze, plik X”.
2. **Najpierw jedna „wzorcowa” strona:** np. dystrybutor lub główna – na niej zrobić pełny przepływ (fazy 1–3), potem replikować na inne.
3. **Skrypty pomocnicze (opcjonalnie):**  
   - zamiana klas przycisków (np. sed/Node) według mapowania z Fazy 2;  
   - łączenie plików CSS w build step – mniej ręki, mniej opisów.
4. **Dokumentować decyzje w repozytorium:** np. `PLAN-DZIALANIA.md` (ten plik), `zrodlo-prawdy/KLASY-CSS.md` (inwentaryzacja przycisków i mapowanie Fazy 2) – w kolejnych chatach wystarczy odwołać się do tych plików zamiast opisywać wszystko od zera.

Jeśli chcesz, następny krok może być: **wybór folderu „źródła prawdy” i konkretna lista plików HTML do refaktoru (Faza 0 + początek Fazy 1)** – wtedy można od razu przejść do edycji pierwszej strony.
