# Źródło prawdy – lista stron i plików

Folder **`zrodlo-prawdy/`** jest jednym miejscem pracy dla wszystkich podstron przed przeniesieniem na WordPress.

---

## Podstrony główne (15)

| # | Nazwa podstrony        | Plik HTML                          | Uwagi |
|---|------------------------|-------------------------------------|-------|
| 1 | Strona główna          | `index.html`                        | Źródło: hFF9f – pedrollou95polskau95mainu953 |
| 2 | O nas                  | `onas.html`                         | Źródło: EWJUC – all-breakpoints |
| 3 | Kontakt                | `kontakt.html`                      | Źródło: bcAa9 – 1366px |
| 4 | Laboratorium           | `laboratorium.html`                 | **Placeholder** – brak eksportu z Anima; do uzupełnienia |
| 5 | Use Case (pojedynczy)  | —                                   | Brak w eksportach; ewentualnie dodać później lub użyć szablonu z listy |
| 6 | Program partnerski     | `program-partnerski.html`           | Źródło: egxs6 – all-breakpoints |
| 7 | Produkt                | `produkt.html`                      | Źródło: v74Ij – all-breakpoints |
| 8 | Dystrybutor            | `dystrybutor.html`                  | Źródło: v74Ij – all-breakpoints |
| 9 | Dystrybutor rejestracja | `dystrybutor-rejestracja-krok1.html`, `dystrybutor-rejestracja-krok2.html`, `dystrybutor-rejestracja-podziekowanie.html` | Źródło: JbcrW (krok 1 all-breakpoints, krok 2, podziękowanie) |
| 10 | Blog                   | `blog.html`                         | Źródło: TVr8o – all-breakpoints |
| 11 | Blog wpis              | `blog-wpis.html`                    | Źródło: hFF9f |
| 12 | FAQ                    | `faq.html`                          | Źródło: TVr8o |
| 13 | Polityka prywatności   | `polityka-prywatnosci.html`         | Źródło: hFF9f |
| 14 | Regulamin              | `regulamin.html`                    | Źródło: hFF9f |
| 15 | Use case lista         | `usecase-lista.html`                | Źródło: hFF9f |

---

## Faza 1 (2 bloki: mobile 360 + desktop)

Wykonane dla stron all-breakpoints (usunięto bloki 768 i 1920, przełączanie w CSS):

| Strona | Root mobile | Root desktop | Status |
|--------|-------------|--------------|--------|
| Dystrybutor | `.page--dystrybutor-mobile` | `.page .page--dystrybutor` | ✅ zamknięty |
| Produkt | `.page--produkt-mobile` | `.page .page--produkt` | ✅ |
| Program partnerski | `.page--program-partnerski-mobile` | `.page .page--program-partnerski` (blok **1920**) | ✅ zamknięty |
| O nas | `.page--onas-mobile` | `.page .page--onas` | ✅ poprawione (usunięto zbędne @media) |
| Blog | `.page--blog-mobile` | `.page .page--blog` | ✅ |
| Dystrybutor rejestracja krok 1 | — | `.page-registration` (już 1 blok) | ✅ style JbcrW |
| Strona główna | `.page--index-mobile` | `.page .page--index` (blok **1920**) | ✅ Faza 1 (2 bloki) |
| Kontakt | `.page--kontakt-mobile` | `.page .page--kontakt` (blok **1366**) | ✅ Faza 1 (2 bloki) |

Strony z jednym breakpointem – dodane klasy `page .page--*`: Blog wpis (`.page--blog-wpis`), FAQ (`.page--faq`), Polityka prywatności (`.page--polityka-prywatnosci`), Regulamin (`.page--regulamin`), Use case lista (`.page--usecase-lista`), Dystrybutor rejestracja krok 2 (`.page--dystrybutor-rejestracja-krok2`), podziękowanie (`.page--dystrybutor-rejestracja-podziekowanie`), Logowanie (`.page--logowanie`).

---

## Komponenty dodatkowe (zachowane)

Do wykorzystania w formularzach, modalach, krokach itp.:

| Plik                     | Opis | Style (pakiet) |
|--------------------------|------|----------------|
| `pop-up-instalator.html` | Pop-up instalator (używany m.in. na stronie głównej) | hFF9f ✅ |
| `pop-up-send.html`       | Pop-up wysyłki (np. formularz) | EWJUC ✅ |
| `pop-up-doradca.html`    | Pop-up doradcy | EWJUC ✅ |
| `popup-info.html`        | Popup informacyjny (popupu95infou951) | EWJUC ✅ |
| `logowanie.html`         | Strona logowania | egxs6 ✅ (klasa `.page--logowanie`) |
| `pop-up-instalator-jbcrw.html` | Wariant pop-up instalatora z pakietu JbcrW | JbcrW ✅ |

Wszystkie: viewport `device-width`. **Kolejność CSS:** `styleguide.css` → `styleguide-*.css` (wariant pakietu) → `globals.css` → `globals-*.css` (wariant) → na rejestracja-krok1: `globals-JbcrW-full.css` → plik CSS strony. Warianty muszą być ładowane – zawierają definicje klas używanych w HTML.

Ewentualne kolejne podstrony/komponenty można dopisywać do tej sekcji i dodawać do folderu `zrodlo-prawdy/`.

---

## Faza 4 – header i footer (partials)

Fragmenty pod WordPress: **partials/header.html** (nawigacja desktop), **partials/footer.html** (stopka desktop). Źródło: dystrybutor.html. Opis: **HEADER-FOOTER.md**.

---

## Struktura folderu `zrodlo-prawdy/`

```
zrodlo-prawdy/
├── LISTA-STRON.md          ← ten plik
├── index.html
├── onas.html
├── kontakt.html
├── laboratorium.html       (placeholder)
├── program-partnerski.html
├── produkt.html
├── dystrybutor.html
├── dystrybutor-rejestracja-krok1.html
├── dystrybutor-rejestracja-krok2.html
├── dystrybutor-rejestracja-podziekowanie.html
├── blog.html
├── blog-wpis.html
├── faq.html
├── polityka-prywatnosci.html
├── regulamin.html
├── usecase-lista.html
├── pop-up-instalator.html
├── pop-up-send.html
├── pop-up-doradca.html
├── popup-info.html
├── logowanie.html
├── partials/               (Faza 4: header.html, footer.html – pod WP)
├── HEADER-FOOTER.md        (granice i użycie partials)
├── css/                    (wspólne: globals.css, styleguide.css + pliki per strona)
├── img/                    (zmergowane zasoby z wszystkich pakietów)
└── fonts/                  (puste w eksportach – fonty z zewn. CDN)
```

---

## Źródła pakietów Anima (mapowanie)

- **hFF9f** = `AnimaPackage-Flex-hFF9f kopia org str gl` – strona główna, blog wpis, polityka, regulamin, use case lista, pop-up instalator
- **EWJUC** = O nas, pop-up send/doradca, popup info
- **v74Ij** = Produkt, Dystrybutor
- **TVr8o** = Blog, FAQ
- **bcAa9** = Kontakt
- **egxs6** = Program partnerski, Logowanie
- **JbcrW** = Dystrybutor rejestracja (krok 1–2, podziękowanie), wariant pop-up instalator

**Viewport i styleguide:** Wszystkie pliki HTML mają viewport `width=device-width, initial-scale=1.0`. Strony ładują styleguide/globals z pakietu (np. hFF9f, TVr8o, EWJUC, egxs6, JbcrW) przed CSS strony. Kontakt, Produkt, Dystrybutor – tylko bazowe styleguide/globals (brak plików bcAa9 i v74Ij w `css/`).

Kolejne fazy (jedna struktura HTML + CSS, wspólne klasy, optymalizacja CSS) wykonujesz w plikach w **`zrodlo-prawdy/`**.
