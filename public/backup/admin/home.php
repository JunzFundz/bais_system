<?php
include("header.php");
?>

<div class="bg-slate-50 text-slate-600 dark:bg-gray-900 font-sans antialiased overflow-x-hidden">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-transition fixed inset-y-0 left-0 z-40 w-64 bg-white/90 backdrop-blur-xl border-r border-slate-100 transform -translate-x-full md:relative md:translate-x-0 flex flex-col justify-between shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
            <!-- Logo Area -->
            <div class="h-20 flex items-center px-8 border-b border-slate-50/50">
                <div class="flex items-center gap-3">
                    <button id="theme-toggle" class=" mr-4 flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:bg-slate-50 dark:border-dark-border dark:text-slate-400 dark:hover:bg-white/5">
                        <iconify-icon id="theme-icon" icon="solar:sun-2-linear" width="20"></iconify-icon>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Overview</p>

                <a href="#" class="group flex items-center gap-3 text-primary transition-all duration-200 font-medium font-poppins rounded-xl pt-3 pr-4 pb-3 pl-4">
                    <iconify-icon icon="solar:widget-5-linear" width="20" stroke-width="1.5"></iconify-icon>
                    <span class="">Dashboard</span>
                </a>

                <a onclick="officials()" href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                    <iconify-icon icon="solar:chart-square-linear" width="20" stroke-width="1.5" class=""></iconify-icon>
                    <span>Officials</span>
                </a>

                <a onclick="transactions()" href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                    <iconify-icon icon="solar:wallet-money-linear" width="20" stroke-width="1.5"></iconify-icon>
                    <span>Transactions</span>
                </a>
                <a onclick="brgy()" href="#" class="group flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                    <iconify-icon icon="solar:wallet-money-linear" width="20" stroke-width="1.5"></iconify-icon>
                    <span>Baranggay</span>
                </a>

                <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4 mt-8">Management</p>

                <a href="#" onclick="users()" class="group flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                    <iconify-icon icon="solar:users-group-rounded-linear" width="20" stroke-width="1.5"></iconify-icon>
                    <span>Users</span>
                </a>

                <a href="#" onclick="certificates()" class="group flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                    <iconify-icon icon="solar:box-minimalistic-linear" width="20" stroke-width="1.5"></iconify-icon>
                    <span>Certificates</span>
                </a>

                <a href="#" onclick="requests()" class="group flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                    <iconify-icon icon="solar:bell-bing-linear" width="20" stroke-width="1.5"></iconify-icon>
                    <div class="flex-1 flex justify-between items-center">
                        <span>Requests</span>
                        <span class="bg-rose-100 text-rose-600 text-[10px] font-bold px-2 py-0.5 rounded-full">3</span>
                    </div>
                </a>
            </nav>

            <!-- Bottom Actions -->
            <div class="p-4 border-t border-slate-50">
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-primary transition-all duration-200">
                    <iconify-icon icon="solar:settings-linear" width="20" stroke-width="1.5"></iconify-icon>
                    <span>Settings</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-rose-500 transition-all duration-200 mt-1">
                    <iconify-icon icon="solar:logout-2-linear" width="20" stroke-width="1.5"></iconify-icon>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Overlay for Mobile -->
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-dark/20 backdrop-blur-sm z-40 hidden md:hidden transition-opacity opacity-0"></div>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col relative overflow-y-auto overflow-x-hidden scroll-smooth">

            <!-- Header -->
            <header class="sticky flex glass md:px-10 md:pt-3 md:pb-3 h-20 z-30 pt-3 pr-6 pb-3 pl-6 top-0 items-center justify-between">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="md:hidden text-slate-500 hover:text-primary transition-colors p-1">
                        <iconify-icon icon="solar:hamburger-menu-linear" width="24" stroke-width="1.5"></iconify-icon>
                    </button>
                    <!-- Breadcrumbs -->
                    <nav class="hidden sm:flex items-center text-sm font-medium text-slate-400">
                        <span class="hover:text-primary cursor-pointer transition-colors">Dashboard</span>
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-2 text-xs"></iconify-icon>
                        <span class="text-primary">Overview</span>
                    </nav>
                </div>

                <div class="flex items-center gap-4 md:gap-6">
                    <!-- Search -->
                    <div class="hidden md:flex focus-within:border-primary/20 focus-within:bg-white focus-within:shadow-sm transition-all duration-300 bg-slate-100/50 w-64 border-transparent border rounded-full pt-2 pr-4 pb-2 pl-4 items-center">
                        <iconify-icon icon="solar:magnifer-linear" class="text-slate-400 mr-2" width="18"></iconify-icon>
                        <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none text-sm text-slate-600 w-full placeholder-slate-400">
                    </div>

                    <!-- Icons -->
                    <button class="relative text-slate-400 hover:text-primary transition-colors p-1.5 rounded-full hover:bg-secondary">
                        <iconify-icon icon="solar:bell-linear" width="22" stroke-width="1.5"></iconify-icon>
                        <span class="absolute top-1.5 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="flex items-center gap-3 pl-4 border-l border-slate-200 cursor-pointer group">
                        <div class="text-right hidden md:block">
                            <p id="user-email" class="text-sm font-semibold text-dark group-hover:text-primary transition-colors"></p>
                            <p class="text-xs text-slate-400">Administrator</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary to-indigo-400 p-[2px]">
                            <img id="user-photo" alt="Profile" class="w-full h-full object-cover border-white border-2 rounded-full">
                        </div>
                    </div>
                </div>
            </header>

            <div id="content-navigations">
                <?php include("dashboard.php") ?>
            </div>

        </main>
    </div>
</div>
<?php include("footer.php"); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const token = sessionStorage.getItem("googleToken");
    const user = document.getElementById("user-email").textContent = sessionStorage.getItem("userName");
    const userNameDisplay = document.getElementById("username-display").textContent = sessionStorage.getItem("userName");

    const userPhoto = sessionStorage.getItem("userPhoto");

    // Display the profile picture
    if (userPhoto) {
        document.getElementById("user-photo").src = userPhoto;
    }
</script>