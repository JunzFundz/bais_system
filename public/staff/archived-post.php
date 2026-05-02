<?php
session_start();
require_once __DIR__ . '/../../model/Staff.php';
require_once 'add-activity.php';
$brgyID = $_SESSION['BRGY_ID'];
$admin = new Staff();

$act = $admin->activitiesArchived($brgyID);
function e($act)
{
    return htmlspecialchars($act, ENT_QUOTES, 'UTF-8');
}
?>

<script>
    document.querySelectorAll('.status-toggle').forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const postId = this.dataset.postId;
            const isActive = this.checked;
            const status = isActive ? 1 : 2;

            toggle.closest('label').classList.add('transition-all', 'duration-300');

            fetch('../../data/staff-post-status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `post_id=${postId}&status=${status}`
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        this.checked = !isActive;
                        showToast('Error updating status', 'error');
                    } else {
                        showToast(`Post ${isActive ? 'activated' : 'deactivated'}`, 'success');
                        archivedPosts()
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.checked = !isActive;
                    showToast('Network error', 'error');
                });
        });
    });
</script>

<div class="container mx-auto">
    <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2 xl:grid-cols-2">
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

                <div class="pb-8 pl-8 pr-8 pt-4 space-y-4 border-2 <?= $row['STATUS'] === 1 ? 'border-blue-400' : 'border-red-400 bg-amber-50/80' ?> dark:border-blue-300 rounded-xl hover:shadow-lg transition-all duration-300 dark:bg-gray-800 bg-white">
                    <label class="inline-flex items-center cursor-pointer float-right">
                        <div data-popover id="popover-<?= $row['ID'] ?>" role="tooltip" class="absolute z-10 invisible opacity-0 w-fit text-sm bg-white border rounded-lg shadow border-red-500/60">
                            <div class="px-3 py-2 border-b">
                                <h3 class="font-semibold">Delete permanently?</h3>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                        
                        <a class="delete-post text-[1.2rem]" data-popover-target="popover-<?= $row['ID'] ?>" data-post="<?= $row['ID'] ?>" href="javascript: void(0)">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </label>
                    <br>
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
                                        'pdf' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 3a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h9a3 3 0 0 0 3-3v-9l-7-7zm0 1h4v4a3 3 0 0 0 3 3h4v8a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2m5 .41L17.59 10H14a2 2 0 0 1-2-2zM7.5 10v5h1v-5zm0 7v2h1v-2z"/></svg>',
                                        'docx' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M14 11a3 3 0 0 1-3-3V4H7a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-8zm-2-3a2 2 0 0 0 2 2h3.59L12 4.41zM7 3h5l7 7v9a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3m2 16v-2H7v-1h2v-2h1v2h2v1h-2v2z"/></svg>',
                                        'doc' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 3a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h9a3 3 0 0 0 3-3v-9l-7-7zm0 1h4v4a3 3 0 0 0 3 3h4v8a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2m5 .41L17.59 10H14a2 2 0 0 1-2-2zM7.5 10v5h1v-5zm0 7v2h1v-2z"/></svg>',
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

                    <!-- <div class="flex gap-2 pt-2">
                            <a href="#" class="flex-1 inline-flex items-center justify-center p-3 text-blue-500 capitalize transition-all duration-300 bg-blue-100 hover:bg-blue-200 rounded-lg dark:bg-blue-500 dark:text-white dark:hover:bg-blue-600 shadow-sm hover:shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                View Details
                            </a>
                        </div> -->

                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-20">
                <iconify-icon icon="mdi:inbox-outline" class="w-24 h-24 text-gray-300 mx-auto mb-4"></iconify-icon>
                <h3 class="text-xl font-semibold text-gray-500 dark:text-gray-400 mb-2">No activities yet</h3>
                <p class="text-gray-400 dark:text-gray-500 mb-6">Get started by creating your first activity.</p>
                <button data-modal-target="activity-modal" data-modal-toggle="activity-modal"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-brand-900 text-white rounded-lg hover:bg-brand-800 transition-colors shadow-lg">
                    <iconify-icon icon="solar:plus-circle-linear"></iconify-icon>
                    Add Activity
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function openGallery(images) {
        if (!images || images.length === 0) return;

        const modal = `
        <div id="imageGalleryModal" class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4">
            <button onclick="closeGallery()" class="absolute top-6 right-6 text-white text-3xl hover:text-gray-300">&times;</button>
            <div class="relative max-w-4xl max-h-screen overflow-auto">
                <div id="galleryImages" class="flex gap-4"></div>
                <button onclick="prevImage()" class="fixed left-16 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="nextImage()" class="fixed right-16 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    `;

        document.body.insertAdjacentHTML('beforeend', modal);
        renderGallery(images);
    }

    let currentImageIndex = 0;
    let galleryImages = [];

    function renderGallery(images) {
        galleryImages = images;
        const container = document.getElementById('galleryImages');
        container.innerHTML = images.map(img =>
            `<img src="../../uploads/activities/${img}" class="max-h-screen max-w-full object-contain mx-auto rounded-lg shadow-2xl">`
        ).join('');
        showImage(0);
    }

    function showImage(index) {
        currentImageIndex = index;
        const images = document.querySelectorAll('#galleryImages img');
        images.forEach((img, i) => {
            img.style.display = i === index ? 'block' : 'none';
        });
    }

    function nextImage() {
        showImage((currentImageIndex + 1) % galleryImages.length);
    }

    function prevImage() {
        showImage((currentImageIndex - 1 + galleryImages.length) % galleryImages.length);
    }

    function closeGallery() {
        const modal = document.getElementById('imageGalleryModal');
        if (modal) modal.remove();
    }
</script>