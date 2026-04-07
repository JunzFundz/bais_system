<?php
require_once __DIR__ . '/../../model/Staff.php';
$admin = new Staff();

session_start();

$brgyID = $_SESSION['BRGY_ID'];

$viewbrgy = $admin->getAllBrgy($brgyID);
$viewofficials = $admin->getOfficialsBrgy($brgyID);
include 'modal-add-officials.php';
include 'modal-update-official.php';
?>

<?php if (!empty($viewbrgy)) {
    foreach ($viewbrgy as $row):
?>
        <div class="setting-item">
            <div class="container px-6 py-8 mx-auto bg-white border border-gray-300 rounded-xl dark:bg-gray-900">
                <h1 class="mt-4 text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white">Barangay of: <?= htmlspecialchars($row['BARANGAY']) ?></h1>

                <div class="mt-6 space-y-8 xl:mt-12">
                    <div class="flex items-center justify-between max-w-2xl px-8 py-4 mx-auto border cursor-pointer rounded-xl dark:border-gray-700">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 sm:h-9 sm:w-9" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>

                            <div class="flex flex-col items-center mx-5 space-y-1">
                                <h2 class="text-lg font-medium text-gray-700 sm:text-2xl dark:text-gray-200"><?= $row['total_officials'] ?></h2>

                                <div class="px-2 text-xs text-blue-500 bg-gray-100 rounded-full sm:px-4 sm:py-1 dark:bg-gray-700 ">
                                    Total Officials
                                </div>
                            </div>
                        </div>

                        <h2 class="text-2xl font-semibold text-gray-500 sm:text-3xl dark:text-gray-300"><?= htmlspecialchars($row['total_persons']) ?><span class="text-base font-medium">/Registered</span></h2>
                    </div>
                    <div class="flex justify-center">
                        <button data-modal-target="add-official-modal" data-modal-toggle="add-official-modal" class="flex h-9 items-center gap-2 rounded-lg bg-brand-900 px-4 text-sm font-medium text-white shadow-lg shadow-brand-900/20 hover:bg-brand-800 transition-colors">
                            Add Officials
                        </button>
                    </div>
                </div>
            </div>
        </div>
<?php
    endforeach;
} ?>


<section class="">
    <div class="container px-6 py-8 mx-auto">
        <h2 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white"></h2>
        <div class="grid gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">

            <?php
            if (!empty($viewofficials)) {
                foreach ($viewofficials as $row) {
                    if ($row['DATE_ENDED'] == NULL && $row['POSITION'] != 1) {
            ?>
                        <div class="w-full max-w-xs bg-white dark:bg-gray-900 p-3 border border-gray-300 rounded-xl">
                            <img class="object-cover object-center w-full h-48 mx-auto rounded-lg" src="../../profiles/<?= htmlspecialchars(strtoupper($row['PHOTO'])) ?>" alt="avatar" />
                            <div class="mt-2">
                                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-200"><?= htmlspecialchars($row['L_NAME'] . " " . $row['F_NAME'] . " " . $row['M_NAME']) ?></h3>
                                <span class="mt-1 font-medium text-gray-600 dark:text-gray-300"><?= htmlspecialchars(strtoupper($row['POSITION_NAME'])) ?></span>
                            </div>
                            <center>
                                <div class="inline-flex rounded-md shadow-xs">
                                    <a href="#" data-id="<?= htmlspecialchars($row['OFFICIAL_ID']) ?>" id="" aria-current="page" class="update-official px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                        Update
                                    </a>
                                    <a href="#" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                        Mail
                                    </a>
                                </div>
                            </center>
                        </div>
            <?php
                    }
                }
            }
            ?>

        </div>
    </div>
</section>