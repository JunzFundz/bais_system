<div id="my-modal"
    x-transition:enter="transition duration-300 ease-out"
    x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
    x-transition:leave="transition duration-150 ease-in"
    x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
    x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
    class="hidden fixed inset-0 z-10 overflow-y-auto transition duration-300 ease-out bg-gray-600/70"
    aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="relative inline-block p-4 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl sm:max-w-sm rounded-xl dark:bg-gray-900 sm:my-8 sm:w-full sm:p-6">
            <!-- <div class="flex items-center justify-center mx-auto">
                <img class="h-full rounded-lg" src="https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExdmZ6MzR6YWhkeW9jb2ppang0YTI2ZzJoMjB1bDl2cnZ5aTJsMjFxYyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/jqfTCfgM24BxqQROMO/giphy.gif" alt="" />
            </div> -->

            <div class="mt-5 text-center">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white" id="modal-title">
                    Confirm Request?
                </h3>
            </div>


            <div class="mt-4 sm:flex sm:items-center sm:justify-between sm:mt-6 sm:-mx-2">
                <button onclick="document.getElementById('my-modal').classList.add('hidden')" class="px-4 sm:mx-2 w-full py-2.5 text-sm font-medium dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                    Cancel
                </button>

                <button id="confirm-request" class=" px-4 sm:mx-2 w-full py-2.5 mt-3 sm:mt-0 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>