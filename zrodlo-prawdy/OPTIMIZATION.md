# Optymalizacja CSS – strona główna (index.html)

## Obecny stan

- **index.html** ładuje 6 plików CSS (~328 KB łącznie).
- Największe: `pedrollou95polskau95mainu953.css` (~155 KB), `globals.css` (~123 KB).
- Część reguł to style z generatora Anima dla komponentów, które na stronie głównej nie występują.

## Co zostało zrobione

### 1. Skrypt PurgeCSS (`npm run optimize:css`)

- Czyta **index.html** i usuwa z załadowanych plików CSS reguły, których selektory nie występują na stronie.
- Zapisuje wynik do **css/optimized/** (oryginały w `css/` zostają bez zmian).
- **Safelist** chroni klasy używane dynamicznie (Flickity, stany typu `--active`, `--hidden`, menu mobilne, konfigurator itd.).

**Uruchomienie:**

```bash
npm install
npm run optimize:css
```

**Efekt (przykładowy):** łącznie ~328 KB → ~280 KB (~15% mniej). Największe procentowo redukcje: `styleguide-hFF9f.css`, `globals-hFF9f.css`, `styleguide.css`.

**Użycie zoptymalizowanych plików:** w `index.html` zamień ścieżki w `<link>`, np.:

- `href="css/pedrollou95polskau95mainu953.css"` → `href="css/optimized/pedrollou95polskau95mainu953.css"`
- i analogicznie dla pozostałych plików z `css/`.

Albo po buildzie skopiuj zawartość `css/optimized/` do `css/` (np. w skrypcie wdrożeniowym).

### 2. Co można zrobić ręcznie

- **Minifikacja:** po PurgeCSS uruchom minifier (np. `cssnano`, `clean-css`) – mniejszy rozmiar i szybsze ładowanie.
- **Łączenie plików:** jeden lub dwa pliki CSS zamiast sześciu – mniej requestów (koszt: trudniejsza edycja w Anima).
- **Krytyczny CSS:** wyciągnięcie styli „above the fold” do inline `<style>` w `<head>` – szybszy First Contentful Paint.
- **Usunięcie nieużywanych zmiennych:** w `styleguide.css` jest dużo zmiennych (`--var`); część może nie być używana na index – można to zweryfikować i posprzątać.

### 3. Uwagi

- PurgeCSS jest ustawiony tak, aby **nie** usuwać klas dodawanych przez JS (np. Flickity, zakładki, FAQ, menu). Jeśli coś znika po włączeniu optymalizacji, dopisz klasę do **safelist** w `build-purgecss.js`.
- Pliki w `css/optimized/` można dodać do `.gitignore` i generować je przy buildzie/wdrożeniu.
- Inne strony (faq.html, produkt.html itd.) używają innych zestawów CSS – PurgeCSS w tym skrypcie jest tylko pod **index.html**.

## Podsumowanie

| Działanie              | Efekt                          |
|------------------------|---------------------------------|
| `npm run optimize:css` | ~15% mniej CSS dla index.html   |
| Przełączenie na `css/optimized/` | Mniejszy transfer i szybsze ładowanie |
| Opcjonalnie: minifikacja + łączenie plików | Dodatkowe zmniejszenie rozmiaru i liczby requestów |
