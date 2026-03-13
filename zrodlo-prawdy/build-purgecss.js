#!/usr/bin/env node
/**
 * Optymalizacja CSS dla index.html – usuwa nieużywane reguły (PurgeCSS).
 * Uruchom: npm install && npm run optimize:css
 * Wynik: pliki w css/optimized/ (oryginały pozostają w css/).
 */

const fs = require('fs');
const path = require('path');

const isDryRun = process.env.DRY_RUN === '1';
const contentDir = path.join(__dirname, 'index.html');
const cssDir = path.join(__dirname, 'css');
const outDir = path.join(cssDir, 'optimized');

const cssFiles = [
  'pedrollou95polskau95mainu953.css',
  'globals.css',
  'pop-up-instalator.css',
  'styleguide.css',
  'styleguide-hFF9f.css',
  'globals-hFF9f.css'
];

// Klasy/ID dodawane przez JS lub używane dynamicznie – nie usuwaj
const safelist = {
  standard: [
    /^flickity/,
    /^flickity-/,
    /--hidden$/,
    /--active$/,
    /--small$/,
    /^mobile-menu-open/,
    /^body\./,
    /^\.charakterystyka-card/,
    /^\.wybierz-zestaw/,
    /^\.niezawodnosc/,
    /^\.faq_pytanie/,
    /^\.porownanie/,
    /^\.konfigurator/,
    /^\.dane-13$/,
    /^\.dane-14$/,
    'pedrollou95polskau95mainu953',
    'screen',
    'page',
    'page--index',
    'btn--secondary-active',
    'wybierz-zestaw-tab--active',
    'charakterystyka-card--hidden',
    'wybierz-zestaw-card--hidden',
    'niezawodnosc-arrows-bottom',
    'faq-accordion-header',
    'faq-accordion-content'
  ],
  greedy: [
    /data-/, /aria-/, /role/,
    /flickity/, /js-/
  ]
};

async function runPurge() {
  let PurgeCSS;
  try {
    const mod = await import('purgecss');
    PurgeCSS = mod.PurgeCSS;
    if (typeof PurgeCSS !== 'function') throw new Error('PurgeCSS not found');
  } catch (e) {
    console.error('Zainstaluj zależności: npm install');
    process.exit(1);
  }

  if (!isDryRun && !fs.existsSync(outDir)) {
    fs.mkdirSync(outDir, { recursive: true });
  }

  const config = {
    content: [contentDir],
    css: cssFiles.map(f => path.join(cssDir, f)),
    safelist,
    rejected: isDryRun,
    rejectedCss: false
  };

  const result = await new PurgeCSS().purge(config);

  let totalOriginal = 0;
  let totalPurged = 0;

  result.forEach((output, i) => {
    const name = cssFiles[i];
    const origPath = path.join(cssDir, name);
    const orig = fs.readFileSync(origPath, 'utf8');
    const origLen = orig.length;
    const purgedLen = output.css.length;
    totalOriginal += origLen;
    totalPurged += purgedLen;
    const pct = origLen ? Math.round((1 - purgedLen / origLen) * 100) : 0;

    console.log(`${name}: ${(origLen/1024).toFixed(1)} KB → ${(purgedLen/1024).toFixed(1)} KB ( -${pct}% )`);

    if (!isDryRun && output.css) {
      const outPath = path.join(outDir, name);
      fs.writeFileSync(outPath, output.css, 'utf8');
    }
  });

  console.log('---');
  console.log(`Razem: ${(totalOriginal/1024).toFixed(1)} KB → ${(totalPurged/1024).toFixed(1)} KB`);

  if (!isDryRun) {
    console.log('\nZoptymalizowane pliki zapisane w: css/optimized/');
    console.log('Aby ich użyć, w index.html wskaż np. href="css/optimized/pedrollou95polskau95mainu953.css"');
  }
}

runPurge().catch(err => {
  console.error(err);
  process.exit(1);
});
