<!-- Main modal -->
<div id="change-password" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Change Password
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="change-password">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <input type="hidden" value="<?= $_SESSION['u_id'] ?>" id="u_id">

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Current password
                        </label>

                        <div class="relative">
                            <input type="password" id="cpass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 pr-10 dark:bg-gray-600 dark:border-gray-500 dark:text-white" placeholder="Current Password" required>

                            <!-- Eye Icon -->
                            <span onclick="togglePassword('cpass', this)"
                                class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">
                                <iconify-icon icon="mdi:eye-off-outline" width="20"></iconify-icon>
                            </span>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                        <div class="relative">
                            <input type="password" id="npass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 pr-10 dark:bg-gray-600 dark:border-gray-500 dark:text-white" placeholder="Current Password" required>

                            <!-- Eye Icon -->
                            <span onclick="togglePassword('npass', this)"
                                class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">
                                <iconify-icon icon="mdi:eye-off-outline" width="20"></iconify-icon>
                            </span>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                        <div class="relative">
                            <input type="password" id="cnpass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 pr-10 dark:bg-gray-600 dark:border-gray-500 dark:text-white" placeholder="Current Password" required>

                            <!-- Eye Icon -->
                            <span onclick="togglePassword('cnpass', this)"
                                class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500">
                                <iconify-icon icon="mdi:eye-off-outline" width="20"></iconify-icon>
                            </span>
                        </div>
                    </div>
                </div>
                <br>
                <button type="button" id="change-password-data" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Change Password
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    function togglePassword(inputId, el) {
        const input = document.getElementById(inputId);
        const icon = el.querySelector('iconify-icon');
        if (input.type === "password") {
            input.type = "text";
            icon.setAttribute("icon", "mdi:eye-outline");
        } else {
            input.type = "password";
            icon.setAttribute("icon", "mdi:eye-off-outline");
        }
    }
</script>