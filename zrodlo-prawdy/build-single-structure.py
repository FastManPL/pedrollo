#!/usr/bin/env python3
"""
Jedna struktura HTML (blok 1366px) + CSS z 4 breakpointami.
Mapowanie klas: wg TYPU TAGU (n-ty div z 360 -> n-ty div z 1366), żeby
zachować zgodność struktury. Wyjątki (np. inne zdjęcia) można potem
dodać w HTML jako show/hide per breakpoint.
Użycie: python3 build-single-structure.py
"""
import re

HTML_PATH = "dystrybutor.html"
CSS_PATH = "css/pedrollou95dystrybutor-all-breakpoints.css"
OUT_HTML = "dystrybutor.html"
OUT_CSS = "css/pedrollou95dystrybutor-all-breakpoints.css"

BLOCK_STARTS = {"360": 18, "768": 533, "1366": 1099, "1920": 1825}
BLOCK_1366_END = 1824

CSS_SECTIONS = [
    ("360", 3621, 5016),
    ("768", 5017, 6553),
    ("1366", 1738, 3620),
    ("1920", 1, 1736),
]

# Tagi, które mają class i są w tym projekcie
TAG_PATTERN = re.compile(
    r"<(\w+)(?:\s[^>]*)?\bclass=\"([^\"]+)\"",
    re.IGNORECASE
)


def extract_tag_and_class(html_block):
    """Zwraca listę (tag, first_class) w kolejności DOM (tylko elementy z class)."""
    result = []
    for m in TAG_PATTERN.finditer(html_block):
        tag = m.group(1).lower()
        first_class = m.group(2).split()[0].strip()
        if first_class == "screen":
            continue
        result.append((tag, first_class))
    return result


def build_class_map_by_tag(other_list, ref_list):
    """
    other_list i ref_list to listy (tag, class).
    Łączymy w pary po tagu: n-ty div z other -> n-ty div z ref, itd.
    Zwraca słownik: other_class -> ref_class.
    """
    by_tag_other = {}
    by_tag_ref = {}
    for tag, cls in other_list:
        by_tag_other.setdefault(tag, []).append(cls)
    for tag, cls in ref_list:
        by_tag_ref.setdefault(tag, []).append(cls)

    class_map = {}
    for tag in by_tag_other:
        other_classes = by_tag_other[tag]
        ref_classes = by_tag_ref.get(tag, [])
        n = min(len(other_classes), len(ref_classes))
        for i in range(n):
            class_map[other_classes[i]] = ref_classes[i]
        for i in range(n, len(other_classes)):
            class_map[other_classes[i]] = other_classes[i]  # bez pary – zostaw
    return class_map


def main():
    with open(HTML_PATH, "r", encoding="utf-8") as f:
        html_lines = f.readlines()

    def block_html(name):
        start_0 = BLOCK_STARTS[name] - 1
        if name == "360":
            end_0 = BLOCK_STARTS["768"] - 1  # wykluczamy linię 533
        elif name == "768":
            end_0 = BLOCK_STARTS["1366"] - 1  # wykluczamy linię 1099
        elif name == "1366":
            end_0 = BLOCK_1366_END  # włącznie do 1824 → slice do 1824
        else:  # 1920
            end_0 = len(html_lines)
        return "\n".join(html_lines[start_0:end_0])

    blocks = {
        "360": block_html("360"),
        "768": block_html("768"),
        "1366": block_html("1366"),
        "1920": block_html("1920"),
    }

    ref_tc = extract_tag_and_class(blocks["1366"])
    class_maps = {}
    for name in ("360", "768", "1920"):
        other_tc = extract_tag_and_class(blocks[name])
        class_maps[name] = build_class_map_by_tag(other_tc, ref_tc)
        print(f"Mapowanie {name}->1366 (wg tagu): {len(class_maps[name])} par")

    with open(CSS_PATH, "r", encoding="utf-8") as f:
        css_lines = f.readlines()

    root_new = ".page--dystrybutor"
    roots = {
        "360": ".pedrollou95dystrybutoru95360px",
        "768": ".pedrollou95dystrybutoru95768px",
        "1366": ".pedrollou95dystrybutoru951366px",
        "1920": ".pedrollou95dystrybutor-all-breakpoints",
    }

    def replace_in_css(text, root_old, class_map):
        t = text.replace(root_old, root_new)
        for old_c, new_c in class_map.items():
            if old_c != new_c:
                t = re.sub(r"\." + re.escape(old_c) + r"(?![\w-])", "." + new_c, t)
        return t

    # 1) HTML: tylko blok 1366, root .page--dystrybutor
    new_html = html_lines[:17]
    new_html.append('    <div class="page page--dystrybutor screen">\n')
    new_html.extend(html_lines[1099:1823])
    new_html.append("    </div>\n")
    new_html.append("  </body>\n")
    new_html.append("</html>\n")
    with open(OUT_HTML, "w", encoding="utf-8") as f:
        f.writelines(new_html)
    print("Zapisano", OUT_HTML, "– jedna struktura (1366px).")

    # 2) CSS: 4 media, mobile-first
    out = ["/* Dystrybutor – jedna struktura, breakpointy przez media (mapowanie wg tagu) */\n"]
    for name, start, end in CSS_SECTIONS:
        section_text = "".join(css_lines[start - 1:end])
        section_text = replace_in_css(section_text, roots[name], class_maps.get(name, {}))
        if name == "360":
            out.append("@media screen and (max-width: 767px) {\n")
        elif name == "768":
            out.append("@media screen and (min-width: 768px) and (max-width: 1365px) {\n")
        elif name == "1366":
            out.append("@media screen and (min-width: 1366px) and (max-width: 1919px) {\n")
        else:
            out.append("@media screen and (min-width: 1920px) {\n")
        out.append(section_text)
        out.append("}\n\n")

    with open(OUT_CSS, "w", encoding="utf-8") as f:
        f.write("".join(out))
    print("Zapisano", OUT_CSS, "– 4 media, klasy zmapowane wg tagu.")


if __name__ == "__main__":
    main()
