<?php
require_once __DIR__ . '/../../model/AdminModel.php';

$req = new AdminModel();
$allbrgy = $req->getAllBrgy();
?>

<dialog id="my_modal_4" class="modal">
    <div class="modal-box bg-white w-11/12 max-w-5xl">
        <h3 class="text-lg font-bold">Hello!</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <input id="brgy" type="text" placeholder="Barangay" class="input bg-white" />
            <select id="selected-official" class="bg-white select">
                <option disabled selected>Pick a color</option>
                <option>Okiot</option>
                <option>Amber</option>
                <option>Velvet</option>
            </select>
        </div>

        <div class="modal-action">
            <button onclick="addBrgy()" class="flex float-right items-center gap-2 px-5 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                <span>Add</span>
            </button>
            <form method="dialog" class="">
                <!-- if there is a button, it will close the modal -->
                <button class="flex float-right items-center gap-2 px-5 py-2 rounded-lg bg-red-600 text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                    <span>Cancel</span>
                </button>
            </form>
        </div>
    </div>
</dialog>

<div class="md:p-10 w-full max-w-7xl mr-auto ml-auto pt-6 pr-6 pb-6 pl-6 space-y-8">
    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-end gap-4 gap-x-4 gap-y-4 justify-between">
        <div class="">
            <h1 id="username-display" class="md:text-4xl text-dark text-3xl font-semibold tracking-tight font-poppins mb-2">Barangay</h1>
            <p class="text-slate-500 font-poppins">Baranggay</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="my_modal_4.showModal()" class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                <iconify-icon icon="solar:add-circle-linear" width="18"></iconify-icon>
                <span>Add Barangay</span>
            </button>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <?php if (!empty($allbrgy)) {
            foreach ($allbrgy as $row): ?>

                <a href="">
                    <div class="hover:shadow-[0_8px_30px_-4px_rgba(88,2,247,0.08)] transition-all duration-300 group bg-white border-slate-50 border rounded-2xl pt-6 pr-6 pb-6 pl-6 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)]">
                        <div class="flex justify-between items-start mb-4">
                            <span class="flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                                Registered: 90 <iconify-icon icon="solar:arrow-right-up-linear" class="ml-1"></iconify-icon>
                            </span>
                        </div>
                        <h3 class="text-slate-400 text-sm font-medium mb-1">Total Officials</h3>
                        <p class="text-dark text-2xl font-bold font-poppins">84,254.00</p>
                    </div>
                </a>

        <?php
            endforeach;
        } ?>

    </div>

</div>