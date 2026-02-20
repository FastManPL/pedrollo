# Strategia CSS – jedna struktura + responsywność

**Dystrybutor (stan na teraz):** Dwa bloki w HTML (mobile 360 + desktop 1366) z przełączaniem przez media – bez mapowania klas. Treść się powiela, ale layout działa poprawnie na mobile i desktop. Jedna struktura bez rozjeżdżania się wymagałaby ręcznego mapowania sekcji.

---

## Zasady

1. **Jedna struktura HTML** – na stronie zostaje jeden blok (kanoniczny breakpoint, np. 1366px). Pozostałe wersje (360, 768, 1920) nie są osobnymi divami; wygląd na tych szerokościach steruje **tylko CSS** (media queries).

2. **Jeden plik CSS na stronę** – np. `pedrollou95dystrybutor-all-breakpoints.css` (albo w przyszłości `page-dystrybutor.css`). W środku: style dla tej strony we wszystkich breakpointach (selektory oparte na jednym zestawie klas – kanonicznym).

3. **Późniejsze scalenie** – gdy będzie gotowych więcej stron:
   - zbieramy pliki CSS stron (lub już mamy jeden wspólny),
   - szukamy **tożsamych reguł** (ten sam selektor + te same właściwości),
   - łączymy w jeden (lub kilka) plików bazowych i usuwamy duplikaty,
   - wspólne klasy (np. `.btn`, typografia) trafiają do `globals.css` / `styleguide.css`.

Nie przyjmujemy „jednego CSS z jednej podstrony” – każda strona ma swój plik; na koniec robimy merge i deduplikację.

---

## Dystrybutor – kanoniczna struktura

- **Kanoniczny blok:** 1366px (najpełniejszy układ, spójne z 1920).
- **Root:** `.page--dystrybutor` (zamiast `.pedrollou95dystrybutoru951366px`).
- **Klasy wewnętrzne:** bez zmian (np. `.frame-3673325`, `.konsultacja-2`), żeby CSS mógł jednoznacznie wskazywać elementy.

Mapowanie: style z bloków 360px, 768px i 1920px są przerabiane tak, aby **targetować te same klasy co 1366px** (mapowanie klas wg kolejności w DOM), i układane w media queries:

- `@media (max-width: 767px)` → style z 360px (po mapowaniu na klasy 1366)
- `@media (min-width: 768px) and (max-width: 1365px)` → style z 768px (po mapowaniu)
- `@media (min-width: 1366px) and (max-width: 1919px)` → oryginalne style 1366px
- `@media (min-width: 1920px)` → style z 1920px (po mapowaniu na klasy 1366)

**Skrypt** `build-single-structure.py` nie jest używany dla dystrybutora (mapowanie psuło layout). Obecne podejście: jedna struktura 1366px + tylko reguły 1366px w CSS, bez media dla innych breakpointów.

**Wyjątki (np. inne zdjęcia):** Jeśli na danym breakpoincie ma być inne zdjęcie, w HTML można dodać drugi element i sterować widocznością w CSS, np.:
```css
.img--mobile { display: block; }
.img--desktop { display: none; }
@media (min-width: 768px) {
  .img--mobile { display: none; }
  .img--desktop { display: block; }
}
```
