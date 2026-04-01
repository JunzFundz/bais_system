<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFINITY | Premium Dashboard</title>
    <script src="../assets/js/tailwind.js"></script>
    <script src="../assets/js/iconify-icon.min.js"></script>
    <script src="../assets/js/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link href="../assets/css/output.css" rel="stylesheet" /> -->
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="../assets/css/staff.css">
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
    </script>
</head>

<body class="bg-gray-50 text-slate-800 antialiased transition-colors duration-300 dark:bg-dark-bg dark:text-slate-300 selection:bg-brand-900 selection:text-white">

    <?php
    session_start();
    require_once __DIR__ . '/../../model/Staff.php';
    include('modal-update-official.php');
    include('modal-mail.php');
    include('modal-requests.php');
    include('add-activity.php');
    // include('caching.php');

    $admin = new AdminModel();

    $brgy = $admin->getBrgy();
    $users = $admin->getAllUsers();
    $req = $admin->getAllReq();
    $viewbrgy = $admin->getAllBrgy();

    ?>

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm hidden lg:hidden transition-opacity opacity-0"></div>

    <!-- Layout Container -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-transition fixed inset-y-0 left-0 z-40 w-64 -translate-x-full border-r border-slate-200 bg-white lg:static lg:translate-x-0 dark:border-dark-border dark:bg-dark-card flex flex-col justify-between">
            <div class="">
                <!-- Logo -->
                <div class="flex h-16 items-center px-6 border-b border-slate-100 dark:border-dark-border">
                    <div class="flex items-center gap-2">
                        <div class="h-6 w-6 rounded bg-brand-900 flex items-center justify-center text-white">
                            <iconify-icon icon="solar:infinity-linear" width="16"></iconify-icon>
                        </div>
                        <span class="dark:text-white text-lg font-extrabold text-slate-900 tracking-tight font-poppins">INFINITY</span>
                    </div>
                </div>

                <!-- Nav -->
                <nav class="space-y-1 px-3 py-6">
                    <a href="home" class="group flex items-center gap-3 dark:bg-brand-900/20 dark:text-brand-100 text-sm font-medium text-brand-900 bg-brand-50 rounded-lg pt-2.5 pr-3 pb-2.5 pl-3">
                        <iconify-icon icon="solar:widget-5-linear" width="20" stroke-width="1.5"></iconify-icon>
                        Dashboard
                    </a>
                    <a href="barangay" class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white transition-all">
                        <iconify-icon icon="solar:chart-2-linear" width="20" stroke-width="1.5" class=""></iconify-icon>
                        Barangays
                    </a>
                    <a href="requests" class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white transition-all">
                        <iconify-icon icon="solar:users-group-rounded-linear" width="20" stroke-width="1.5"></iconify-icon>
                        Requests
                    </a>
                    <a href="#" class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white transition-all">
                        <iconify-icon icon="solar:wallet-money-linear" width="20" stroke-width="1.5"></iconify-icon>
                        Finance
                    </a>
                    <a href="#" class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white transition-all">
                        <iconify-icon icon="solar:folder-with-files-linear" width="20" stroke-width="1.5"></iconify-icon>
                        Documents
                    </a>
                </nav>
            </div>

            <!-- Bottom Settings -->
            <div class="border-t border-slate-100 p-3 dark:border-dark-border">
                <a href="#" class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white transition-all">
                    <iconify-icon icon="solar:settings-linear" width="20" stroke-width="1.5"></iconify-icon>
                    Settings
                </a>
                <div class="mt-4 flex items-center gap-3 px-3">
                    <div class="relative h-8 w-8 overflow-hidden rounded-full bg-slate-200">
                        <img src="https://ui-avatars.com/api/?name=Alex+Morgan&background=010694&color=fff" alt="User" class="h-full w-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-semibold text-slate-900 dark:text-white">Alex Morgan</span>
                        <span class="text-xxs text-slate-500">Admin Workspace</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
            <!-- Top Navigation -->
            <header id="top-navigation" class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200/60 bg-white/80 px-4 glass-effect lg:px-8 dark:border-dark-border dark:bg-dark-bg/80">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="flex items-center justify-center rounded-xl p-2 text-slate-500 hover:bg-slate-100 lg:hidden dark:text-slate-400 dark:hover:bg-white/5 border">
                        <iconify-icon icon="solar:hamburger-menu-linear" width="24" stroke-width="1.5"></iconify-icon>
                    </button>
                    <!-- Search -->
                    <div class="hidden md:flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-1.5 ring-1 ring-slate-200 focus-within:ring-brand-500 dark:bg-dark-card dark:ring-dark-border">
                        <iconify-icon icon="solar:magnifer-linear" class="text-slate-400"></iconify-icon>
                        <input type="text" placeholder="Search analytics..." class="w-64 bg-transparent text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none dark:text-white">
                        <div class="flex items-center gap-1 rounded border border-slate-200 px-1.5 py-0.5 dark:border-dark-border">
                            <span class="text-xs text-slate-400">⌘K</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:bg-slate-50 dark:border-dark-border dark:text-slate-400 dark:hover:bg-white/5">
                        <iconify-icon id="theme-icon" icon="solar:sun-2-linear" width="20"></iconify-icon>
                    </button>
                    <!-- Notification -->
                    <button class="relative flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:bg-slate-50 dark:border-dark-border dark:text-slate-400 dark:hover:bg-white/5">
                        <iconify-icon icon="solar:bell-linear" width="20"></iconify-icon>
                        <span class="absolute right-0 top-0 mr-0.5 mt-0.5 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-dark-bg"></span>
                    </button>
                </div>
            </header>