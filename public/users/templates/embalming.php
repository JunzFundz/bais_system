<style>
    .canvas-container {
        position: relative;
        display: inline-block;
    }

    #signature {
        cursor: crosshair;
        background: white;
        border: 2px solid #333;
        border-radius: 4px;
        display: block;
    }

    #clear-signature {
        position: absolute;
        top: 5px;
        right: 5px;
        padding: 5px 10px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }

    #clear-signature:hover {
        background: #dc2626;
    }
</style>

<?php $_SESSION['encryptedCertId'] = $encryptedCertId; ?>
<input type="hidden" name="" id="user-id" value="<?php echo $_SESSION['u_id']; ?>">
<input type="hidden" name="" id="cert-id" value="<?php echo $_SESSION['certId'] ?? '' ?>">
<input type="hidden" name="" id="pi-id" value="<?php echo $_SESSION['PI_ID'] = $users['PI_ID'] ?>">

<div class="min-h-screen flex items-center justify-center bg-gray-200 dark:bg-gray-900">
    <div class="lg:w-lg sm:w-9/12 w-full border-2 bg-white dark:bg-gray-800 dark:text-white dark:border-gray-400 shadow-lg rounded-lg p-8">
        <!-- Step Indicator with Progress Bar -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4 w-full">
                <!-- Step 1 -->
                <div class="relative flex-1 flex items-center">
                    <div id="indicator-1" class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full transition-colors duration-300"><i class="fa-solid fa-user-check"></i></div>
                    <div id="line-1" class="absolute w-full h-1 bg-gray-300 left-0 top-1/2 transform translate-y-[-50%] z-[-1] transition-colors duration-300"></div>
                </div>
                <!-- Step 2 -->
                <div class="relative flex-1 flex items-center">
                    <div id="indicator-2" class="w-10 h-10 flex items-center justify-center bg-gray-300 text-gray-600 rounded-full transition-colors duration-300"><i class="fa-solid fa-location-arrow"></i></div>
                    <div id="line-2" class="absolute w-full h-1 bg-gray-300 left-0 top-1/2 transform translate-y-[-50%] z-[-1] transition-colors duration-300"></div>
                </div>
                <!-- 3 -->

                <div>
                    <div id="indicator-3" class="w-10 h-10 flex items-center justify-center bg-gray-300 text-gray-600 rounded-full transition-colors duration-300"><i class="fa-solid fa-circle-info"></i></div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-200 rounded-full h-2 mb-8">
            <div id="progress-bar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%;"></div>
        </div>

        <div id="error-box" class="hidden text-red-600"></div>
        <!-- Form Content -->
        <form id="multi-step-form">
            <!-- Step 1 -->
            <div id="step-1" class="step">
                <h2 class="text-xl font-semibold mb-6">Step 1: Personal Info</h2>
                <div class="space-y-4">
                    <form>
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3">
                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">First Name<span class="text-red-700 text-center">*</span></label>
                                <input value="<?= $users['FNAME'] ?? '' ?>" id="fname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" placeholder="First name">
                            </div>

                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">Middle Name</label>
                                <input value="<?= $users['MNAME'] ?? '' ?>" placeholder="Middle name" id="mname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>

                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">Last Name<span class="text-red-700 text-center">*</span></label>
                                <input value="<?= $users['LNAME'] ?? '' ?>" placeholder="Last name" id="lname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3">
                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">Citizenship<span class="text-red-700 text-center">*</span></label>
                                <input value="<?= $users['CITIZEN'] ?? '' ?>" placeholder="Citizenship" id="citizen" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>

                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">Sex<span class="text-red-700 text-center">*</span></label>
                                <input value="<?= $users['SEX'] ?? '' ?>" placeholder="Sex" id="sex" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>

                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">Status <span class="text-red-700 text-center">*</span></label>
                                <select id="civilstatus" class=" h-10 block w-full px-4 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    <?php foreach ($status as $statusRow) { ?>
                                        <option value="<?= $statusRow['STATUS_NAME'] ?>"><?= $statusRow['STATUS_NAME'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">Age<span class="text-red-700 text-center">*</span></label>
                                <input value="<?= $users['AGE'] ?? '' ?>" placeholder="Age" id="age" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Step 2 -->
            <div id="step-2" class="step hidden">
                <h2 class="text-xl font-semibold mb-4">Step 2: Contact/Address</h2>
                <div class="space-y-4">
                    <form>
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">Contact No.<span class="text-red-700 text-center">*</span></label>
                                <input value="<?= $users['CONTACT'] ?? '' ?>" placeholder="Contact" id="contact" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" placeholder="+63">
                            </div>
                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">Email Address<span class="text-red-700 text-center">*</span></label>
                                <input disabled value="<?= $_SESSION['u_email'] ?? '' ?>" placeholder="Email" id="email" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3">
                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">Barangay<span class="text-red-700 text-center">*</span></label>
                                <select id="Barangay" class="block w-full h-10 px-4 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    <?php foreach ($brgys as $brgyRow) { ?>
                                        <option value="<?= $brgyRow['BRGY_ID'] ?>"><?= $brgyRow['BARANGAY'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">Street<span class="text-red-700 text-center">*</span></label>
                                <input value="<?= $users['STREET'] ?? '' ?>" placeholder="Street" id="street" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>
                            <div>
                                <label for="visitors" class="block mb-2 text-md font-medium text-heading">City<span class="text-red-700 text-center">*</span></label>
                                <input value="<?= $users['CITY'] ?? '' ?>" placeholder="City" id="city" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Step 3 -->
            <div id="step-3" class="step hidden">
                <h2 class="text-xl font-semibold mb-4">Step 3: Photo</h2>
                <p class="mb-4">Here are some essential media needs for the requests:</p>

                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <label for="visitors" class="block mb-2 text-md font-medium text-heading">Select type<span class="text-red-700 text-center">*</span></label>
                        <select id="select-type" type="text" class="h-10 block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            <option selected value="1">Applicant</option>
                            <option value="2">Representative</option>
                        </select>
                    </div>
                    <div>
                        <label for="visitors" class="block mb-2 text-md font-medium text-heading">Burial Assistance of late:<span class="text-red-700 text-center">*</span></label>
                        <input placeholder="Full name" id="purpose" type="text" class="h-10 block w-full px-4 py-2 mt-2 text-gray-700 bg-gray-100 border border-gray-400 rounded-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" placeholder="+63">
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
                    <div id="change-req" class="hidden">
                        <label for="dropzone-letter" class="h-10 flex items-center px-3 py-1 mx-auto mt-2 text-center bg-white border-2 border-dashed rounded-lg cursor-pointer dark:border-gray-600 dark:bg-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <h2 class="mx-3 text-gray-400">Upload authorization letter</h2>
                            <input id="dropzone-letter" type="file" class="hidden" accept=".jpg,.jpeg,.png,." />
                        </label>
                    </div>

                    <button id="open-camera" class="px-4 py-2 bg-blue-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h2l2-3h10l2 3h2a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V9a2 2 0 012-2z" />
                        </svg>
                        Selfie
                    </button>
                    <!-- Camera Container (hidden by default) -->
                    <center>
                        <div id="camera-container" class="w-full h-80 hidden mt-3 relative">
                            <video id="camera" autoplay playsinline class="w-full h-full object-cover border"></video>
                            <canvas id="canvas" class="hidden w-full h-full border object-cover absolute top-0 left-0"></canvas>
                        </div>
                    </center>

                    <!-- Photo Buttons -->
                    <div class="mt-3 space-x-2 hidden" id="photo-buttons">
                        <button type="button" id="take-btn" class="rounded-2xl px-4 py-2 bg-blue-500 text-white">
                            Take Photo
                        </button>
                        <button type="button" id="retake-btn" class="rounded-2xl px-4 py-2 bg-gray-500 text-white hidden">
                            Take Again
                        </button>
                        <button type="button" id="done-btn" class="rounded-2xl px-4 py-2 bg-green-500 text-white hidden">
                            Done
                        </button>
                    </div>

                    <button id="open-signature" class="px-4 py-2 bg-blue-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h2l2-3h10l2 3h2a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V9a2 2 0 012-2z" />
                        </svg>
                        Signature
                    </button>
                    <!-- Signature Container -->
                    <div id="sigCanva" class="hidden grid place-items-center">
                        <div class="canvas-container">
                            <canvas id="signature" class="bg-white border rounded"></canvas>
                            <button id="clear-signature" class="absolute top-2 right-2 px-2 py-1 bg-red-500 text-white text-sm rounded">Clear</button>
                        </div>

                        <div class="mt-3 space-x-2">
                            <button id="save-signature" class="px-4 py-2 bg-blue-500 text-white rounded">Save Signature</button>
                        </div>
                    </div>


                    <label for="visitors" class="block text-md font-medium text-heading">Files</label>

                    <!-- Authorization Letter Preview Container -->
                    <div id="letter-preview-container" class="mt-3 hidden">
                        <div class="flex items-center space-x-2 bg-white p-3 rounded-lg shadow">
                            <span id="letter-filename" class="text-gray-700 font-medium truncate max-w-xs">
                                letter.png
                            </span>

                            <button type="button" id="preview-letter" class="px-3 py-2 bg-gray-200 text-gray-700 rounded">
                                Preview
                            </button>

                            <button type="button" id="remove-letter" class="px-3 py-2 bg-red-500 text-white rounded">
                                ✕
                            </button>
                        </div>
                    </div>

                    <!-- Letter Preview Modal -->
                    <div id="letter-preview-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>

                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Authorization Letter Preview</h3>

                                    <div class="mt-2">
                                        <img id="letter-preview-image" class="max-w-full rounded-lg border">
                                    </div>
                                </div>

                                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">
                                    <button id="close-preview-letter-btn"
                                        class="px-4 py-2 bg-blue-600 text-white rounded">
                                        Close
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Image Preview Container -->
                    <div id="image-preview-container" class="mt-3 hidden">
                        <div class="flex items-center space-x-2 bg-white p-3 rounded-lg shadow">
                            <span id="image-filename" class="text-gray-700 font-medium truncate max-w-xs">
                                photo.jpg
                            </span>
                            <button type="button" id="preview-btn" class="px-3 py-2 bg-gray-200 text-gray-700 rounded">
                                Preview
                            </button>
                            <button type="button" id="remove-btn" class="px-3 py-2 bg-red-500 text-white rounded-lg">
                                ✕
                            </button>
                        </div>
                    </div>

                    <!-- Image Preview Modal -->
                    <div id="image-preview-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">Image Preview</h3>
                                            <div class="mt-2">
                                                <img id="preview-image" src="" alt="Preview" class="max-w-full h-auto rounded-lg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" id="close-preview-btn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <center>
                        <!-- Signature Preview Container (Shows filename after save) -->
                        <div id="signature-preview-container" class="mt-3 hidden">
                            <div class="flex items-center space-x-2 bg-white p-3 rounded-lg shadow">
                                <span id="signature-filename" class="text-gray-700 font-medium truncate max-w-xs">
                                    signature.png
                                </span>
                                <button type="button" id="preview-signature" class="px-3 py-2 bg-gray-200 text-gray-700 rounded">
                                    Preview
                                </button>
                                <button type="button" id="remove-signature" class="px-3 py-2 bg-red-500 text-white rounded">
                                    ✕
                                </button>
                            </div>
                        </div>

                        <!-- Signature Preview Modal -->
                        <div id="signature-preview-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">Signature Preview</h3>
                                                <div class="mt-2">
                                                    <img id="signature-preview-image" src="" alt="Signature Preview" class="max-w-full h-auto rounded-lg border">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="button" id="close-preview-sig-btn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>


                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between mt-8">
                <button id="prev-btn" type="button" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hidden">Previous</button>
                <button data-getKey="<?php echo $encryptedCertId ?>" id="next-btn" type="button" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Next</button>
            </div>
        </form>
    </div>
</div>