<?php

require_once __DIR__ . '/../../model/Staff.php';
$admin = new Staff();
$req = $admin->getAllReq();
$brgy = $admin->getBrgy();
$users = $admin->getAllUsers();

$year = date('Y');
$data = $admin->getUsersPerMonth($year);

$months = array_fill(1, 12, 0);

foreach ($data as $row) {
    $months[(int)$row['month']] = (int)$row['total'];
}

$chartData = array_values($months);

$range = $admin->getYearRange();

$startYear = $range['min_year'] ?? date('Y');
$endYear = $range['max_year'] ?? date('Y');
$currentYear = date('Y');
?>

<!-- Stats Grid -->
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Card 1 -->
    <div class="group relative overflow-hidden rounded-xl border border-slate-200 bg-white p-5 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all hover:-translate-y-1 hover:shadow-lg dark:border-dark-border dark:bg-dark-card dark:shadow-none">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">TOTAL BARANGAY</p>
                <h3 class="mt-2 text-2xl font-semibold tracking-tight text-slate-900 dark:text-white"><?= htmlspecialchars($brgy) ?></h3>
            </div>
            <div class="dark:bg-brand-900/20 dark:text-brand-300 text-brand-900 bg-brand-50 rounded-lg pt-2 pr-2 pb-1 pl-2">
                <iconify-icon icon="solar:users-group-two-rounded-linear" width="20" class=""></iconify-icon>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="group relative overflow-hidden rounded-xl border border-slate-200 bg-white p-5 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all hover:-translate-y-1 hover:shadow-lg dark:border-dark-border dark:bg-dark-card dark:shadow-none">
        <div class="flex items-start justify-between">
            <div class="">
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">ACTIVE USERS</p>
                <h3 class="mt-2 text-2xl font-semibold tracking-tight text-slate-900 dark:text-white"><?= htmlspecialchars($users) ?></h3>
            </div>
            <div class="dark:bg-purple-900/20 dark:text-purple-300 text-purple-600 bg-purple-50 rounded-lg pt-2 pr-2 pb-0 pl-2">
                <iconify-icon icon="solar:users-group-two-rounded-linear" width="20" class=""></iconify-icon>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="group overflow-hidden transition-all hover:-translate-y-1 hover:shadow-lg dark:border-dark-border dark:bg-dark-card dark:shadow-none bg-white border-slate-200 border rounded-xl pt-5 pr-5 pb-5 pl-5 relative shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)]">
        <div class="flex items-start justify-between">
            <div class="">
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">REQUESTS</p>
                <h3 class="mt-2 text-2xl font-semibold tracking-tight text-slate-900 dark:text-white"><?= htmlspecialchars($req) ?></h3>
            </div>
            <div class="dark:bg-orange-900/20 dark:text-orange-300 text-orange-600 bg-orange-50 rounded-lg pt-2 pr-2 pb-0 pl-2">
                <iconify-icon icon="solar:graph-down-linear" width="20" class=""></iconify-icon>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
    <!-- Main Chart -->
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-dark-border dark:bg-dark-card lg:col-span-2">
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Total population registered</h3>
            <select id="yearFilter" class="rounded-lg border px-2 py-1 text-xs">
                <?php for ($year = $endYear; $year >= $startYear; $year--) { ?>
                    <option value="<?= $year ?>" <?= $year == $currentYear ? 'selected' : '' ?>>
                        <?= $year ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="relative h-64 w-full">
            <canvas id="revenueChart" style="display: block; box-sizing: border-box; height: 256px; width: 745.6px;" width="932" height="320" class=""></canvas>
        </div>
    </div>

    <!-- Side Chart -->
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-dark-border dark:bg-dark-card">
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Active Barangay</h3>
            <button class="text-slate-400 hover:text-brand-900 dark:hover:text-white">
                <iconify-icon icon="solar:menu-dots-linear"></iconify-icon>
            </button>
        </div>
        <div class="relative h-48 w-full flex items-center justify-center chart-container">
            <canvas id="trafficChart" style="display: block; box-sizing: border-box; height: 192px; width: 336px;" width="420" height="240" class=""></canvas>
        </div>
        <div id="barangayLegend" class="mt-6 space-y-3">

        </div>
    </div>
</div>

<div class="mt-8 text-center">
    <p class="text-xs text-slate-400">© 2023 Bais City Inc. All rights reserved.</p>
</div>