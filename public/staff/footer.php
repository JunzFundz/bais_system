</main>
</div>
</body>
<script>
    // Sidebar Toggle Logic
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
            updateCharts(true);
        } else {
            localStorage.theme = 'light';
            themeIcon.setAttribute('icon', 'solar:sun-2-linear');
            updateCharts(false);
        }
    });

    // Charts Configuration
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#94a3b8';

    let revenueChartInstance;
    let trafficChartInstance;

    function initCharts() {
        const isDark = html.classList.contains('dark');
        const gridColor = isDark ? '#1E2536' : '#f1f5f9';
        const textColor = isDark ? '#94a3b8' : '#64748b';

        // Revenue Chart (Line)
        const ctxRev = document.getElementById('revenueChart').getContext('2d');

        // Gradient
        let gradient = ctxRev.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(1, 6, 148, 0.2)');
        gradient.addColorStop(1, 'rgba(1, 6, 148, 0)');

        revenueChartInstance = new Chart(ctxRev, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                datasets: [{
                    label: 'Revenue',
                    data: [12, 19, 15, 25, 22, 30, 28, 35],
                    borderColor: '#010694',
                    backgroundColor: gradient,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#010694',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: gridColor,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                size: 11
                            }
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                size: 11
                            }
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });

        // Traffic Chart (Doughnut)
        const ctxTraffic = document.getElementById('trafficChart').getContext('2d');
        trafficChartInstance = new Chart(ctxTraffic, {
            type: 'doughnut',
            data: {
                labels: ['Direct', 'Social', 'Referral'],
                datasets: [{
                    data: [45, 32, 23],
                    backgroundColor: ['#010694', '#6d70fc', '#e2e8f0'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    function updateCharts(isDark) {
        const gridColor = isDark ? '#1E2536' : '#f1f5f9';
        const textColor = isDark ? '#94a3b8' : '#64748b';

        // Update Line Chart
        revenueChartInstance.options.scales.y.grid.color = gridColor;
        revenueChartInstance.options.scales.y.ticks.color = textColor;
        revenueChartInstance.options.scales.x.ticks.color = textColor;
        revenueChartInstance.update();

        // Update Doughnut Chart (Colors)
        trafficChartInstance.data.datasets[0].backgroundColor = ['#010694', '#6d70fc', isDark ? '#334155' : '#e2e8f0'];
        trafficChartInstance.update();
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', initCharts);
</script>
</html>
<script src="../assets/js/flowbite.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script src="../assets/js/admin.js"></script>
<script src="Api.js"></script>
<script>
    $(document).ready(function() {
        $('#add-post').on('click', function(e) {
            e.preventDefault();

            let title = $('#post-title').val().trim();
            let description = $('#post-description').val().trim();
            let files = $('#post-file')[0].files;

            if (title === '') {
                alert('Title is required');
                return;
            }

            if (files.length === 0) {
                alert('Please select at least one file');
                return;
            }

            let formData = new FormData();
            formData.append('title', title);
            formData.append('description', description);

            // Append each selected file
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            $.ajax({
                url: '../../data/admin-add-act.php', // your PHP file that calls AdminModel
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    // Response from PHP
                    alert(response.message);
                    if (response.success) {
                        $('#post-title').val('');
                        $('#post-description').val('');
                        $('#post-file').val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Something went wrong while uploading.');
                }
            });
        });
    });

    function transactions() {
        $('#content-navigations').load('transactions.php', function() {
            initFlowbite();
        });
    }

    function officials() {
        $('#content-navigations').load('officials.php', function() {
            initFlowbite();
        });
    }

    function brgy() {
        $('#content-navigations').load('barangay.php', function() {
            initFlowbite();
        });
    }

    function certificates() {
        $('#content-navigations').load('certificates.php', function() {
            initFlowbite();
        });
    }

    function createCert() {
        $('#--add-cert').load('add-certificates.php');
    }

    function requests() {
        $('#content-navigations').load('requests.php', function() {
            initFlowbite();
        });
    }

    function users() {
        $('#content-navigations').load('users.php', function() {
            initFlowbite();
        });
    }
</script>

</html>