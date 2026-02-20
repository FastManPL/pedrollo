#!/usr/bin/env python3
"""Faza 1 dla Produkt: 2 bloki (360 + 1366), nowe rooty, CSS z media."""
import re

SRC_HTML = "../AnimaPackage-Flex-v74Ij/pedrollou95produkt-all-breakpoints.html"
SRC_CSS = "../AnimaPackage-Flex-v74Ij/css/pedrollou95produkt-all-breakpoints.css"
OUT_HTML = "produkt.html"
OUT_CSS = "css/pedrollou95produkt-all-breakpoints.css"

# Produkt: 1920(18-789), 1366(790-1478), 768(1479-2178), 360(2179-2876), end 2877-2879
def build_html():
    with open(SRC_HTML, "r", encoding="utf-8") as f:
        lines = f.readlines()
    head = "".join(lines[0:17])  # do włącznie <body> i input
    block_360 = "".join(lines[2178:2876])  # 2179-2876 incl
    block_1366 = "".join(lines[789:1478])  # 790-1478 incl
    tail = "".join(lines[2876:2879])  # 2877-2879

    block_360 = block_360.replace(
        'class="pedrollou95produktu95360px screen"',
        'class="page--produkt-mobile screen"',
        1
    )
    block_1366 = block_1366.replace(
        'class="pedrollou95produktu951366px screen"',
        'class="page page--produkt screen"',
        1
    )

    head = head.replace("pedrollou95produkt-all-breakpoints", "pedrollou95produkt-all-breakpoints")
    head = head.replace('href="css/pedrollou95produkt-all-breakpoints.css"', 'href="css/pedrollou95produkt-all-breakpoints.css"')

    out = head + block_360 + block_1366 + tail
    with open(OUT_HTML, "w", encoding="utf-8") as f:
        f.write(out)
    print("Wrote", OUT_HTML)

def build_css():
    with open(SRC_CSS, "r", encoding="utf-8") as f:
        content = f.read()
    # Sekcje: 1-2426 (1920), 2427-4937 (1366), 4938-6988 (360), 6989-end (768)
    part_360 = content[content.find("/* screen - pedrollou95produktu95360px */"):content.find("/* screen - pedrollou95produktu95768px */")].strip()
    part_1366 = content[content.find("/* screen - pedrollou95produktu951366px */"):content.find("/* screen - pedrollou95produktu95360px */")].strip()

    part_360 = re.sub(r"\.pedrollou95produktu95360px\b", ".page--produkt-mobile", part_360)
    part_1366 = re.sub(r"\.pedrollou95produktu951366px\b", ".page--produkt", part_1366)

    out = """/* Produkt: mobile (360) + desktop (1366), 2 bloki – przełączanie przez media */

@media screen and (max-width: 767px) {
  .page--produkt { display: none !important; }
"""
    out += part_360 + "\n}\n\n@media screen and (min-width: 768px) {\n  .page--produkt-mobile { display: none !important; }\n\n"
    out += part_1366 + "\n}\n"
    with open(OUT_CSS, "w", encoding="utf-8") as f:
        f.write(out)
    print("Wrote", OUT_CSS)

if __name__ == "__main__":
    build_html()
    build_css()
