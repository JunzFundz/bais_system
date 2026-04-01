tailwind.config = {
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                brand: {
                    DEFAULT: '#010694',
                    50: '#eff0ff',
                    100: '#e0e2ff',
                    200: '#c3c7ff',
                    300: '#9aa0ff',
                    400: '#6d70fc',
                    500: '#4346ef',
                    600: '#2b2bd1',
                    700: '#2220aa',
                    800: '#1e1c89',
                    900: '#010694',
                },
                dark: {
                    bg: '#0B0F19',
                    card: '#111623',
                    border: '#1E2536'
                }
            },
            fontSize: {
                xxs: '0.65rem',
            }
        }
    }
}

const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebar-overlay');
let isSidebarOpen = false;

function toggleSidebar() {
    isSidebarOpen = !isSidebarOpen;
    if (isSidebarOpen) {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden', 'opacity-0');
    } else {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('opacity-0');
        setTimeout(() => overlay.classList.add('hidden'), 300);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const html = document.documentElement;

    // initialize theme
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        html.classList.add('dark');
        if (themeIcon) themeIcon.setAttribute('icon', 'solar:moon-linear');
    } else {
        html.classList.remove('dark');
        if (themeIcon) themeIcon.setAttribute('icon', 'solar:sun-2-linear');
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            if (html.classList.contains('dark')) {
                localStorage.theme = 'dark';
                if (themeIcon) themeIcon.setAttribute('icon', 'solar:moon-linear');
            } else {
                localStorage.theme = 'light';
                if (themeIcon) themeIcon.setAttribute('icon', 'solar:sun-2-linear');
            }
        });
    }
});