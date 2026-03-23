</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script src="Api.js"></script>
<script>
   
    
    document.addEventListener('DOMContentLoaded', () => {
        const sessionCheck = document.getElementById('show-session');

        const idSession = '<?php echo $_SESSION['u_id'] ?? '' ?>';
        if (!idSession) {
            sessionCheck.classList.remove('hidden');
            return;
        }
    });

    const logoutBtn = document.getElementById("logout-btn");

    logoutBtn.addEventListener("click", async () => {

        logoutBtn.disabled = true;
        logoutBtn.innerText = "Logging out...";

        try {

            const res = await fetch("../../data/logout.php", {
                method: "POST"
            });

            const data = await res.json();

            sessionStorage.clear();
            window.location.href = data.redirect;

        } catch (error) {

            console.error(error);
            alert("Logout failed");

        } finally {
            logoutBtn.disabled = false;
            logoutBtn.innerText = "Logout";

        }

    });

    function loadDashboard() {
        let dashboard = document.getElementById('contents');

        fetch('dashboard.php')
            .then(res => res.text())
            .then(html => {
                dashboard.innerHTML = html;
            })
            .catch(err => {
                console.error(err);
                dashboard.innerHTML = "Failed to load dashboard";
            });
    }

    async function certificates() {
        const certs = document.getElementById('contents');
        const res = await fetch('certificates.php');
        certs.innerHTML = await res.text();
    }
</script>
<script>
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
                        900: '#010694', // Deep Royal Blue
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

    // Dark Mode Logic
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const html = document.documentElement;

    // Check local storage
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        html.classList.add('dark');
        themeIcon.setAttribute('icon', 'solar:moon-linear');
    } else {
        html.classList.remove('dark');
        themeIcon.setAttribute('icon', 'solar:sun-2-linear');
    }

    themeToggle.addEventListener('click', () => {
        html.classList.toggle('dark');
        if (html.classList.contains('dark')) {
            localStorage.theme = 'dark';
            themeIcon.setAttribute('icon', 'solar:moon-linear');
        } else {
            localStorage.theme = 'light';
            themeIcon.setAttribute('icon', 'solar:sun-2-linear');
        }
    });
</script>

</html>