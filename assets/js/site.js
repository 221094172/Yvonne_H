// Yvonne Hangara — site interactions (multi-page transitions, nav, gallery, form)
(() => {
  const html = document.documentElement;

  // Mark ready for fade-in transition
  requestAnimationFrame(() => {
    html.classList.add('is-ready');
  });

  // Basic background removal for locally-hosted portrait images.
  // (Useful on Windows when you don't have an offline bg-removal tool installed.)
  const removeBackground = async (img) => {
    try {
      if (!img || img.dataset.bgRemoved === 'true') return;
      if (!img.complete) await new Promise((r) => img.addEventListener('load', r, { once: true }));

      const canvas = document.createElement('canvas');
      const w = img.naturalWidth || img.width;
      const h = img.naturalHeight || img.height;
      if (!w || !h) return;

      canvas.width = w;
      canvas.height = h;
      const ctx = canvas.getContext('2d', { willReadFrequently: true });
      if (!ctx) return;
      ctx.drawImage(img, 0, 0, w, h);

      const sampleSize = Math.max(6, Math.floor(Math.min(w, h) * 0.02)); // ~2% edge sample
      const sampleCorner = (x0, y0) => {
        const data = ctx.getImageData(x0, y0, sampleSize, sampleSize).data;
        let r = 0, g = 0, b = 0, n = 0;
        for (let i = 0; i < data.length; i += 4) {
          r += data[i]; g += data[i + 1]; b += data[i + 2];
          n++;
        }
        return [r / n, g / n, b / n];
      };

      // Average the four corners to guess the background color.
      const c1 = sampleCorner(0, 0);
      const c2 = sampleCorner(w - sampleSize, 0);
      const c3 = sampleCorner(0, h - sampleSize);
      const c4 = sampleCorner(w - sampleSize, h - sampleSize);
      const bg = [(c1[0] + c2[0] + c3[0] + c4[0]) / 4, (c1[1] + c2[1] + c3[1] + c4[1]) / 4, (c1[2] + c2[2] + c3[2] + c4[2]) / 4];

      const imageData = ctx.getImageData(0, 0, w, h);
      const d = imageData.data;

      // Two thresholds: full remove, then feather.
      const t0 = 32; // remove if closer than this
      const t1 = 70; // feather until this
      const bgLum = 0.2126 * bg[0] + 0.7152 * bg[1] + 0.0722 * bg[2];
      const dist = (r, g, b) => {
        const dr = r - bg[0], dg = g - bg[1], db = b - bg[2];
        return Math.sqrt(dr * dr + dg * dg + db * db);
      };

      for (let i = 0; i < d.length; i += 4) {
        const r = d[i], g = d[i + 1], b = d[i + 2];
        const a = d[i + 3];
        if (a === 0) continue;

        // Extra guard: only treat very bright pixels as potential background
        // when the background itself is very bright (like studio gray/white).
        const lum = 0.2126 * r + 0.7152 * g + 0.0722 * b;
        if (bgLum > 200 && lum < bgLum - 18) continue;

        const dd = dist(r, g, b);
        if (dd <= t0) {
          d[i + 3] = 0;
        } else if (dd < t1) {
          const k = (dd - t0) / (t1 - t0); // 0..1
          d[i + 3] = Math.round(a * k);
        }
      }

      ctx.putImageData(imageData, 0, 0);
      img.src = canvas.toDataURL('image/png');
      img.dataset.bgRemoved = 'true';
    } catch {
      // If anything fails, keep original image.
    }
  };

  document.querySelectorAll('img[data-remove-bg]').forEach((img) => {
    removeBackground(img);
  });

  // Mobile nav
  const toggle = document.querySelector('[data-nav-toggle]');
  const links = document.querySelector('[data-nav-links]');
  if (toggle && links) {
    toggle.addEventListener('click', () => {
      links.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', links.classList.contains('is-open') ? 'true' : 'false');
    });

    links.querySelectorAll('a').forEach((a) => {
      a.addEventListener('click', () => links.classList.remove('is-open'));
    });
  }

  // Smooth multi-page fade transition for internal links
  const isInternal = (a) => {
    try {
      const url = new URL(a.href, window.location.href);
      return url.origin === window.location.origin;
    } catch {
      return false;
    }
  };

  document.addEventListener('click', (e) => {
    const a = e.target.closest('a[data-transition]');
    if (!a) return;
    if (a.target && a.target !== '_self') return;
    if (!isInternal(a)) return;
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

    e.preventDefault();
    html.classList.add('is-leaving');
    const href = a.getAttribute('href');
    window.setTimeout(() => {
      window.location.href = href;
    }, 160);
  });

  // Gallery lightbox
  const galleryButtons = document.querySelectorAll('[data-gallery-item]');
  const lightbox = document.querySelector('[data-lightbox]');
  const lightboxImg = document.querySelector('[data-lightbox-img]');
  const lightboxClose = document.querySelector('[data-lightbox-close]');

  const closeLightbox = () => {
    if (!lightbox) return;
    lightbox.classList.remove('is-open');
    document.body.style.overflow = '';
  };

  if (galleryButtons.length && lightbox && lightboxImg) {
    galleryButtons.forEach((btn) => {
      btn.addEventListener('click', () => {
        const src = btn.getAttribute('data-image');
        if (!src) return;
        lightboxImg.src = src;
        lightbox.classList.add('is-open');
        document.body.style.overflow = 'hidden';
      });
    });

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeLightbox();
    });
  }

  // Contact form validation (client-side)
  const form = document.querySelector('[data-contact-form]');
  if (form) {
    const fields = {
      name: form.querySelector('#name'),
      email: form.querySelector('#email'),
      subject: form.querySelector('#subject'),
      message: form.querySelector('#message'),
    };
    const hints = {
      name: form.querySelector('#name-error'),
      email: form.querySelector('#email-error'),
      subject: form.querySelector('#subject-error'),
      message: form.querySelector('#message-error'),
    };

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    const show = (key, on) => {
      if (!hints[key]) return;
      hints[key].classList.toggle('is-on', !!on);
    };

    const validate = () => {
      let ok = true;
      if (!fields.name?.value.trim()) { show('name', true); ok = false; } else show('name', false);
      if (!emailPattern.test(fields.email?.value.trim() || '')) { show('email', true); ok = false; } else show('email', false);
      if (!fields.subject?.value.trim()) { show('subject', true); ok = false; } else show('subject', false);
      if (!fields.message?.value.trim()) { show('message', true); ok = false; } else show('message', false);
      return ok;
    };

    form.addEventListener('submit', (e) => {
      if (!validate()) e.preventDefault();
    });

    Object.keys(fields).forEach((k) => {
      fields[k]?.addEventListener('blur', validate);
      fields[k]?.addEventListener('input', () => show(k, false));
    });
  }
})();

