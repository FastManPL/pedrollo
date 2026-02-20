# Klasy CSS – inwentaryzacja i mapowanie (Faza 2)

Dokument pomocniczy do Fazy 2 planu działania: wspólne klasy dla przycisków i powtarzalnych elementów.

---

## 1. Inwentaryzacja przycisków (stan w `zrodlo-prawdy`)

### Grupy klas (wygląd / rola)

| Grupa | Klasy w HTML | Opis wizualny / użycie |
|-------|----------------|------------------------|
| **Białe CTA** | `button_to_white`, `button_to_white-1` … `button_to_white-8` (w różnych kombinacjach) | Przycisk z gradientem (biały / jasny), główne CTA |
| **Ciemne / navy** | `button_to_dark_navi`, `button_to_dark_navi-2`, `-4` | Ciemny przycisk (gradient navy/niebieski) |
| **Ciemne białe** | `button_to_dark_white`, `button_to_dark_white-1` … `-4` | Wariant ciemny (ciemne tło) |
| **Proste / link** | `button_to` | Prosty przycisk/link |
| **Telefon / CTA** | `call_button`, `call_button-1` | Przycisk „zadzwoń” / kontakt |
| **Telefon ciemny** | `call_button_dark` | Ciemna wersja call (pop-upy) |
| **Strefa partnera** | `strefa_partnera` | Link „Strefa partnera” (już w globals.css) |
| **Krok / submit** | `krok`, `krok-1`, `krok-4` | Przycisk „Dalej” / potwierdź (rejestracja, formularze) |
| **Power** | `power-button-1`, `power-button-1-3` | Ikona/ przycisk (np. play) |

Style dla powyższych są rozproszone w plikach per-strona (np. `pedrollou95polskau95mainu953.css`, `pedrollou95kontaktu951366px.css`) oraz częściowo w `globals.css` (`.button_to_dark_navi`, `.krok`, `.strefa_partnera`).

---

## 2. Proponowane mapowanie → system `.btn`

| Stare klasy (zbiorczo) | Nowa klasa | Uwagi |
|------------------------|-----------|--------|
| `button_to_white`, `button_to_white-*` | `.btn .btn--primary` | Główny CTA (biały/jasny) |
| `button_to_dark_navi`, `button_to_dark_navi-*` | `.btn .btn--secondary` | Ciemny (navy) |
| `button_to_dark_white`, `button_to_dark_white-*` | `.btn .btn--dark` | Ciemne tło |
| `button_to` | `.btn .btn--link` | Prosty / linkowy |
| `call_button`, `call_button-1` | `.btn .btn--cta` lub zachować `.call_button` | Zadzwoń |
| `call_button_dark` | `.btn .btn--cta .btn--dark` lub `.call_button--dark` | Wariant ciemny |
| `strefa_partnera` | zachować lub `.btn .btn--partner` | Już w globals |
| `krok`, `krok-1`, `krok-4` | `.btn .btn--submit` | Submit / Dalej |
| `power-button-*` | zachować lub `.btn-icon` | Ikona |

---

## 3. Kolejność wdrożenia (propozycja)

1. **W `globals.css` (lub `components.css`):**  
   Dodać definicje `.btn`, `.btn--primary`, `.btn--secondary`, `.btn--dark`, `.btn--link`, `.btn--cta`, `.btn--submit` – bazowe style (padding, border-radius, font), bez usuwania starych klas.  
   **✅ Zrobione:** `.btn`, `.btn--primary`, `.btn--secondary`, `.btn--cta` w `css/globals.css` + media dla mobile.
2. **Pilot na jednej stronie:**  
   Np. wybrana sekcja w `index.html` lub `dystrybutor.html` – zamiana jednego typu przycisku (np. `button_to_white` → `btn btn--primary`) i upewnienie się, że wygląd się zgadza.  
   **✅ Pilot:** `index.html` – przycisk „Skonsultuj się z doradcą” (desktop) zamieniony na `btn btn--primary`.
3. **Stopniowa zamiana w HTML:**  
   Strona po stronie lub skryptem (sed/Node) według mapowania z tabeli powyżej.  
   **✅ Zakończone** dla `button_to_white*`, `button_to_dark_navi*`, `button_to_dark_white*`: zamienione na `btn btn--primary` / `btn btn--secondary` / `btn btn--dark`. **✅ Zakończone** dla `call_button`, `call_button-1`, `call_button_dark`: zamienione na `btn btn--cta` i `btn btn--cta-dark` we wszystkich HTML. W globals: `.btn--cta` (gradient biały→przezroczysty), `.btn--cta-dark` (gradient przezroczysty→niebieski, obramowanie). Pozostałe opcjonalnie: `strefa_partnera`, `krok` (zostawione – używane w globals / kontekstach formularzy).
4. **Porządki w CSS:**  
   Po zamianie – usunąć lub zredukować zduplikowane bloki `.button_to_white-*` w plikach per-strona, zostawiając ewentualne fallbacki dla starych klas do czasu pełnej migracji.  
   **Faza 3 – zakończona (martwe reguły przycisków):** Usunięte z: pop-upy (2), podziękowanie, krok 2, usecase-lista, regulamin, polityka, blog-wpis, program-partnerski, blog-all-breakpoints, **pedrollou95kontaktu951366px.css**, **pedrollou95dystrybutor-all-breakpoints.css**, **pedrollou95polskau95ou95nas-all-breakpoints.css**, **pedrollou95produkt-all-breakpoints.css**, **pedrollou95dystrybutoru95rejestracjau95kroku9501-all-breakpoints.css**, **pedrollou95polskau95mainu953.css**, **pedrollou95blog-TVr8o-original.css**; oraz bloki `.call_button` z **globals-TVr8o.css** i **globals-egxs6.css**. W głównym `globals.css` pozostawione: `.button_to_dark_navi`, `.krok`, `.strefa_partnera` (używane jako fallback/kontekst). Pliki `.bak` / `.bak2` w `css/` nie były czyszczone.

---

## 4. Powtarzalne sekcje (opcjonalnie, później)

- Nagłówki sekcji: różne `frame-*`, klasy typu `manrope-semi-bold-concrete-*` → np. `.section-title`, `.section-title--large`.
- Karty / boksy: `frame-367`, `frame-6482` itd. → np. `.card`, `.card--feature`.
- Inwentaryzację sekcji można dopisać w tym pliku po ustabilizowaniu przycisków.

---

*Zaktualizowano w ramach Fazy 2 (wspólne klasy przycisków).*
