<?php include('header.php');
$status = $admin->getStatus();
?>


<input type="hidden" name="" id="off_id" value="<?= $_SESSION['OFFICIAL_ID'] ?>">

<div class="flex-1 overflow-y-auto lg:p-8 dark:bg-dark-bg bg-slate-50/50 pt-4 pr-4 pb-4 pl-4" id="content-navigations">

    <section class="relative overflow-hidden min-h-screen flex items-center justify-center">
        <!-- Background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-1/2 -right-1/2 bg-blue-400/20 dark:bg-blue-600/20 blur-3xl w-96 h-96 rounded-full"></div>
            <div class="absolute -bottom-1/2 -left-1/2 bg-purple-400/20 dark:bg-purple-600/20 blur-3xl w-96 h-96 rounded-full"></div>
        </div>

        <div class="relative z-10 mx-auto px-4 w-full max-w-2xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 leading-tight sm:text-4xl dark:text-white">Complete Your Profile</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Tell us more about yourself to personalize your experience</p>
            </div>

            <!-- Profile Setup Form Container -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-gray-200/50 dark:border-gray-700/50">

                <!-- Profile Setup Form -->

                <div class="space-y-8">
                    <!-- Avatar Section -->
                    <div class="text-center">
                        <div class="avatar-upload inline-block mb-4 relative">
                            <div class="relative w-32 h-32 mx-auto rounded-full border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center overflow-hidden">

                                <!-- Profile Image -->
                                <img id="profilePreview"
                                    src="../../profiles/<?= $offs['PHOTO'] ?>"
                                    alt="Profile Picture"
                                    class="rounded-full w-48 h-48 mx-auto mb-4 border-4 border-indigo-800 dark:border-blue-900 transition-transform duration-300 hover:scale-105">

                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-black bg-opacity-30 rounded-full flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-200 cursor-pointer">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>

                                <!-- Hidden File Input -->
                                <input type="file" id="avatarInput" accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer rounded-full">
                                <input type="hidden" id="old_pp" value="<?= $offs['PHOTO'] ?>">
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Click on the avatar to upload a profile picture</p>
                    </div>


                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-4">
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Employee Number</label>
                            <input disbaled value="<?= $offs['EMP_ID'] ?>" type="text"
                                class="w-full px-4 py-3 rounded-lg bg-white text-gray-900 italic font-extrabold dark:text-white focus:outline-none transition-all duration-200"
                                placeholder="">
                            <div class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Personal Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">First Name</label>
                                <input value="<?= $offs['F_NAME'] ?>" type="text" id="fname"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none transition-all duration-200"
                                    placeholder="">
                                <div class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Middle Name</label>
                                <input value="<?= $offs['M_NAME'] ?>" type="text" id="mname"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none transition-all duration-200"
                                    placeholder="Doe">
                                <div class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last Name</label>
                                <input value="<?= $offs['L_NAME'] ?>" type="text" id="lname"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none transition-all duration-200"
                                    placeholder="Doe">
                                <div class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date of Birth</label>
                                <input value="<?= $offs['DOB'] ?>" type="date" id="dob"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none transition-all duration-200"
                                    placeholder="">
                                <div class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Place of Birth</label>
                                <input value="<?= $offs['POB'] ?>" type="text" id="pob"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none transition-all duration-200"
                                    placeholder="">
                                <div class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Civil Status</label>
                                <select name="floating_last_name" id="cs" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none transition-all duration-200" placeholder="">
                                    <?php if (!empty($status)) { ?>
                                        <?php foreach ($status as $statuses): ?>
                                            <option value="<?= $statuses['STATUS_ID']; ?>"
                                                <?= ($statuses['STATUS_ID'] == $offs['CIVIL_STATUS']) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($statuses['STATUS_NAME']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </select>
                                <div class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                <input value="<?= $offs['EMAIL'] ?>" type="text" id="uemail"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none transition-all duration-200"
                                    placeholder="">
                                <div class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contact Number</label>
                                <input value="<?= $offs['CONTACT'] ?>" type="text" id="contact"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none transition-all duration-200"
                                    placeholder="Doe">
                                <div class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Signature</h3>
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                            <div>
                                <button id="open-signature" class="flex h-9 items-center gap-2 rounded-lg bg-brand-900 px-4 text-sm font-medium text-white shadow-lg shadow-brand-900/20 hover:bg-brand-800 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h2l2-3h10l2 3h2a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V9a2 2 0 012-2z" />
                                    </svg>
                                    Create Signature
                                </button>

                                <div id="sigCanva" class="hidden grid place-items-center">
                                    <div class="canvas-container relative">
                                        <canvas id="signature" class="bg-white border rounded"></canvas>
                                        <button id="clear-signature" class="absolute top-2 right-2 px-2 py-1 bg-red-500 text-white text-sm rounded">Clear</button>
                                    </div>

                                    <div class="mt-3 space-x-2">
                                        <button id="save-signature" class="flex h-9 items-center gap-2 rounded-lg bg-brand-900 px-4 text-sm font-medium text-white shadow-lg shadow-brand-900/20 hover:bg-brand-800 transition-colors">Save Signature</button>
                                    </div>
                                    <div class="mt-3 space-x-2">
                                        <button id="cancel-signature" class="flex h-9 items-center gap-2 rounded-lg bg-red-800 px-4 text-sm font-medium text-white shadow-lg shadow-brand-900/20 hover:bg-brand-800 transition-colors">Cancel</button>
                                    </div>
                                </div>

                                <center>
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
                                <input type="hidden" id="old_signature" value="<?= $offs['OFF_SIGNATURE'] ?>">
                                <button class="mt-5 hidden  py-2  rounded-xl h-9 items-center gap-2 bg-brand-900 px-4 text-sm font-medium text-white shadow-lg shadow-brand-900/20 hover:bg-brand-800 transition-colors">
                                    Upload Signature
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-4">
                        <button type="submit" id="hide-submit-sig" onclick="AddSignature()" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-70 disabled:cursor-not-allowed transition-colors duration-200 font-medium flex items-center justify-center">
                            Update Profile
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <br><br>
</div>
<script>
    function showToast(msg) {
        Toastify({
            text: msg,
            className: "info",
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            }
        }).showToast();
    }

    $('#avatarInput').on('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            const previewURL = URL.createObjectURL(file);
            $('#profilePreview').attr('src', previewURL);
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('sidebar').classList.add('hidden')
        document.getElementById('btn-home-nav').classList.remove('hidden')

        // Forms
        const openSignature = document.getElementById('open-signature');
        const sigCanvas = document.getElementById('signature');
        const signatureContainer = document.getElementById('sigCanva');
        const ctx = sigCanvas.getContext('2d');
        const clearBtn = document.getElementById('clear-signature');
        const saveBtn = document.getElementById('save-signature');
        const signaturePreviewContainer = document.getElementById('signature-preview-container');
        const signatureFilename = document.getElementById('signature-filename');
        const previewSignatureBtn = document.getElementById('preview-signature');
        const removeSignatureBtn = document.getElementById('remove-signature');
        const signaturePreviewModal = document.getElementById('signature-preview-modal');
        const signaturePreviewImage = document.getElementById('signature-preview-image');
        const closePreviewBtn = document.getElementById('close-preview-sig-btn');

        const cancel = document.getElementById('cancel-signature');

        let sigDrawing = false;
        let sigLastX = 0;
        let sigLastY = 0;
        let sigCapturedImage = null;

        console.log('Canvas:', sigCanvas);
        console.log('Context:', ctx);
        console.log('Canvas width:', sigCanvas.width);
        console.log('Canvas height:', sigCanvas.height);

        sigCanvas.width = 400;
        sigCanvas.height = 300;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.lineWidth = 2;
        ctx.strokeStyle = '#000';

        function getSigPos(e) {
            const rect = sigCanvas.getBoundingClientRect();
            return {
                x: e.clientX - rect.left,
                y: e.clientY - rect.top
            };
        }

        cancel.addEventListener('click', () => {
            signatureContainer.classList.add('hidden')
            saveBtn.classList.add('hidden')
            openSignature.classList.remove('hidden')
        })

        openSignature.addEventListener('click', function() {
            console.log('clicked')
            this.classList.add('hidden');
            saveBtn.classList.remove('hidden')
            signatureContainer.classList.remove('hidden');
        });

        sigCanvas.addEventListener('mousedown', (e) => {
            e.preventDefault();
            sigDrawing = true;
            const pos = getSigPos(e);
            sigLastX = pos.x;
            sigLastY = pos.y;
            ctx.beginPath();
            ctx.moveTo(sigLastX, sigLastY);
            console.log('✓ Drawing started at:', sigLastX, sigLastY);
        });

        sigCanvas.addEventListener('mouseup', (e) => {
            e.preventDefault();
            sigDrawing = false;
            ctx.beginPath();
            console.log('✓ Drawing stopped');
        });

        sigCanvas.addEventListener('mouseout', (e) => {
            e.preventDefault();
            sigDrawing = false;
            ctx.beginPath();
        });

        sigCanvas.addEventListener('mousemove', (e) => {
            e.preventDefault();
            if (!sigDrawing) return;
            const pos = getSigPos(e);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
            sigLastX = pos.x;
            sigLastY = pos.y;
        });

        clearBtn.addEventListener('click', () => {
            ctx.clearRect(0, 0, sigCanvas.width, sigCanvas.height);
            sigCapturedImage = null;
            console.log('✓ Canvas cleared');
        });

        saveBtn.addEventListener('click', () => {
            if (sigCanvas.width === 0 || sigCanvas.height === 0) {
                alert('Please draw a signature first!');
                return;
            }

            document.getElementById('hide-submit-sig').classList.remove('hidden');

            sigCapturedImage = sigCanvas.toDataURL('image/png');

            const link = document.createElement('a');
            const timestamp = new Date().getTime();
            const filename = `signature_${timestamp}.png`;
            link.href = sigCapturedImage;
            link.click();

            console.log('✓ Signature saved as file:', filename);

            signatureContainer.classList.add('hidden');

            signaturePreviewContainer.classList.remove('hidden');

            signatureFilename.textContent = filename;

            signatureFilename.dataset.imageData = sigCapturedImage;

            console.log('✓ Signature filename displayed:', filename);
        });

        previewSignatureBtn.addEventListener('click', function() {
            const imageData = signatureFilename.dataset.imageData;
            if (imageData) {
                signaturePreviewImage.src = imageData;
                signaturePreviewModal.classList.remove('hidden');
            } else {
                alert('No signature to preview!');
            }
        });

        closePreviewBtn.addEventListener('click', function() {
            signaturePreviewModal.classList.add('hidden');
        });

        signaturePreviewModal.addEventListener('click', (e) => {
            if (e.target === signaturePreviewModal) {
                signaturePreviewModal.classList.add('hidden');
            }
        });

        removeSignatureBtn.addEventListener('click', function() {
            document.getElementById('hide-submit-sig').classList.add('hidden');
            sigCapturedImage = null;
            signatureFilename.dataset.imageData = '';

            ctx.clearRect(0, 0, sigCanvas.width, sigCanvas.height);

            signaturePreviewContainer.classList.add('hidden');

            openSignature.classList.remove('hidden');
            signatureContainer.classList.add('hidden');

            console.log('✓ Signature removed');
        });
    })

    window.AddSignature = function() {
        const id = document.getElementById('off_id').value;
        const fname = document.getElementById('fname').value;
        const mname = document.getElementById('mname').value;
        const lname = document.getElementById('lname').value;
        const pob = document.getElementById('pob').value;
        const dob = document.getElementById('dob').value;
        const cs = document.getElementById('cs').value;
        const email = document.getElementById('uemail').value;
        const contact = document.getElementById('contact').value;
        const signatureData = document.getElementById('signature-filename').dataset.imageData;
        const oldSignature = document.getElementById('old_signature').value;
        const oldProfile = document.getElementById('old_pp').value;

        // console.log(id)
        // if (!id || !signatureData) {
        //     showToast('Please select official and draw signature first!');
        //     return;
        // }

        const avatarFile = document.getElementById('avatarInput').files[0];

        fetch(signatureData)
            .then(res => res.blob())
            .then(blob => {
                const formData = new FormData();
                formData.append('official_id', id);
                formData.append('fname', fname);
                formData.append('mname', mname);
                formData.append('lname', lname);
                formData.append('pob', pob);
                formData.append('dob', dob);
                formData.append('cs', cs);
                formData.append('email', email);
                formData.append('contact', contact);
                formData.append('signature', blob, 'signature.png');

                formData.append('old_signature', oldSignature);
                formData.append('old_pp', oldProfile);

                if (avatarFile) {
                    formData.append('avatar', avatarFile);
                }

                return fetch('../../data/staff-add-signature.php', {
                    method: 'POST',
                    body: formData
                });
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    showToast(result.message);
                    document.getElementById('signature-filename').dataset.imageData = '';
                    document.getElementById('signature-preview-container').classList.add('hidden')
                    document.getElementById('open-signature').classList.remove('hidden')
                } else {
                    showToast('Error: ' + (result.error || 'Upload failed'));
                }
            })
            .catch(error => {
                // console.error('Upload error:', error);
                showToast('Upload failed: ' + error.message);
            });
    };
</script>


<?php include('footer.php') ?>