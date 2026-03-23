<div class="w-full p-5 sm:p-5 md:p-10 dark:bg-gray-900">
    <?php foreach ($posts as $post): ?>
        <article class="mb-10 rounded-xl dark:text-white dark:bg-gray-800 overflow-hidden bg-white shadow-lg hover:shadow-2xl transition-all duration-300 flex flex-col mx-auto border border-gray-400 dark:border-gray-600">

            <!-- Post Title -->
            <div class="p-6">
                <a href="?post=<?php echo $post['id']; ?>"
                    class="text-2xl sm:text-2xl md:text-3xl font-bold inline-block hover:text-indigo-600 transition-all duration-500 ease-in-out mb-4 line-clamp-2 leading-tight">
                    <?php echo htmlspecialchars($post['title']); ?>
                </a>
            </div>

            <!-- Featured Image + Gallery Overlay -->
            <div class="relative group">
                <?php
                $postImages = !empty($post['FILES']) ? array_filter($post['FILES'], function ($file) {
                    $ext = strtolower(pathinfo(basename($file), PATHINFO_EXTENSION));
                    return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                }) : [];
                $firstImage = !empty($postImages) ? $postImages[0] : '';
                ?>

                <?php if ($firstImage): ?>
                    <a href="/bais-documents/uploads/<?php echo htmlspecialchars(basename($firstImage)); ?>"
                        class="block w-full h-64 sm:h-80 md:h-96 overflow-hidden relative">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            src="/bais-documents/uploads/<?php echo htmlspecialchars(basename($firstImage)); ?>"
                            alt="<?php echo htmlspecialchars($post['title']); ?>"
                            loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80'">

                        <!-- Multiple Images Badge -->
                        <?php if (count($postImages) > 1): ?>
                            <div class="absolute top-4 right-4 bg-black/70 text-white px-2 py-1 rounded-full text-xs font-medium">
                                +<?php echo count($postImages) - 1; ?> photos
                            </div>
                        <?php endif; ?>
                    </a>
                <?php else: ?>
                    <!-- No image fallback -->
                    <div class="w-full h-64 sm:h-80 md:h-96 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <div class="text-center p-8">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm font-medium">No image</p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Category & Action Buttons -->
                <div class="absolute bottom-4 left-4 right-4 flex flex-wrap gap-2">
                    <a href="#!" class="bg-indigo-600/90 backdrop-blur-sm text-white px-4 py-2 rounded-full text-xs font-semibold hover:bg-indigo-700 transition-all duration-300 flex items-center shadow-lg">
                        <span class="w-2 h-2 bg-white rounded-full mr-2"></span>
                        <?php echo htmlspecialchars($post['category'] ?? 'General'); ?>
                    </a>

                    <a href="?post=<?php echo $post['id']; ?>"
                        class="bg-white/90 backdrop-blur-sm text-indigo-600 px-4 py-2 rounded-full text-xs font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 flex items-center ml-auto">
                        Read more →
                    </a>
                </div>
            </div>

            <!-- Post Content -->
            <div class="p-6 flex-1">
                <p class="text-gray-700 text-base leading-relaxed line-clamp-3 mb-6">
                    <?php echo htmlspecialchars($post['description']); ?>
                </p>

                <!-- Images Gallery (if multiple images) -->
                <?php if (count($postImages) > 1): ?>
                    <div class="mb-6">
                        <h5 class="font-semibold text-gray-800 text-sm uppercase tracking-wide mb-3">Gallery</h5>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                            <?php foreach (array_slice($postImages, 1) as $index => $image): ?>
                                <a href="/bais-documents/uploads/<?php echo htmlspecialchars(basename($image)); ?>"
                                    class="group relative block overflow-hidden rounded-lg aspect-square shadow-md hover:shadow-xl transition-all duration-300">
                                    <img src="/bais-documents/uploads/<?php echo htmlspecialchars(basename($image)); ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        alt="Gallery image <?php echo $index + 1; ?>"
                                        loading="lazy">
                                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="text-white text-xs font-bold px-3 py-1 bg-black/50 rounded-full">View</span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- All Files (Images + Documents) -->
                <?php
                $allFiles = !empty($post['FILES']) ? $post['FILES'] : [];
                $nonImages = array_filter($allFiles, function ($file) {
                    $ext = strtolower(pathinfo(basename($file), PATHINFO_EXTENSION));
                    return !in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                });
                ?>

                <?php if (!empty($nonImages)): ?>
                    <div class="border-t pt-4">
                        <h5 class="font-semibold text-gray-800 text-sm uppercase tracking-wide mb-3">Documents</h5>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <?php foreach ($nonImages as $file):
                                $filename = basename($file);
                                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                            ?>
                                <a href="/bais-documents/uploads/<?php echo htmlspecialchars($filename); ?>"
                                    target="_blank"
                                    class="group flex items-center p-3 border border-gray-200 rounded-lg hover:border-indigo-300 hover:bg-indigo-50 transition-all duration-300">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <?php
                                        $icon = match ($ext) {
                                            'pdf' => '📄',
                                            'doc', 'docx' => '📝',
                                            'xls', 'xlsx' => '📊',
                                            'zip', 'rar' => '📦',
                                            default => '📎'
                                        };
                                        echo $icon;
                                        ?>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate group-hover:text-indigo-600">
                                            <?php echo htmlspecialchars($filename); ?>
                                        </p>
                                        <p class="text-xs text-gray-500">Download</p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Post Meta -->
            <div class="px-6 pb-6 pt-2 text-sm text-gray-500 flex flex-wrap items-center justify-between border-t">
                <div class="flex flex-wrap items-center gap-4">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        <span><?php echo date('M j, Y', strtotime($post['created_at'] ?? 'now')); ?></span>
                    </span>
                    <a href="#" class="flex items-center hover:text-indigo-600">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                        </svg>
                        <?php echo $post['author'] ?? 'Admin'; ?>
                    </a>
                </div>

                <div class="flex items-center gap-2 mt-2 sm:mt-0">
                    <span class="text-indigo-600 font-semibold"><?php echo count($postImages); ?> photos</span>
                    <span class="w-px h-4 bg-gray-300"></span>
                    <span class="text-indigo-600 font-semibold"><?php echo count($nonImages); ?> docs</span>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</div>