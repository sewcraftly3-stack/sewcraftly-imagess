"""SewCraftly Reel v2 - Flow clip hook + voice-over + branded karaoke subtitles.
Usage: python3 reel_v2.py config.json out.mp4
Brand: terracotta #b5593e / #d0673f, dark #251d1b, cream #f4efe9, Poppins.
Config:
  flow_frames: dir of 1080x1920 jpg frames at 30 fps (from the Flow clip)
  voice: mp3 ; photo, front, back, front_white, icon, pages[]
  name, code, sizes, level, keyword (comment keyword, e.g. PATTERN)
  segments: [[start, end, "text", [optional word weights]]]  (from silence detection of the voice)
  scenes: {"hook":[a,b],"details":[a,b],"sketch":[a,b],"guide":[a,b],"end":[a,b]}
  zoom:{x,y,scale}, callouts:[{text,px,py,at}]
  highlight: words to colour cream/terracotta permanently (e.g. FREE, PATTERN)
"""
import sys, json, base64, pathlib, subprocess, re, os
from playwright.sync_api import sync_playwright

FPS = 30
cfg = json.load(open(sys.argv[1])); out = sys.argv[2]

def b64(p):
    e = pathlib.Path(p).suffix.lstrip('.').replace('jpg', 'jpeg')
    return f"data:image/{e};base64," + base64.b64encode(open(p, 'rb').read()).decode()

# ---- word timings: split each segment proportionally to word weights (letters, or given weights)
words = []
for seg in cfg['segments']:
    a, b, text = seg[0], seg[1], seg[2]
    ws = text.split()
    wt = seg[3] if len(seg) > 3 else [max(2, len(re.sub(r'\W', '', w))) + 1.5 for w in ws]
    tot = sum(wt); t = a
    chunk = []
    for w, k in zip(ws, wt):
        d = (b - a) * k / tot
        chunk.append({'w': w, 's': round(t, 3), 'e': round(t + d, 3)}); t += d
    # group into lines of max 3 words / 20 chars
    line = []
    for x in chunk:
        if line and (len(line) >= 3 or len(' '.join(y['w'] for y in line + [x])) > 20):
            words.append(line); line = []
        line.append(x)
    words.append(line)
lines = [{'s': l[0]['s'], 'e': l[-1]['e'], 'w': l} for l in words]
for i in range(len(lines) - 1):  # hold each line until the next one starts (max 0.6 s gap)
    lines[i]['e'] = min(lines[i + 1]['s'], lines[i]['e'] + 0.6)
lines[-1]['e'] += 0.6

dur = cfg['scenes']['end'][1]
# callouts given as photo fractions (fx, fy) -> screen px after the zoom; clamped away from the Reels side icons
from PIL import Image as _I
_w, _h = _I.open(cfg['photo']).size; _s = max(1080 / _w, 1920 / _h); _ox, _oy = (_w * _s - 1080) / 2, (_h * _s - 1920) / 2
_Z = cfg['zoom']; _zx, _zy = _Z['x'] * 1080, _Z['y'] * 1920
for c in cfg['callouts']:
    if 'fx' in c:
        x = c['fx'] * _w * _s - _ox; y = c['fy'] * _h * _s - _oy
        x = _zx + (x - _zx) * _Z['scale'] + c.get('dx', 30); y = _zy + (y - _zy) * _Z['scale'] + c.get('dy', -30)
        wpx = 60 + 24 * len(c['text'])
        c['px'] = round(min(max(40, x), 940 - wpx)); c['py'] = round(min(max(330, y), 1300))
if 'guide_image' in cfg and not cfg.get('pages'):
    cfg['pages'] = [cfg['guide_image']]
GSTYLE = '.pg{{left:90px!important;width:900px!important;aspect-ratio:1/1!important}}' if cfg.get('guide_image') and cfg['pages'] == [cfg['guide_image']] else ''
pages = ''.join(f'<div class="pg" id="pg{i}"><img src="{b64(p)}"></div>' for i, p in enumerate(cfg['pages']))
callouts = ''.join(f'<div class="co" id="co{i}"><span></span>{c["text"]}</div>' for i, c in enumerate(cfg['callouts']))
SC = cfg['scenes']

HTML = f"""<!doctype html><html><head><meta charset=utf-8><style>
*{{margin:0;padding:0;box-sizing:border-box}}
body{{width:1080px;height:1920px;overflow:hidden;font-family:Poppins;background:#251d1b;position:relative}}
.sc{{position:absolute;inset:0;opacity:0;overflow:hidden}}
#hook img{{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}}
#hook .grad{{position:absolute;left:0;right:0;bottom:0;height:900px;background:linear-gradient(#251d1b00,#251d1b99)}}
.badge{{position:absolute;left:50%;top:230px;transform:translateX(-50%);background:#b5593e;color:#fff;font-weight:700;font-size:46px;
  letter-spacing:3px;padding:18px 40px;border-radius:60px;box-shadow:0 10px 30px #0004;white-space:nowrap}}
.badge i{{font-style:normal;color:#f4efe9;opacity:.85;font-weight:500}}
#details .ph{{position:absolute;inset:0;background:url({b64(cfg['photo'])}) 50% 50%/cover}}
.co{{position:absolute;z-index:4;background:#f4efe9;color:#251d1b;font-weight:700;font-size:42px;padding:16px 32px 16px 22px;border-radius:60px;
  box-shadow:0 12px 30px #0006;display:flex;align-items:center;gap:16px;white-space:nowrap;border:4px solid #b5593e}}
.co span{{width:24px;height:24px;border-radius:50%;background:#b5593e;display:inline-block}}
.ttl{{position:absolute;left:0;right:0;top:230px;text-align:center;font-weight:700;font-size:66px;color:#251d1b;line-height:1.1}}
.ttl small{{display:block;font-size:32px;font-weight:600;color:#b5593e;margin-top:12px;letter-spacing:3px}}
#sketch{{background:#f4efe9}}
#sketch .card{{position:absolute;left:80px;right:80px;top:440px;height:820px;background:#fff;border-radius:40px;box-shadow:0 20px 50px #251d1b22;
  display:flex;align-items:flex-end;justify-content:center;gap:30px;padding:50px 30px;border:4px solid #b5593e}}
#sketch .f{{height:700px}} #sketch .b{{height:500px}}
#guide{{background:#eadbd3}}
.pg{{position:absolute;left:220px;top:430px;width:640px;aspect-ratio:1/1.414;background:#fff;border-radius:10px;box-shadow:0 30px 60px #251d1b45;overflow:hidden}}
.pg img{{width:100%;height:100%;display:block}}
#end{{background:#251d1b;color:#fff}}
#end .tag{{position:absolute;left:80px;top:210px;background:#f4efe9;color:#251d1b;font-weight:700;font-size:36px;padding:16px 30px;border-radius:50px}}
#end h1{{position:absolute;left:80px;right:80px;top:310px;font-size:96px;line-height:1.02;font-weight:700;letter-spacing:-1px}}
#end .chips{{position:absolute;left:80px;top:560px;display:flex;flex-wrap:wrap;gap:18px;width:560px}}
#end .chips div{{border:3px solid #f4efe9;border-radius:50px;padding:14px 30px;font-size:38px;font-weight:600}}
#end .chips .c{{background:#b5593e;border-color:#b5593e}}
#end .sk{{position:absolute;right:70px;top:540px;height:420px}}
.cta{{position:absolute;left:90px;right:90px;text-align:center;border-radius:70px;font-weight:700}}
#cta1{{top:1290px;background:#f4efe9;color:#251d1b;font-size:54px;padding:24px}}
#cta2{{top:1425px;background:#b5593e;color:#fff;font-size:54px;padding:26px;border:4px solid #f4efe9}}
#cta2 b{{font-size:64px;letter-spacing:2px;color:#f4efe9}}
.wm{{position:absolute;left:50%;top:1470px;transform:translateX(-50%);display:flex;align-items:center;gap:16px;background:#f4efe9;
  padding:10px 34px 10px 12px;border-radius:50px;z-index:20;box-shadow:0 8px 24px #0005;border:3px solid #b5593e;white-space:nowrap}}
.wm img{{width:62px;height:62px;border-radius:12px}} .wm span{{color:#251d1b;font-weight:700;font-size:38px}}
/* subtitles */
#sub{{position:absolute;left:70px;right:70px;top:1290px;z-index:30;text-align:center;line-height:1.25}}
#sub .w{{display:inline-block;font-weight:800;font-size:78px;color:#fff;margin:0 8px;padding:2px 14px;border-radius:18px;
  -webkit-text-stroke:6px #251d1b;paint-order:stroke fill;text-shadow:0 6px 18px #000c;transition:none}}
#sub .w.on{{color:#FFD60A;transform:scale(1.12)}}
#sub .w.hl{{color:#FFD60A}}
#sub .w.hl.on{{color:#FFD60A}}
""" + GSTYLE.replace('{{','{').replace('}}','}') + f"""</style></head><body>
<div class=sc id=hook><img id=hf><div class=grad></div></div>
<div class=sc id=details><div class=ph id=dph></div>{callouts}</div>
<div class=sc id=sketch><div class=ttl>Front &amp; back<small>XXS – 4XL · A4 &amp; US LETTER</small></div>
  <div class=card><img class=f id=skf src="{b64(cfg['front'])}"><img class=b id=skb src="{b64(cfg['back'])}"></div></div>
<div class=sc id=guide><div class=ttl>Step-by-step guide<small>ILLUSTRATED INSTRUCTIONS</small></div>{pages}</div>
<div class=sc id=end><div class=tag>FREE PDF + STEP-BY-STEP</div><h1>{cfg['name']}</h1>
  <div class=chips><div class=c>#{cfg['code']}</div><div>{cfg['sizes']}</div><div>A4 &amp; US Letter</div><div>{cfg['level']}</div></div>
  <img class=sk src="{b64(cfg['front_white'])}">
  <div class=cta id=cta1>Link in bio</div><div class=cta id=cta2>Comment <b>{cfg['keyword']}</b></div></div>
<div id=sub></div><div class=wm id=wm><img src="{b64(cfg['icon'])}"><span>sewcraftlypatterns.com</span></div>
<script>
const SC={json.dumps(SC)}, L={json.dumps(lines)}, CO={json.dumps(cfg['callouts'])}, Z={json.dumps(cfg['zoom'])}, HL={json.dumps([h.upper() for h in cfg['highlight']])};
const X=.22, cl=(v,a,b)=>Math.max(a,Math.min(b,v)), ease=t=>1-Math.pow(1-cl(t,0,1),3), back=t=>{{t=cl(t,0,1);const c=1.7;return 1+(c+1)*Math.pow(t-1,3)+c*Math.pow(t-1,2)}};
const order=['hook','details','sketch','guide','end'];
window.setT=function(t){{
  order.forEach((k,i)=>{{const [a,b]=SC[k]; const el=document.getElementById(k);
    let o=(t<a-X||t>b+0.01)?0:cl((t-(a-X))/X,0,1); if(i==0&&t<b) o=1; el.style.opacity=o; el.style.zIndex=i;}});
  // hook badge pop
  // details zoom + callouts
  const [da]=SC.details; const z=ease((t-da)/2.2); const ph=document.getElementById('dph');
  ph.style.transformOrigin=`${{Z.x*100}}% ${{Z.y*100}}%`; ph.style.transform=`scale(${{1+(Z.scale-1)*z}})`;
  CO.forEach((c,i)=>{{const el=document.getElementById('co'+i); const k=back((t-c.at)/.35);
    el.style.left=c.px+'px'; el.style.top=c.py+'px'; el.style.opacity=cl((t-c.at)/.15,0,1); el.style.transform=`scale(${{k}})`;}});
  // sketch draw
  const [sa]=SC.sketch;
  document.getElementById('skf').style.clipPath=`inset(0 0 ${{100-cl((t-sa+.1)/1.1,0,1)*100}}% 0)`;
  document.getElementById('skb').style.clipPath=`inset(0 0 ${{100-cl((t-sa-.5)/0.9,0,1)*100}}% 0)`;
  // guide pages
  const [ga,gb]=SC.guide, n=document.querySelectorAll('.pg').length, d=(gb-ga-.1)/n;
  for(let i=0;i<n;i++){{const pg=document.getElementById('pg'+i), s=ga-.1+i*d, k=ease((t-s)/.3), r=[-4,3,-2,4][i%4];
    pg.style.zIndex=i; pg.style.opacity=t<s?0:1; pg.style.transform=`translateX(${{(1-k)*900}}px) rotate(${{r*k+(1-k)*14}}deg)`;}}
  // end CTAs
  const [ea]=SC.end, c1=document.getElementById('cta1'), c2=document.getElementById('cta2');
  const k1=back((t-SC.cta1)/.4), k2=back((t-SC.cta2)/.4);
  c1.style.opacity=t>SC.cta1?1:0; c1.style.transform=`scale(${{k1}})`;
  c2.style.opacity=t>SC.cta2?1:0; c2.style.transform=`scale(${{k2*(t>SC.cta2+.5?1+.035*Math.sin((t-SC.cta2)*7):1)}})`;
  // subtitles
  const sub=document.getElementById('sub'); const ln=L.find(l=>t>=l.s-.05&&t<l.e);
  const st=(t>=SC.end[0]?990:1290); sub.style.top=st+'px'; document.getElementById('wm').style.top=(st+170)+'px';
  if(!ln){{sub.innerHTML='';return;}}
  sub.innerHTML=ln.w.map(w=>{{const on=t>=w.s&&t<w.e+.02; const clean=w.w.replace(/[^\\w-]/g,'').toUpperCase();
     const hl=HL.some(h=>clean.startsWith(h)); return `<span class="w${{on?' on':''}}${{hl?' hl':''}}">${{w.w}}</span>`}}).join(' ');
}};
window.setHook=function(src){{return new Promise(r=>{{const im=document.getElementById('hf'); im.onload=r; im.src=src;}})}};
</script></body></html>"""

html_path = '/tmp/reel_v2.html'; open(html_path, 'w').write(HTML)
fr = sorted(pathlib.Path(cfg['flow_frames']).glob('*.jpg'))
frames = int(round(dur * FPS))
tmp = '/tmp/reel_v2_silent.mp4'
ff = subprocess.Popen(['ffmpeg', '-y', '-loglevel', 'error', '-f', 'image2pipe', '-framerate', str(FPS), '-c:v', 'mjpeg', '-i', '-',
                       '-c:v', 'libx264', '-preset', 'veryfast', '-crf', '19', '-pix_fmt', 'yuv420p', tmp], stdin=subprocess.PIPE)
stills = set(cfg.get('stills', []))
with sync_playwright() as p:
    b = p.chromium.launch(args=['--allow-file-access-from-files'])
    pg = b.new_page(viewport={'width': 1080, 'height': 1920})
    pg.goto('file://' + html_path); pg.wait_for_timeout(600)
    for i in range(frames):
        t = i / FPS
        if t < SC['hook'][1] + 0.3:
            pg.evaluate('src=>setHook(src)', 'file://' + str(fr[min(i, len(fr) - 1)].resolve()))
        pg.evaluate(f'setT({t})')
        ff.stdin.write(pg.screenshot(type='jpeg', quality=90))
        if i in stills: pg.screenshot(path=f'/tmp/v2_{i}.png')
    b.close()
ff.stdin.close(); ff.wait()
subprocess.run(['ffmpeg', '-y', '-loglevel', 'error', '-i', tmp, '-i', cfg['voice'], '-map', '0:v', '-map', '1:a', '-c:v', 'copy',
                '-c:a', 'aac', '-b:a', '192k', '-af', 'apad', '-t', str(dur), '-movflags', '+faststart', out], check=True)
print('saved', out, len(lines), 'subtitle lines')
