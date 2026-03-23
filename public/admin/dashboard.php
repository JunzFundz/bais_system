<div class="md:p-10 w-full max-w-7xl mr-auto ml-auto pt-6 pr-6 pb-6 pl-6 space-y-8">

    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-end gap-4 gap-x-4 gap-y-4 justify-between">
        <div class="">
            <h1 id="username-display" class="md:text-4xl text-dark text-3xl font-semibold tracking-tight font-poppins mb-2"></h1>
            <p class="text-slate-500 font-poppins"></p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-4 py-2.5 rounded-lg border border-slate-200 text-sm font-medium text-slate-600 hover:bg-white hover:shadow-sm hover:border-blue/30 hover:text-blue transition-all">
                <iconify-icon icon="solar:calendar-date-linear" width="18" class="" height="18" style="color: rgb(88, 2, 247);"></iconify-icon>
                <span class="">Last 30 Days</span>
            </button>
            <button data-modal-target="adtivity-modal" data-modal-toggle="adtivity-modal" class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 text-white text-sm font-medium shadow-lg shadow-blue/30 hover:shadow-blue/50 hover:-translate-y-0.5 transition-all">
                <iconify-icon icon="solar:add-circle-linear" width="18"></iconify-icon>
                <span>Add activities</span>
            </button>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <div class="hover:shadow-[0_8px_30px_-4px_rgba(88,2,247,0.08)] transition-all duration-300 group bg-white border-slate-50 border rounded-2xl pt-6 pr-6 pb-6 pl-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)]">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-pastelPurple text-blue flex items-center justify-center group-hover:scale-110 transition-transform">
                    <iconify-icon icon="solar:dollar-minimalistic-linear" width="24" stroke-width="1.5"></iconify-icon>
                </div>
                <span class="flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                    +12.5% <iconify-icon icon="solar:arrow-right-up-linear" class="ml-1"></iconify-icon>
                </span>
            </div>
            <h3 class="text-slate-400 text-sm font-medium mb-1">Total Revenue</h3>
            <p class="text-dark text-2xl font-bold font-poppins">$84,254.00</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_30px_-4px_rgba(88,2,247,0.08)] transition-all duration-300 border border-slate-50 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <iconify-icon icon="solar:bag-3-linear" width="24" stroke-width="1.5" class=""></iconify-icon>
                </div>
                <span class="flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                    +5.2% <iconify-icon icon="solar:arrow-right-up-linear" class="ml-1"></iconify-icon>
                </span>
            </div>
            <h3 class="text-slate-400 text-sm font-medium mb-1">Total Orders</h3>
            <p class="text-dark text-2xl font-bold font-poppins">1,254</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_30px_-4px_rgba(88,2,247,0.08)] transition-all duration-300 border border-slate-50 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <iconify-icon icon="solar:users-group-two-rounded-linear" width="24" stroke-width="1.5" class=""></iconify-icon>
                </div>
                <span class="flex items-center text-xs font-semibold text-rose-600 bg-rose-50 px-2 py-1 rounded-full">
                    -2.1% <iconify-icon icon="solar:arrow-right-down-linear" class="ml-1"></iconify-icon>
                </span>
            </div>
            <h3 class="text-slate-400 text-sm font-medium mb-1">New Customers</h3>
            <p class="text-dark text-2xl font-bold font-poppins">856</p>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_30px_-4px_rgba(88,2,247,0.08)] transition-all duration-300 border border-slate-50 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <iconify-icon icon="solar:pie-chart-2-linear" width="24" stroke-width="1.5" class=""></iconify-icon>
                </div>
                <span class="flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                    +8.4% <iconify-icon icon="solar:arrow-right-up-linear" class="ml-1"></iconify-icon>
                </span>
            </div>
            <h3 class="text-sm font-medium text-slate-400 mb-1">Conversion Rate</h3>
            <p class="text-dark text-2xl font-bold font-poppins">3.42%</p>
        </div>
    </div>

</div>