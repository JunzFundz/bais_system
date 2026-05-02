<?php
require_once __DIR__ . "/../../model/Client.php";

$client = new Client();
$certificates = $client->cert();
$act = $client->activities();
function e($act)
{
    return htmlspecialchars($act, ENT_QUOTES, 'UTF-8');
}

?>

<div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-1 xl:grid-cols-1">
    <?php if (!empty($act)): ?>
        <?php foreach ($act as $row): ?>

            <?php
            $allFiles = json_decode($row['FILES'], true) ?? [];
            $imageFiles = [];
            $docFiles = [];

            foreach ($allFiles as $file) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $imageFiles[] = $file;
                } else {
                    $docFiles[] = $file;
                }
            }

            $imageTotal = count($imageFiles);
            $displayImages = array_slice($imageFiles, 0, 4);
            ?>

            <div class="p-8 dark:bg-gray-800 bg-white space-y-4 border-2 border-blue-400 dark:border-blue-300 rounded-xl hover:shadow-lg transition-all duration-300">

                <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white leading-tight">
                    <?= e($row['TITLE']) ?>
                </h1>

                <p class="text-gray-500 dark:text-gray-300 leading-relaxed">
                    <?= nl2br(e($row['DESCRIPTION'])) ?>
                </p>

                <?php if (!empty($imageFiles)): ?>
                    <div class="grid grid-cols-2 gap-2 mt-4 cursor-pointer">
                        <?php foreach ($displayImages as $index => $img): ?>
                            <div class="relative group" onclick="openGallery(<?= htmlspecialchars(json_encode($imageFiles)) ?>)">
                                <img src="../../uploads/activities/<?= e(basename($img)) ?>"
                                    class="w-full h-40 object-cover rounded-lg group-hover:opacity-90 transition-all duration-200"
                                    alt="Activity image <?= $index + 1 ?>"
                                    loading="lazy">

                                <?php if ($index === 3 && $imageTotal > 4): ?>
                                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center rounded-lg opacity-0 opacity-100 transition-opacity">
                                        <span class="text-white text-xl font-bold">
                                            +<?= $imageTotal - 4 ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($docFiles)): ?>
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                            📎 Attachments (<?= count($docFiles) ?>)
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($docFiles as $doc): ?>
                                <?php
                                $ext = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
                                $icon = match ($ext) {
                                    'pdf' => '📄',
                                    'docx' => '📝',
                                    'doc' => '📄',
                                    default => '📎'
                                };
                                $fileName = basename($doc);
                                ?>
                                <a href="../../uploads/activities/<?= e($doc) ?>"
                                    download="<?= e($fileName) ?>"
                                    class="inline-flex items-center gap-1.5 px-3 py-2 text-xs bg-gradient-to-r from-gray-100 to-gray-200 hover:from-blue-50 hover:to-blue-100 dark:from-gray-800 dark:to-gray-700 dark:hover:from-blue-900/20 dark:hover:to-blue-800/20 text-gray-800 dark:text-gray-200 rounded-full transition-all duration-200 hover:scale-105 shadow-sm hover:shadow-md border border-gray-200 dark:border-gray-600">
                                    <?= $icon ?>
                                    <span class="truncate max-w-24"><?= e(substr($fileName, 0, 20)) ?><?= strlen($fileName) > 20 ? '...' : '' ?></span>
                                    <svg class="w-3 h-3 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10l-5.5 5.5m0 0L8 18l5.5-5.5M8 18l4.5-4.5M12 10l5.5 5.5" />
                                    </svg>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full text-center py-20">
            <iconify-icon icon="mdi:inbox-outline" class="w-24 h-24 text-gray-300 mx-auto mb-4"></iconify-icon>
            <h3 class="text-xl font-semibold text-gray-500 dark:text-gray-400 mb-2">No activities yet</h3>
            <p class="text-gray-400 dark:text-gray-500 mb-6">Get started by creating your first activity.</p>
        </div>
    <?php endif; ?>
</div>