"""SewCraftly reel - prepare assets.
Usage: python3 reel_prep.py <repo SCxxxx folder> <flow.mp4> <voice.mp3> <workdir> [--booklet booklet.pdf] [--sketch sketch.png]
Makes in <workdir>: ff/ (1080x1920 frames at 30 fps), front.png, back.png, front_white.png, icon.png, photo (model photo),
pages (booklet pages 4,9,13,last) or guide.jpg (tutorial image), and prints the voice pauses (silence detection).
"""
import sys, glob, os, subprocess, argparse
import numpy as np
from PIL import Image

ap = argparse.ArgumentParser()
ap.add_argument('folder'); ap.add_argument('flow'); ap.add_argument('voice'); ap.add_argument('work')
ap.add_argument('--booklet'); ap.add_argument('--sketch')
a = ap.parse_args(); W = a.work; os.makedirs(W + '/ff', exist_ok=True)

def find(pat):
    r = [f for f in glob.glob(os.path.join(a.folder, '*')) if pat(os.path.basename(f))]
    return r[0] if r else None
cover = find(lambda n: n.startswith('free-') and n.endswith('.jpg'))
model = find(lambda n: n.endswith('-model.jpg'))
tut = find(lambda n: 'tutorial' in n)
print('cover', cover, '\nmodel', model, '\ntutorial', tut)

# frames of the Flow clip
subprocess.run(['ffmpeg', '-v', 'error', '-y', '-i', a.flow, '-vf', 'fps=30,scale=1080:1920:force_original_aspect_ratio=increase:flags=lanczos,crop=1080:1920',
                '-q:v', '3', W + '/ff/%04d.jpg'], check=True)
print('flow frames', len(os.listdir(W + '/ff')))

# sketches: from the user's sketch if given, else from the white card of the cover (1170,530 445x445)
if a.sketch:
    im = Image.open(a.sketch).convert('RGBA'); bg = Image.new('RGBA', im.size, 'white'); bg.alpha_composite(im); src = bg.convert('RGB'); up = 1
else:
    src = Image.open(cover).convert('RGB').crop((1175, 535, 1610, 970)); up = 2
g = np.array(src.convert('L')) < 200
cols = np.where(g.any(axis=0))[0]
gaps = np.where(np.diff(cols) > 15)[0]
split = (cols[gaps[np.argmax(np.diff(cols)[gaps])]] + cols[gaps[np.argmax(np.diff(cols)[gaps])] + 1]) // 2 if len(gaps) else src.width // 2
for name, (x0, x1) in [('front', (0, split)), ('back', (split, src.width))]:
    sub = g[:, x0:x1]; ys, xs = np.where(sub)
    c = src.crop((x0 + xs.min() - 8, ys.min() - 8, x0 + xs.max() + 8, ys.max() + 8))
    if up > 1: c = c.resize((c.width * up, c.height * up), Image.LANCZOS)
    c.save(f'{W}/{name}.png')
    al = 255 - np.array(c.convert('L')); al = np.clip((al.astype(int) - 15) * 1.3, 0, 255).astype('uint8')
    w = Image.new('RGBA', c.size, (255, 255, 255, 0)); w.putalpha(Image.fromarray(al)); w.save(f'{W}/{name}_white.png')
Image.open(cover).crop((791, 1023, 845, 1077)).resize((128, 128), Image.LANCZOS).save(W + '/icon.png')
Image.open(model).save(W + '/photo.jpg', quality=95)

if a.booklet:
    n = int([l for l in subprocess.run(['pdfinfo', a.booklet], capture_output=True, text=True).stdout.splitlines() if l.startswith('Pages')][0].split()[-1])
    for p in [4, 9, 13, n - 1]:
        subprocess.run(['pdftoppm', '-r', '110', '-png', '-singlefile', '-f', str(p), '-l', str(p), a.booklet, f'{W}/page{p}'])
    print('pages', [f'{W}/page{p}.png' for p in [4, 9, 13, n - 1]])
elif tut:
    Image.open(tut).convert('RGB').save(W + '/guide.jpg', quality=92); print('guide image', W + '/guide.jpg')

# voice pauses
r = subprocess.run(['ffmpeg', '-i', a.voice, '-af', 'silencedetect=noise=-35dB:d=0.18', '-f', 'null', '-'], capture_output=True, text=True).stderr
dur = float(subprocess.run(['ffprobe', '-v', 'error', '-show_entries', 'format=duration', '-of', 'csv=p=0', a.voice], capture_output=True, text=True).stdout)
st = [float(l.split('silence_start: ')[1]) for l in r.splitlines() if 'silence_start' in l]
en = [float(l.split('silence_end: ')[1].split()[0]) for l in r.splitlines() if 'silence_end' in l]
t = 0.0; segs = []
for s, e in zip(st, en):
    if s > t + 0.05: segs.append((round(t, 2), round(s, 2)))
    t = e
if dur > t + 0.05: segs.append((round(t, 2), round(dur, 2)))
print('voice duration', round(dur, 2)); print('speech segments:'); [print(f'  {s} - {e}') for s, e in segs]
