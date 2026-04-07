<?php
require_once __DIR__ . '/../../model/AdminModel.php';
$admin = new AdminModel();
$allbrgy = $admin->getAllBrgy();
?>

<!-- Welcome Section -->
<div class="flex flex-col md:flex-row md:items-end gap-4 gap-x-4 gap-y-4 justify-between">
    <div class="">
        <h1 id="username-display" class="md:text-4xl text-dark text-3xl font-semibold tracking-tight font-poppins mb-2">Barangay</h1>
        <p class="text-slate-500 font-poppins">Baranggay</p>
    </div>
</div>
<br>
<!-- Stats Cards Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Card 1 -->
    <?php if (!empty($allbrgy)) {
        foreach ($allbrgy as $row): 
        $_SESSION['BARANGAY'] = $row['BARANGAY'];?>

            <a href="officials?barangay=<?= htmlspecialchars($row['BRGY_ID']) ?>">
                <div class="hover:shadow-[0_8px_30px_-4px_rgba(88,2,247,0.08)] transition-all duration-300 group bg-white border-gray-400 border rounded-2xl pt-6 pr-6 pb-6 pl-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)]">
                    <span class="flex items-center text-xs font-semibold px-2 py-1 rounded-full">
                        Barangay of: <?= htmlspecialchars($_SESSION['BARANGAY']) ?>
                    </span>
                    <div class="flex justify-between items-start mb-4">
                        <span class="flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                            Registered: <?= htmlspecialchars($row['total_persons']) ?> <iconify-icon icon="solar:arrow-right-up-linear" class="ml-1"></iconify-icon>
                        </span>
                    </div>
                    <h3 class="text-slate-400 text-sm font-medium mb-1">Total Officials</h3>
                    <p class="text-dark text-2xl font-bold font-poppins"><?= $row['total_officials'] ?></p>
                </div>
            </a>

    <?php endforeach;
    } ?>

</div>