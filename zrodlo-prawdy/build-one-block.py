#!/usr/bin/env python3
"""
Jedna struktura HTML (blok 360 = mobile) + CSS z dwoma zakresami.
Treść nie jest duplikowana; klasy z 1366 są mapowane na klasy 360 wg tagu,
żeby na desktop (min-width: 768px) stosować styl 1366 do tej samej struktury.
"""
import re

# Przed uruchomieniem skopiuj oryginał: cp ../AnimaPackage-Flex-v74Ij/pedrollou95dystrybutor-all-breakpoints.html dystrybutor_src.html
HTML_SRC = "dystrybutor_src.html"
CSS_SRC = "css/pedrollou95dystrybutor-all-breakpoints.css"
OUT_HTML = "dystrybutor.html"
OUT_CSS = "css/pedrollou95dystrybutor-all-breakpoints.css"

# Bloki w 4-blokowym HTML (numery linii 1-based)
B360_START, B360_END = 18, 532
B1366_START, B1366_END = 1099, 1824
# Sekcje w oryginalnym CSS (1-based)
CSS_360 = (3621, 5016)
CSS_1366 = (1738, 3620)

TAG_CLASS_RE = re.compile(r"<(\w+)(?:\s[^>]*)?\bclass=\"([^\"]+)\"", re.I)


def extract_tag_class_list(html_lines, start_1, end_1):
    block = "\n".join(html_lines[start_1 - 1 : end_1])
    out = []
    for m in TAG_CLASS_RE.finditer(block):
        tag = m.group(1).lower()
        first_cls = m.group(2).split()[0].strip()
        if first_cls == "screen":
            continue
        out.append((tag, first_cls))
    return out


def build_1366_to_360_map(tc_360, tc_1366):
    """Mapa: klasa_1366 -> klasa_360 (wg pary tag+indeks)."""
    by_tag_360 = {}
    by_tag_1366 = {}
    for t, c in tc_360:
        by_tag_360.setdefault(t, []).append(c)
    for t, c in tc_1366:
        by_tag_1366.setdefault(t, []).append(c)
    m = {}
    for tag in by_tag_1366:
        list_1366 = by_tag_1366[tag]
        list_360 = by_tag_360.get(tag, [])
        for i, c1366 in enumerate(list_1366):
            m[c1366] = list_360[i] if i < len(list_360) else c1366
    return m


def main():
    with open(HTML_SRC, "r", encoding="utf-8") as f:
        lines = f.readlines()

    tc_360 = extract_tag_class_list(lines, B360_START, B360_END)
    tc_1366 = extract_tag_class_list(lines, B1366_START, B1366_END)
    map_1366_to_360 = build_1366_to_360_map(tc_360, tc_1366)
    print("Mapa 1366->360 (wg tagu):", len(map_1366_to_360), "par")

    # HTML: tylko blok 360, jeden root
    out_html = lines[:17]
    out_html.append('    <div class="page page--dystrybutor screen">\n')
    out_html.extend(lines[B360_START : B360_END - 1])  # zawartość 360 bez otwierającego div
    out_html.append("    </div>\n  </body>\n</html>\n")
    with open(OUT_HTML, "w", encoding="utf-8") as f:
        f.writelines(out_html)
    print("Zapisano", OUT_HTML, "– jedna struktura (360).")

    # CSS: mobile (360) + desktop (1366 z zamianą klas na 360)
    with open(CSS_SRC, "r", encoding="utf-8") as f:
        css = f.readlines()

    def replace_root_and_map(text, root_old, root_new, class_map):
        t = text.replace(root_old, root_new)
        for old_c, new_c in class_map.items():
            if old_c != new_c:
                t = re.sub(r"\." + re.escape(old_c) + r"(?![\w-])", "." + new_c, t)
        return t

    part_360 = "".join(css[CSS_360[0] - 1 : CSS_360[1]])
    part_360 = replace_root_and_map(
        part_360, ".pedrollou95dystrybutoru95360px", ".page--dystrybutor", {}
    )

    part_1366 = "".join(css[CSS_1366[0] - 1 : CSS_1366[1]])
    part_1366 = replace_root_and_map(
        part_1366,
        ".pedrollou95dystrybutoru951366px",
        ".page--dystrybutor",
        map_1366_to_360,
    )

    out_css = [
        "/* Dystrybutor – jedna struktura (360), klasy sterują wyglądem; desktop = style 1366 zmapowane na klasy 360 */\n\n",
        "@media screen and (max-width: 767px) {\n",
        part_360,
        "}\n\n",
        "@media screen and (min-width: 768px) {\n",
        part_1366,
        "}\n",
    ]
    with open(OUT_CSS, "w", encoding="utf-8") as f:
        f.write("".join(out_css))
    print("Zapisano", OUT_CSS)


if __name__ == "__main__":
    main()
