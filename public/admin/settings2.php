<?php include('header.php') ?>

<input type="hidden" name="" id="off_id" value="<?= $_SESSION['OFFICIAL_ID'] ?>">

<div class="flex-1 overflow-y-auto lg:p-8 dark:bg-dark-bg bg-slate-50/50 pt-4 pr-4 pb-4 pl-4" id="content-navigations">
    <button id="open-signature" class="px-4 py-2 bg-blue-500 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h2l2-3h10l2 3h2a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V9a2 2 0 012-2z" />
        </svg>
        Upload signature
    </button>
    <!-- Signature Container -->
    <div id="sigCanva" class="hidden grid place-items-center">
        <div class="canvas-container relative">
            <canvas id="signature" class="bg-white border rounded"></canvas>
            <button id="clear-signature" class="absolute top-2 right-2 px-2 py-1 bg-red-500 text-white text-sm rounded">Clear</button>
        </div>

        <div class="mt-3 space-x-2">
            <button id="save-signature" class="px-4 py-2 bg-blue-500 text-white rounded">Save Signature</button>
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

    <button id="hide-submit-sig" onclick="AddSignature()" class="rounded mt-5 hidden px-4 py-2 bg-blue-500 text-white">
        Upload Signature
    </button>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('sidebar').classList.add('hidden')
        document.getElementById('btn-home-nav').classList.remove('hidden')


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

        openSignature.addEventListener('click', function() {
            console.log('clicked')
            signatureContainer.classList.remove('hidden');
            openSignature.classList.add('hidden');
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
        const signatureData = document.getElementById('signature-filename').dataset.imageData;

        if (!id || !signatureData) {
            alert('Please select official and draw signature first!');
            return;
        }

        // ✅ Convert dataURL to Blob for proper upload
        fetch(signatureData)
            .then(res => res.blob())
            .then(blob => {
                const formData = new FormData();
                formData.append('official_id', id);
                formData.append('signature', blob, 'signature.png');

                return fetch('../../data/staff-add-signature.php', {
                    method: 'POST',
                    body: formData
                });
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert(result.success);
                    // Reset form
                    document.getElementById('hide-submit-sig').classList.add('hidden');
                    document.getElementById('signature-filename').dataset.imageData = '';
                    document.getElementById('signature-preview-container').classList.add('hidden')
                    document.getElementById('open-signature').classList.remove('hidden')
                } else {
                    alert('Error: ' + (result.error || 'Upload failed'));
                }
            })
            .catch(error => {
                console.error('Upload error:', error);
                alert('Upload failed: ' + error.message);
            });
    };
</script>


<?php include('footer.php') ?>