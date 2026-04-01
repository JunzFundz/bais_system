   <?php
    include __DIR__ . '/header.php';
    if (isset($_GET['barangay'])) {
        $brgy = $_GET['barangay'];

        $viewofficials = $admin->getOfficialsBrgy($brgy);

        include 'modal-add-officials.php'; ?>


       <div class="flex-1 overflow-y-auto lg:p-8 dark:bg-dark-bg bg-slate-50/50 pt-4 pr-4 pb-4 pl-4" id="content-navigations">
           <!-- Welcome Section -->
           <div class="flex flex-col md:flex-row md:items-end gap-4 gap-x-4 gap-y-4 justify-between">
               <div class="">
                   <h1 id="username-display" class="md:text-4xl text-dark text-3xl font-semibold tracking-tight font-poppins mb-2">Officials</h1>
                   <p class="text-slate-500 font-poppins"><?= htmlspecialchars($_SESSION['BARANGAY']) ?></p>
               </div>
               <div class="flex items-center gap-3">
                   <button data-modal-target="add-official-modal" data-modal-toggle="add-official-modal" class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                       <iconify-icon icon="solar:add-circle-linear" width="18"></iconify-icon>
                       <span>Add Officials</span>
                   </button>
               </div>
           </div>

           <section class="bg-white dark:bg-gray-900">
               <div class="container px-6 py-8 mx-auto">
                   <h2 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white"></h2>
                   <div class="grid gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                       <?php foreach ($viewofficials as $row) { ?>
                           <div class="w-full max-w-xs">
                               <img class="object-cover object-center w-full h-48 mx-auto rounded-lg" src="../../profiles/<?= htmlspecialchars(strtoupper($row['PHOTO'])) ?>" alt="avatar" />
                               <div class="mt-2">
                                   <h3 class="text-lg font-medium text-gray-700 dark:text-gray-200"><?= htmlspecialchars($row['L_NAME'] . " " . $row['F_NAME'] . " " . $row['M_NAME']) ?></h3>
                                   <span class="mt-1 font-medium text-gray-600 dark:text-gray-300"><?= htmlspecialchars(strtoupper($row['POSITION_NAME'])) ?></span>
                               </div>
                               <div class="inline-flex rounded-md shadow-xs">
                                   <a href="#" data-id="<?= htmlspecialchars($row['OFFICIAL_ID']) ?>" id="" aria-current="page" class="update-official px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                       Update
                                   </a>
                                   <a href="#" data-modal-target="add-mail-modal" data-modal-toggle="add-mail-modal" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                       Mail
                                   </a>
                                   <a href="#" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                       End
                                   </a>
                               </div>
                           </div>
                       <?php } ?>

                   </div>
               </div>
           </section>
       </div>
   <?php } ?>

   <?php include 'footer.php' ?>