const THEME_KEY = 'ruto-admin-theme';

function getPreferredTheme() {
    try {
        const saved = localStorage.getItem(THEME_KEY);
        if (saved === 'dark' || saved === 'light') {
            return saved;
        }
    } catch (_) {
        /* ignore */
    }
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
}

function applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    document.documentElement.classList.toggle('ruto-theme-dark', theme === 'dark');

    const toggle = document.getElementById('ruto-theme-toggle');
    if (toggle) {
        toggle.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
        toggle.setAttribute('aria-label', theme === 'dark' ? 'Aktifkan mode terang' : 'Aktifkan mode gelap');
    }
}

function initThemeToggle() {
    const toggle = document.getElementById('ruto-theme-toggle');
    if (!toggle) {
        return;
    }

    applyTheme(getPreferredTheme());

    toggle.addEventListener('click', () => {
        const next = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        try {
            localStorage.setItem(THEME_KEY, next);
        } catch (_) {
            /* ignore */
        }
        applyTheme(next);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initThemeToggle);
} else {
    initThemeToggle();
}
