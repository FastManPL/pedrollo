#!/usr/bin/env python3
"""Faza 1 dla O nas (EWJUC): 2 bloki 360 + 1366."""
import re

SRC_HTML = "../AnimaPackage-Flex-EWJUC/pedrollou95polskau95ou95nas-all-breakpoints.html"
SRC_CSS = "../AnimaPackage-Flex-EWJUC/css/pedrollou95polskau95ou95nas-all-breakpoints.css"
OUT_HTML = "onas.html"
OUT_CSS = "css/pedrollou95polskau95ou95nas-all-breakpoints.css"

# HTML: 360(18-756), 768(757-1538), 1366(1539-2503), 1920(2504-3616), end 3617-3618
def build_html():
    with open(SRC_HTML, "r", encoding="utf-8") as f:
        lines = f.readlines()
    head = "".join(lines[0:17])
    block_360 = "".join(lines[17:756])    # 18-756
    block_1366 = "".join(lines[1538:2503])  # 1539-2503
    tail = "".join(lines[3616:3618])  # 3617-3618

    block_360 = block_360.replace(
        'class="pedrollou95useu95caseu95mobileu95360px screen"',
        'class="page--onas-mobile screen"',
        1
    )
    block_1366 = block_1366.replace(
        'class="pedrollou95polskau95ou95nasu951366px screen"',
        'class="page page--onas screen"',
        1
    )
    out = head + block_360 + block_1366 + tail
    with open(OUT_HTML, "w", encoding="utf-8") as f:
        f.write(out)
    print("Wrote", OUT_HTML)

def build_css():
    with open(SRC_CSS, "r", encoding="utf-8") as f:
        content = f.read()
    start_1366 = content.find("/* screen - pedrollou95polskau95ou95nasu951366px */")
    start_768 = content.find("/* screen - pedrollou95polskau95ou95nasu95768px */")
    start_360 = content.find("/* screen - pedrollou95useu95caseu95mobileu95360px */")
    part_1366 = content[start_1366:start_768].strip()
    part_360 = content[start_360:].strip()

    part_360 = re.sub(r"\.pedrollou95useu95caseu95mobileu95360px\b", ".page--onas-mobile", part_360)
    part_1366 = re.sub(r"\.pedrollou95polskau95ou95nasu951366px\b", ".page--onas", part_1366)

    out = """/* O nas: mobile (360) + desktop (1366), 2 bloki */

@media screen and (max-width: 767px) {
  .page--onas { display: none !important; }
"""
    out += part_360 + "\n}\n\n@media screen and (min-width: 768px) {\n  .page--onas-mobile { display: none !important; }\n\n"
    out += part_1366 + "\n}\n"
    with open(OUT_CSS, "w", encoding="utf-8") as f:
        f.write(out)
    print("Wrote", OUT_CSS)

if __name__ == "__main__":
    build_html()
    build_css()
