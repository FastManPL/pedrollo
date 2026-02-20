#!/usr/bin/env python3
"""Program partnerski: zamiana desktopu z 1366 na blok 1920 (zdjęcie -23, układ)."""
import re

EGXS6_HTML = "../AnimaPackage-Flex-egxs6/pedrollou95program-partnerski-all-breakpoints.html"
EGXS6_CSS = "../AnimaPackage-Flex-egxs6/css/pedrollou95program-partnerski-all-breakpoints.css"
OUT_HTML = "program-partnerski.html"
OUT_CSS = "css/pedrollou95program-partnerski-all-breakpoints.css"

def build_html():
    with open(EGXS6_HTML, "r", encoding="utf-8") as f:
        lines = f.readlines()
    # mobile 18-268, desktop = 1920 block 530-888
    with open(OUT_HTML, "r", encoding="utf-8") as f:
        current = f.readlines()
    # current: 1-270 (head + mobile), 271-592 (old desktop 1366), 593-594 tail
    head_plus_mobile = "".join(current[0:270])  # 1-270 incl
    tail = "".join(current[592:594])  # 593-594

    block_1920 = "".join(lines[529:888])  # 530-888 incl (0-based 529-887)
    block_1920 = block_1920.replace(
        'class="pedrollou95program-partnerski-all-breakpoints screen"',
        'class="page page--program-partnerski screen"',
        1
    )
    out = head_plus_mobile + block_1920 + tail
    with open(OUT_HTML, "w", encoding="utf-8") as f:
        f.write(out)
    print("Wrote", OUT_HTML)

def build_css():
    with open(EGXS6_CSS, "r", encoding="utf-8") as f:
        content = f.read()
    with open(OUT_CSS, "r", encoding="utf-8") as f:
        current = f.read()
    # current: first @media (max-width 767) + mobile rules + }; then @media (min-width 768) + desktop rules + }
    # We keep everything up to and including "}\n\n@media screen and (min-width: 768px)"
    # Then we need the 1920 section from egxs6 (1517-2327), with root replaced by .page--program-partnerski
    start_1920 = content.find("/* screen - pedrollou95program-partnerski-all-breakpoints */")
    end_1920 = content.find("/* screen - pedrollou95program-partnerskiu951366px */")
    part_1920 = content[start_1920:end_1920].strip()
    part_1920 = re.sub(
        r"\.pedrollou95program-partnerski-all-breakpoints\b",
        ".page--program-partnerski",
        part_1920
    )
    # Find where first @media ends in current (after mobile rules, the closing })
    idx = current.find("@media screen and (min-width: 768px)")
    first_part = current[:idx].rstrip()  # header + first @media with mobile
    # New second @media with 1920 content
    second_media = "\n\n@media screen and (min-width: 768px) {\n  .page--program-partnerski-mobile { display: none !important; }\n\n"
    second_media += part_1920 + "\n}\n"
    out = first_part + second_media
    with open(OUT_CSS, "w", encoding="utf-8") as f:
        f.write(out)
    print("Wrote", OUT_CSS)

if __name__ == "__main__":
    build_html()
    build_css()
