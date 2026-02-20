#!/usr/bin/env python3
"""Faza 1 dla Program partnerski (egxs6): 2 bloki 360 + 1366."""
import re

SRC_HTML = "../AnimaPackage-Flex-egxs6/pedrollou95program-partnerski-all-breakpoints.html"
SRC_CSS = "../AnimaPackage-Flex-egxs6/css/pedrollou95program-partnerski-all-breakpoints.css"
OUT_HTML = "program-partnerski.html"
OUT_CSS = "css/pedrollou95program-partnerski-all-breakpoints.css"

# HTML: 360(18-268), 768(269-529), 1920(530-888), 1366(889-1210), end 1211-1212
def build_html():
    with open(SRC_HTML, "r", encoding="utf-8") as f:
        lines = f.readlines()
    head = "".join(lines[0:17])
    block_360 = "".join(lines[17:268])   # 18-268
    block_1366 = "".join(lines[888:1210])  # 889-1210
    tail = "".join(lines[1210:1212])  # 1211-1212

    block_360 = block_360.replace(
        'class="pedrollou95labolatoriumu95mobileu95360px screen"',
        'class="page--program-partnerski-mobile screen"',
        1
    )
    block_1366 = block_1366.replace(
        'class="pedrollou95program-partnerskiu951366px screen"',
        'class="page page--program-partnerski screen"',
        1
    )
    out = head + block_360 + block_1366 + tail
    with open(OUT_HTML, "w", encoding="utf-8") as f:
        f.write(out)
    print("Wrote", OUT_HTML)

def build_css():
    with open(SRC_CSS, "r", encoding="utf-8") as f:
        content = f.read()
    start_360 = content.find("/* screen - pedrollou95labolatoriumu95mobileu95360px */")
    start_1920 = content.find("/* screen - pedrollou95program-partnerski-all-breakpoints */")
    start_1366 = content.find("/* screen - pedrollou95program-partnerskiu951366px */")
    part_360 = content[start_360:start_1920].strip()
    part_1366 = content[start_1366:].strip()

    part_360 = re.sub(r"\.pedrollou95labolatoriumu95mobileu95360px\b", ".page--program-partnerski-mobile", part_360)
    part_1366 = re.sub(r"\.pedrollou95program-partnerskiu951366px\b", ".page--program-partnerski", part_1366)

    out = """/* Program partnerski: mobile (360) + desktop (1366), 2 bloki */

@media screen and (max-width: 767px) {
  .page--program-partnerski { display: none !important; }
"""
    out += part_360 + "\n}\n\n@media screen and (min-width: 768px) {\n  .page--program-partnerski-mobile { display: none !important; }\n\n"
    out += part_1366 + "\n}\n"
    with open(OUT_CSS, "w", encoding="utf-8") as f:
        f.write(out)
    print("Wrote", OUT_CSS)

if __name__ == "__main__":
    build_html()
    build_css()
