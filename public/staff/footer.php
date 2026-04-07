</main>
</div>
</body>
<script>
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

    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const html = document.documentElement;

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

    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#94a3b8';

    const usersPerMonth = <?= json_encode($chartData); ?>;

    let revenueChartInstance;
    let trafficChartInstance;

    function initCharts() {
        const isDark = html.classList.contains('dark');
        const gridColor = isDark ? '#1E2536' : '#f1f5f9';
        const textColor = isDark ? '#94a3b8' : '#64748b';

        const ctxRev = document.getElementById('revenueChart').getContext('2d');

        let gradient = ctxRev.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(1, 6, 148, 0.2)');
        gradient.addColorStop(1, 'rgba(1, 6, 148, 0)');

        revenueChartInstance = new Chart(ctxRev, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Registered Users',
                    data: usersPerMonth,
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


        const ctxTraffic = document.getElementById('trafficChart').getContext('2d');
        fetch('../../data/admin-barangay-data.php')
            .then(res => res.json())
            .then(result => {

                if (result.error) {
                    console.error("PHP ERROR:", result.error);
                    return;
                }

                trafficChartInstance = new Chart(ctxTraffic, {
                    type: 'doughnut',
                    data: {
                        labels: result.labels,
                        datasets: [{
                            data: result.data,
                            backgroundColor: [
                                '#010694',
                                '#6d70fc',
                                '#e2e8f0',
                                '#22c55e',
                                '#f59e0b',
                                '#ef4444'
                            ],
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

                updateBarangayLegend(result.labels, result.data);
            });
    }

    function updateCharts(isDark) {
        const gridColor = isDark ? '#1E2536' : '#f1f5f9';
        const textColor = isDark ? '#94a3b8' : '#64748b';

        revenueChartInstance.options.scales.y.grid.color = gridColor;
        revenueChartInstance.options.scales.y.ticks.color = textColor;
        revenueChartInstance.options.scales.x.ticks.color = textColor;
        revenueChartInstance.update();

        trafficChartInstance.data.datasets[0].backgroundColor = ['#010694', '#6d70fc', isDark ? '#334155' : '#e2e8f0'];
        trafficChartInstance.update();
    }

    function updateBarangayLegend(labels, data) {
        const container = document.getElementById('barangayLegend');
        container.innerHTML = '';

        const total = data.reduce((a, b) => a + b, 0);

        labels.forEach((label, index) => {
            const value = data[index];
            const percent = total ? ((value / total) * 100).toFixed(0) : 0;

            const colors = ['#010694', '#6d70fc', '#e2e8f0', '#22c55e', '#f59e0b', '#ef4444'];

            container.innerHTML += `
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full" style="background:${colors[index % colors.length]}"></span>
                    <span class="text-slate-600 dark:text-slate-400">${label}</span>
                </div>
                <span class="font-medium text-slate-900 dark:text-white">${percent}%</span>
            </div>
        `;
        });
    }

    document.addEventListener('DOMContentLoaded', initCharts);
</script>

</html>
<script src="../assets/js/flowbite.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script src="../assets/js/admin.js"></script>
<script src="Api.js"></script>

</html>