<?php
include 'header.php';
?>

<section class=" bg-amber-50/70 grid place-items-center sm:h-dvh h-[80dvh]" id="--bg">
    <div class="container px-6 py-16 mx-auto text-center">
        <div class="max-w-lg mx-auto">
            <h1 class="text-3xl font-semibold text-white dark:text-white lg:text-4xl">Bais City Information Hub: An Integrated Local Services</h1>
            <p class="mt-6 text-white">Make documents request easy and fast</p>
            <br>

            <div x-data="{ modalOpen: false }">
                <button
                    @click="modalOpen = true"
                    class="px-6 py-2 mx-auto tracking-wide text-white bg-blue-600 rounded-xl hover:bg-blue-500">
                    Get started
                </button>
                <?php include 'login.php'; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'posts.php'; ?>
<?php include 'footer.php' ?>