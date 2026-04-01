<style>
    #--box {
        -webkit-box-shadow: -2.5px 0 14px 3px #dddddd;
        -moz-box-shadow: -2.5px 0 14px 3px #dddddd;
        box-shadow: -2.5px 0 14px 3px #dddddd;
    }
</style>


<div class="w-full p-5 sm:p-8 md:p-16 dark:bg-gray-900 bg-gray-200">

    <h1 class="text-5xl font-extrabold text-center lg:text-7xl ">
        <span class="text-transparent bg-gradient-to-br bg-clip-text from-teal-500 via-indigo-500 to-sky-500 dark:from-teal-200 dark:via-indigo-300 dark:to-sky-500">
            Coming
        </span>

        <span class="text-transparent bg-gradient-to-tr bg-clip-text from-blue-500 via-pink-500 to-red-500 dark:from-sky-300 dark:via-pink-300 dark:to-red-500">
            Soon
        </span>
    </h1>

    <br>
    <br>

    <section id="--box" class="bg-white dark:bg-gray-900 border-2 rounded-sm border-gray-200 dark:border-gray-600">
        <div class="container px-6 py-12 mx-auto">
            <div>
                <p class="font-medium text-blue-500 dark:text-blue-400">Tracking</p>

                <h1 class="mt-2 text-2xl font-semibold text-gray-800 md:text-3xl dark:text-white">Track your requests</h1>

                <p class="mt-3 text-gray-500 dark:text-gray-400">Input your control number to see the status of your requests.</p>
            </div>

            <div class="grid grid-cols-1 gap-12 mt-10 lg:grid-cols-2">
                <div class="p-4 py-6 rounded-lg bg-gray-50 dark:bg-gray-800 md:p-8">
                    <form>
                        <div class="mt-4">
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Control number</label>
                            <input type="email" class="block w-full px-5 py-2.5 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                        </div>
                        <button class="w-full px-6 py-3 mt-4 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                            Track
                        </button>
                    </form>
                </div>
                <div class="grid grid-cols-1 gap-12 md:grid-cols-1">
                    <img class="object-cover object-center w-full rounded-xl" src="https://images.unsplash.com/photo-1499470932971-a90681ce8530?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="">

                </div>

            </div>
        </div>
    </section>


    <br>

    <?php foreach ($posts as $post): ?>

        <section class="text-gray-400 dark:bg-gray-900 bg-white dark:text-white body-font overflow-hidden" id="--box">
            <div class="container px-2 py-9 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                    <?php
                    $postImages = !empty($post['FILES']) ? array_filter($post['FILES'], function ($file) {
                        $ext = strtolower(pathinfo(basename($file), PATHINFO_EXTENSION));
                        return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    }) : [];
                    $firstImage = !empty($postImages) ? $postImages[0] : '';
                    ?>

                    <?php if ($firstImage): ?>
                        <a class="lg:w-1/2" href="/bais-documents/uploads/<?php echo htmlspecialchars(basename($firstImage)); ?>">
                            <img alt="ecommerce" class="w-full lg:h-auto h-64 object-cover object-center rounded" src="/bais-documents/uploads/<?php echo htmlspecialchars(basename($firstImage)); ?>">
                        </a>
                    <?php else: ?>

                        <h1>No image</h1>

                    <?php endif; ?>
                    <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                        <h2 class="text-sm title-font text-blue-500 dark:text-blue-400 tracking-widest"><?php echo htmlspecialchars($post['category'] ?? 'General'); ?></h2>
                        <h1 class="dark:text-white text-gray-800 text-3xl title-font font-medium mb-1"><?php echo $post['title']; ?></h1>

                        <p class="leading-relaxed text-gray-500 dark:text-gray-400"><?php echo $post['description']; ?></p>
                        <div class="flex mt-6 items-center  border-gray-800 mb-5">
                        </div>
                        <div class="flex">
                            <span class="title-font font-medium dark:text-gray-500 text-black"><?php echo htmlspecialchars($post['date_created']) ?></span>
                            <a class="flex ml-auto text-white bg-blue-700 border-0 py-2 px-6 focus:outline-none hover:bg-blue-500 rounded">View post</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endforeach; ?>

</div>