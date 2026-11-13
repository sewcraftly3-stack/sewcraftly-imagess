window.__send = async function (pid) {
  const S = ms => new Promise(r => setTimeout(r, ms));
  const P = await (await fetch('https://raw.githubusercontent.com/sewcraftly3-stack/sewcraftly-imagess/main/b2/prompts.json')).json();
  const ed = document.querySelector('#prompt-textarea');
  ed.focus();
  document.execCommand('insertText', false, P[pid]);
  for (let i = 0; i < 60; i++) {
    await S(500);
    const b = document.querySelector('[data-testid=send-button]');
    if (b && !b.disabled) { b.click(); return 'sent ' + pid; }
  }
  return 'nosend';
};
window.__grab = function (n) {
  const ims = [...document.querySelectorAll('img')].filter(i => i.naturalWidth == 1024 && i.naturalHeight == 1536);
  if (!ims.length) return 0;
  const src = ims[ims.length - 1 - (n || 0)].src;
  let o = document.getElementById('__ov'); if (o) o.remove();
  o = document.createElement('div'); o.id = '__ov';
  o.style.cssText = 'position:fixed;inset:0;z-index:2147483647;background:#fff;overflow:hidden';
  const im = document.createElement('img'); im.id = '__ovimg'; im.src = src;
  im.style.cssText = 'position:absolute;left:0;top:0;width:512px;height:768px;max-width:none';
  o.appendChild(im); document.body.appendChild(o); return ims.length;
};
window.__wait = async function () {
  for (let i = 0; i < 40; i++) {
    if (!document.querySelector('[data-testid=stop-button]') && [...document.querySelectorAll('img')].some(i => i.naturalWidth == 1024)) return 'done';
    await new Promise(r => setTimeout(r, 3000));
  }
  return 'timeout';
};
'ok';
