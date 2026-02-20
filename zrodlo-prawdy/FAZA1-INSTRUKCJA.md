# Faza 1 – instrukcja dla kolejnych stron (all-breakpoints)

**Uwaga (dystrybutor):** Strona dystrybutor w `zrodlo-prawdy` została przywrócona w całości z oryginału **AnimaPackage-Flex-v74Ij** (HTML z 4 blokami, pełny CSS z media queries, globals.css, styleguide.css, img). Dzięki temu wyświetlanie na mobile/tablet/desktop działa tak jak w oryginale. Ewentualne przejście na „jedną strukturę” (Faza 1) zrobić później, ostrożnie, bez gubienia responsywności.

---

## Kolejność stron do przerobienia (all-breakpoints)

1. **dystrybutor** – ✅ zrobione (wzorzec)
2. **produkt** – ta sama logika co dystrybutor
3. **program-partnerski**
4. **onas** (O nas)
5. **blog**
6. **dystrybutor-rejestracja-krok1**

Strony **bez** wielu breakpointów (jedna wersja w eksporcie): kontakt, faq, blog-wpis, polityka-prywatnosci, regulamin, usecase-lista – **pomijamy** w Fazie 1 (nie ma co scalać).

---

## Schemat krok po kroku (na każdej stronie all-breakpoints)

### 1. Ustal bloki w HTML

W pliku `.html` znajdź 4 root divy (np. wyszukaj `class="... screen"`):

- `...360px screen` (mobile)
- `...768px screen` (tablet)
- `...1366px screen` (desktop)
- `...all-breakpoints screen` lub `...1920px` (duży desktop)

### 2. Zostaw jeden blok w HTML

- **Zostaw** tylko blok **1366px** (najczęściej ten sam układ co 1920px, ale klasy pasują do jednego zestawu reguł).
- **Root** tego bloku zamień na: `class="page page--NAZWA screen"` (np. `page--produkt`, `page--program-partnerski`).
- **Usuń** z pliku całą zawartość od początku pierwszego bloku (360px) do końca bloku przed 1366px (włącznie).
- **Usuń** cały blok all-breakpoints (1920px) – od jego otwierającego `<div` do końca, przed `</body>`.

### 3. CSS – jedna struktura

- W pliku `css/NAZWA-all-breakpoints.css` (lub odpowiednim):
  - **Zostaw** tylko sekcję z klasą **1366px** (w komentarzu: `/* screen - ...1366px */`).
  - **Zamień** w tej sekcji selektor `.pedrollou95...1366px` na `.page--NAZWA` (spójne z HTML).
  - **Usuń** sekcje dla 360px, 768px i all-breakpoints (1920px).
  - **Usuń** na końcu pliku media queries, które robiły tylko `display: none` na pozostałe bloki.

Uwaga: jeśli w HTML zostawiasz strukturę 1366px, to **nie** używaj w CSS reguł z bloku 1920px – tam są inne klasy (np. `.frame-20-3` zamiast `.frame-3673325`) i nie będą pasować do drzewa 1366px.

### 4. Nazewnictwo roota

| Strona              | Klasa roota (HTML i CSS)   |
|---------------------|----------------------------|
| dystrybutor         | `page page--dystrybutor`   |
| produkt             | `page page--produkt`       |
| program-partnerski  | `page page--program-partnerski` |
| onas                | `page page--onas`          |
| blog                | `page page--blog`          |
| dystrybutor-rejestracja-krok1 | `page page--dystrybutor-rejestracja` |

---

## Po Fazie 1

- Na małych viewportach (mobile/tablet) nadal obowiązują te same style co na 1366px – strona może wymagać przewijania w poziomie albo osobnych media queries w kolejnych fazach.
- Backup: przed edycją skopiuj `NAZWA.html` i `css/NAZWA-all-breakpoints.css` (np. `.bak`).
