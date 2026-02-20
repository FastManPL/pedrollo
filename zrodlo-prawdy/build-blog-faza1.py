#!/usr/bin/env python3
"""Faza 1 dla Blog (TVr8o): 2 bloki 360 + 1366."""
import re

SRC_HTML = "../AnimaPackage-Flex-TVr8o/pedrollou95blog-all-breakpoints.html"
SRC_CSS = "../AnimaPackage-Flex-TVr8o/css/pedrollou95blog-all-breakpoints.css"
OUT_HTML = "blog.html"
OUT_CSS = "css/pedrollou95blog-all-breakpoints.css"

# HTML: 360(18-330), 768(331-646), 1920(647-1045), 1366(1046-1445), end 1446-1447
def build_html():
    with open(SRC_HTML, "r", encoding="utf-8") as f:
        lines = f.readlines()
    head = "".join(lines[0:17])
    block_360 = "".join(lines[17:330])     # 18-330
    block_1366 = "".join(lines[1045:1445])  # 1046-1445
    tail = "".join(lines[1445:1447])  # 1446-1447

    block_360 = block_360.replace(
        'class="pedrollou95blogu95360px screen"',
        'class="page--blog-mobile screen"',
        1
    )
    block_1366 = block_1366.replace(
        'class="pedrollou95blogu951366px screen"',
        'class="page page--blog screen"',
        1
    )
    out = head + block_360 + block_1366 + tail
    with open(OUT_HTML, "w", encoding="utf-8") as f:
        f.write(out)
    print("Wrote", OUT_HTML)

def build_css():
    with open(SRC_CSS, "r", encoding="utf-8") as f:
        content = f.read()
    start_1366 = content.find("/* screen - pedrollou95blogu951366px */")
    start_360 = content.find("/* screen - pedrollou95blogu95360px */")
    start_768 = content.find("/* screen - pedrollou95blogu95768px */")
    part_1366 = content[start_1366:start_360].strip()
    part_360 = content[start_360:start_768].strip()

    part_360 = re.sub(r"\.pedrollou95blogu95360px\b", ".page--blog-mobile", part_360)
    part_1366 = re.sub(r"\.pedrollou95blogu951366px\b", ".page--blog", part_1366)

    out = """/* Blog: mobile (360) + desktop (1366), 2 bloki */

@media screen and (max-width: 767px) {
  .page--blog { display: none !important; }
"""
    out += part_360 + "\n}\n\n@media screen and (min-width: 768px) {\n  .page--blog-mobile { display: none !important; }\n\n"
    out += part_1366 + "\n}\n"
    with open(OUT_CSS, "w", encoding="utf-8") as f:
        f.write(out)
    print("Wrote", OUT_CSS)

if __name__ == "__main__":
    build_html()
    build_css()
