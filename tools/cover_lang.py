"""Re-letters an existing SewCraftly cover (1650x1100) in another language.

Keeps the photo, the sketch card and the black site bar of a base cover
(for example the German one) and redraws the right-hand text panel.

Usage:
  python3 cover_lang.py base.jpg out.jpg --title "Wijde broek|met elastiek" \
      --sub "Broek met strikkoord" --code SC1009 --sizes "Maten 34 – 54" \
      --level 1 --lang nl
"""
import argparse
from PIL import Image, ImageDraw, ImageFont

F = '/usr/share/fonts/truetype/google-fonts/Poppins-'
BG = (247, 240, 232)
INK = (31, 29, 30)
TERRA = (176, 84, 62)
GREY = (110, 103, 99)
WHITE = (255, 255, 255)

L10N = {
    'nl': {
        'badge': 'GRATIS PDF-NAAIPATROON',
        'code': 'PATROONCODE',
        'level_lbl': 'NIVEAU',
        'levels': {1: 'Beginner', 2: 'Gemiddeld', 3: 'Gevorderd'},
        'checks': ['A4 & US Letter', 'Met naaihandleiding'],
    },
}


def font(w, s):
    return ImageFont.truetype(F + w + '.ttf', s)


def pill(d, x, y, h, text, f, fill, color, pad):
    w = d.textlength(text, font=f)
    d.rounded_rectangle([x, y, x + w + 2 * pad, y + h], radius=h // 2, fill=fill)
    d.text((x + pad, y + h / 2), text, font=f, fill=color, anchor='lm')
    return x + w + 2 * pad


def check(d, cx, cy, r=16):
    d.ellipse([cx - r, cy - r, cx + r, cy + r], fill=TERRA)
    d.line([(cx - 7, cy + 1), (cx - 2, cy + 6), (cx + 8, cy - 6)], fill=WHITE, width=4, joint='curve')


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument('base')
    ap.add_argument('out')
    ap.add_argument('--title', required=True, help='lines separated by |')
    ap.add_argument('--sub', default='')
    ap.add_argument('--code', required=True)
    ap.add_argument('--sizes', required=True)
    ap.add_argument('--level', type=int, default=1)
    ap.add_argument('--lang', default='nl')
    a = ap.parse_args()
    t = L10N[a.lang]

    im = Image.open(a.base).convert('RGB')
    d = ImageDraw.Draw(im)
    # detect the white sketch card and the black bottom bar, then clear everything else in the panel
    px = im.load()
    W, H = im.size
    wh = lambda q: min(q) > 243
    bar = H - 1
    while bar > 800 and sum(px[660, bar - 1]) < 200:
        bar -= 1
    rows = []
    for yy in range(300, bar):
        best, run, st, bs = 0, 0, 0, 0
        for xx in range(1000, W):
            if wh(px[xx, yy]):
                if run == 0:
                    st = xx
                run += 1
                if run > best:
                    best, bs = run, st
            else:
                run = 0
        if best > 250:
            rows.append((yy, bs, bs + best - 1))
    y0c, y1c = rows[0][0], rows[-1][0]
    x0c = min(r[1] for r in rows)
    x1c = max(r[2] for r in rows)
    cx0, cx1, cy0, cy1 = x0c - 8, x1c + 8, y0c - 8, y1c + 8
    for (x0_, y0_, x1_, y1_) in [(636, 0, W, cy0 - 1), (636, cy0, cx0 - 1, bar - 1),
                                 (cx1 + 1, cy0, W, bar - 1), (cx0, cy1 + 1, cx1, bar - 1)]:
        if x1_ > x0_ and y1_ > y0_:
            d.rectangle([x0_, y0_, x1_, y1_], fill=BG)

    X = 700
    lines = a.title.split('|')
    size = 92
    ft = font('Bold', size)
    while max(d.textlength(l, font=ft) for l in lines) > 900 and size > 56:
        size -= 2
        ft = font('Bold', size)
    lh = int(size * 0.98)
    top = 100 if len(lines) == 2 else (150 if len(lines) == 1 else 70)
    y = top
    for l in lines:
        d.text((X, y), l, font=ft, fill=INK, anchor='lt')
        y += lh
    y = max(y + 36, 300)
    if a.sub:
        d.text((X, y + 16), a.sub, font=font('Regular', 30), fill=GREY, anchor='lm')
    pill(d, X - 2, 378, 74, t['badge'], font('Bold', 26), INK, WHITE, 28)

    # code pill
    fl = font('Bold', 16)
    fc = font('Bold', 38)
    lw = d.textlength(t['code'], font=fl)
    cw = d.textlength('#' + a.code, font=fc)
    x0, y0, h = X - 2, 478, 74
    w = 30 + lw + 40 + cw + 32
    d.rounded_rectangle([x0, y0, x0 + w, y0 + h], radius=h // 2, fill=TERRA)
    d.text((x0 + 30, y0 + h / 2), t['code'], font=fl, fill=WHITE, anchor='lm')
    sx = x0 + 30 + lw + 20
    d.line([(sx, y0 + 20), (sx, y0 + h - 20)], fill=WHITE, width=2)
    d.text((sx + 20, y0 + h / 2 + 1), '#' + a.code, font=fc, fill=WHITE, anchor='lm')

    # checklist
    fr = font('Regular', 28)
    for i, txt in enumerate([a.sizes] + t['checks']):
        cy = 612 + i * 54
        check(d, 713, cy)
        d.text((748, cy), txt, font=fr, fill=INK, anchor='lm')

    # level badge
    y0, h = 779, 66
    fl2 = font('Bold', 16)
    lbl_w = d.textlength(t['level_lbl'], font=fl2) + 40
    lv = t['levels'][a.level]
    fv = font('Bold', 24)
    vw = 18 + 62 + d.textlength(lv, font=fv) + 18
    d.rounded_rectangle([X - 2, y0, X - 2 + lbl_w + vw, y0 + h], radius=h // 2, fill=TERRA)
    d.rounded_rectangle([X - 2 + lbl_w - 2, y0 + 3, X - 2 + lbl_w + vw - 3, y0 + h - 3], radius=(h - 6) // 2, fill=WHITE)
    d.rectangle([X - 2 + lbl_w - 2, y0 + 3, X - 2 + lbl_w + 30, y0 + h - 3], fill=WHITE)
    d.text((X - 2 + 20, y0 + h / 2), t['level_lbl'], font=fl2, fill=WHITE, anchor='lm')
    dx = X - 2 + lbl_w + 18
    cy = y0 + h / 2
    for k in range(3):
        cx = dx + 8 + k * 17
        pts = [(cx, cy - 7), (cx + 7, cy), (cx, cy + 7), (cx - 7, cy)]
        if k < a.level:
            d.polygon(pts, fill=TERRA)
        else:
            d.polygon(pts, outline=TERRA, width=2)
    d.text((dx + 62, cy), lv, font=fv, fill=INK, anchor='lm')

    im.save(a.out, quality=90, optimize=True, progressive=True)


if __name__ == '__main__':
    main()
