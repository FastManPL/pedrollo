# Lista stron przeniesionych i brakujących + sekcje „Globalny szablon”

## Strony przeniesione (mają page-*.php + template-parts/content-*.php)
- **Strona główna** – `front-page.php` + `content-front-page-full.php`
- **O nas** – `page-onas.php` / `page-o-nas.php` + `content-onas.php`
- **Dystrybutor** – `page-dystrybutor.php` + `content-dystrybutor.php`
- **Kontakt** – `page-kontakt.php` + `content-kontakt.php`
- **FAQ** – `page-faq.php` + `content-faq.php`

## Strony przeniesione w tej fazie (page-*.php + content-*.php)
- **Laboratorium** – `page-laboratorium.php` + `content-laboratorium.php` (referencje na dole)
- **Use case (pojedynczy)** – `page-usecase.php` + `content-usecase.php` (referencje na dole)
- **Program partnerski** – `page-program-partnerski.php` + `content-program-partnerski.php` (referencje, linki CTA → /dystrybutor/, /program-partnerski/)
- **Produkt** – `page-produkt.php` + `content-produkt.php` (referencje na dole)
- **Blog (lista)** – `page-blog.php` + `content-blog.php` (referencje na dole)
- **Polityka prywatności** – `page-polityka-prywatnosci.php` + `content-polityka-prywatnosci.php`
- **Regulamin** – `page-regulamin.php` + `content-regulamin.php`
- **Use case lista** – `page-usecase-lista.php` + `content-usecase-lista.php` (referencje na dole)
- **Blog wpis (pojedynczy)** – `single.php` + `content-blog-wpis.php`

---

## Sekcje „Globalny szablon” – mapowanie na sekcje ze strony głównej

| Placeholder (opis) | Gdzie występuje | Odpowiednik ze strony głównej (content-front-page-full.php) |
|--------------------|-----------------|-------------------------------------------------------------|
| **Logotypy** („szablon z logotypami”) | O nas (przed „Park maszynowy”) | Sekcja **„Nagradzani za jakość i innowacje”** – ticker z nagrodami (`.frame-62-3` → `.logos_2-3` → `.frame-50-3-ticker` z `.logo_0`). Linie ~58–217. |
| **Wyszukiwanie instalatora** | O nas (przed „Wartości…”), Kontakt (2. placeholder) | Sekcja **„Znajdź instalatora z Twojej okolicy”** – pole kodu pocztowego + wyniki (`.frame-6566-3` → `.frame-6587-3`, `#instalator-kod`, `.instalator-wyniki`). Linie ~2287–2332. |
| **Referencje** | O nas (na dole), Dystrybutor (przed FAQ), Kontakt (3. placeholder) | Sekcja **„Referencje” / „Co mówią o nas klienci?”** – slider opinii (`.frame-64-6` → `.testimonials-3` → `.testimonials-flickity` + `.testimonials-cell`). Linie ~289–429. |
| **Dołącz do programu** (strona główna) | — | Blok **„Oferta dla instalatorów”** – `template-parts/global-dolacz-do-programu.php` (`.frame-6599-3`), przycisk „Sprawdź korzyści” → `/program-partnerski/`. |
| **Dołącz do Programu Partnerskiego** (Dystrybutor, po FAQ) | Dystrybutor (po FAQ) | Ostatnia sekcja z **program-partnerski.html** – `template-parts/global-dolacz-do-programu-dystrybutor.php` (`.doacz_program_partnerski_2-2`). Tekst „Dołącz do Programu Partnerskiego”, dwa przyciski: „Dla dystrybutora” → `/dystrybutor/`, „Dla instalatora” → `/program-partnerski/`. Style w `globals.css` (blok „Sekcja Dołącz… na Dystrybutorze”). Obraz tła: `img/u7761719182-httpss-10.png` – jeśli brak, skopiować z `zrodlo-prawdy/` (program-partnerski). |

---

## Plan realizacji (zrobione)
1. Dla każdej sekcji: wyodrębnić HTML do `template-parts/global-*.php` – **wykonane** (global-logotypy, global-referencje, global-instalator, global-dolacz-do-programu).
2. W miejscach placeholderów i na stronie głównej: tylko `get_template_part( 'template-parts/global', '…' )` – **wykonane**.
3. Reguły CSS tych sekcji w `globals.css` (blok „Sekcje globalne” na końcu pliku) – **wykonane**.
4. Na O nas, Dystrybutor, Kontakt doładowane Flickity + `pedrollo-front-page.js`, żeby slider referencji działał – **wykonane**.
5. FAQ: style `.faq-6` w `globals.css` działają na stronie FAQ (`.pedrollou95faq`) i w sekcji FAQ na Dystrybutorze (`.pedrollou95dystrybutor-all-breakpoints`). jQuery UI Accordion ładowane na stronach FAQ i Dystrybutor.

## Strona FAQ w WordPress
- Szablon: `page-faq.php` (używany, gdy slug strony to **faq**).
- Treść: `template-parts/content-faq.php` (hero `.frame-20` + sekcja pytań `.faq-6` z `#accordion-faq-6`).
- Przy ręcznym dodawaniu strony ustaw **slug** na `faq`, żeby załadował się ten szablon i arkusz `pedrollou95faq.css`.
