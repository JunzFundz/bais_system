</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script src="Api.js"></script>
<script>
    function showLoader() {
        const loader = document.getElementById('preloader');
        if (loader) {
            loader.classList.remove('hidden');
        }
    }

    function hideLoader() {
        const loader = document.getElementById('preloader');
        if (loader) {
            loader.classList.add('hidden');
        }
    }
    hideLoader()

    document.addEventListener("DOMContentLoaded", function() {
        const modalElement = document.getElementById("custom-modal");
        if (modalElement) {
            window.modalInstance = new Modal(modalElement);
        }
    });

    initFlowbite();
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

</html>