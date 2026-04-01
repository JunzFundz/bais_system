
document.addEventListener('DOMContentLoaded', () => {
    // Signature elements
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


    const letterInput = document.getElementById("dropzone-letter");
    const changeReq = document.getElementById("change-req");
    const letterContainer = document.getElementById("letter-preview-container");
    const letterFilename = document.getElementById("letter-filename");
    const previewLetterBtn = document.getElementById("preview-letter");
    const removeLetterBtn = document.getElementById("remove-letter");
    const letterModal = document.getElementById("letter-preview-modal");
    const letterPreviewImage = document.getElementById("letter-preview-image");
    const closeLetterPreviewBtn = document.getElementById("close-preview-letter-btn");

    let letterFile = null;


    // SELECT FILE
    letterInput.addEventListener("change", function () {
        const file = this.files[0];
        if (!file) return;

        // Get timestamp
        const timestamp = new Date().getTime();

        // Use same file format as photo
        const ext = file.name.split('.').pop(); // preserve extension
        const filename = `letter_${timestamp}.${ext}`;

        // Set filename and show container
        letterFilename.textContent = filename;
        letterContainer.classList.remove("hidden");

        const reader = new FileReader();
        reader.onload = function (e) {
            letterPreviewImage.src = e.target.result;

            // Store base64 like photo & signature
            letterFilename.dataset.imageData = e.target.result;
            changeReq.classList.add('hidden');
        };
        reader.readAsDataURL(file);

    });

    // PREVIEW CLICK
    previewLetterBtn.addEventListener("click", function () {
        letterModal.classList.remove("hidden");
    });


    // CLOSE MODAL
    closeLetterPreviewBtn.addEventListener("click", function () {
        letterModal.classList.add("hidden");
    });


    // REMOVE FILE
    removeLetterBtn.addEventListener("click", function () {

        letterInput.value = "";

        letterContainer.classList.add("hidden");
        letterPreviewImage.src = "";

        // ⭐ VERY IMPORTANT
        letterFilename.dataset.imageData = "";
        changeReq.classList.remove('hidden');
    });

    let sigDrawing = false;
    let sigLastX = 0;
    let sigLastY = 0;
    let sigCapturedImage = null;

    console.log('Canvas:', sigCanvas);
    console.log('Context:', ctx);
    console.log('Canvas width:', sigCanvas.width);
    console.log('Canvas height:', sigCanvas.height);

    // Set canvas size
    sigCanvas.width = 400;
    sigCanvas.height = 300;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    ctx.lineWidth = 2;
    ctx.strokeStyle = '#000';

    // Get position relative to canvas
    function getSigPos(e) {
        const rect = sigCanvas.getBoundingClientRect();
        return {
            x: e.clientX - rect.left,
            y: e.clientY - rect.top
        };
    }

    // Open signature button
    openSignature.addEventListener('click', function () {
        signatureContainer.classList.remove('hidden');
        openSignature.classList.add('hidden');
    });

    // Mouse events for signature
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

    // Clear button
    clearBtn.addEventListener('click', () => {
        ctx.clearRect(0, 0, sigCanvas.width, sigCanvas.height);
        sigCapturedImage = null;
        console.log('✓ Canvas cleared');
    });

    // Save button - Save as file and show filename
    saveBtn.addEventListener('click', () => {
        // Check if signature exists
        if (sigCanvas.width === 0 || sigCanvas.height === 0) {
            alert('Please draw a signature first!');
            return;
        }

        // Convert canvas to data URL with transparent background
        sigCapturedImage = sigCanvas.toDataURL('image/png');

        // Download the signature as a file
        const link = document.createElement('a');
        const timestamp = new Date().getTime();
        const filename = `signature_${timestamp}.png`;
        // link.download = filename;
        link.href = sigCapturedImage;
        link.click();

        console.log('✓ Signature saved as file:', filename);

        // Hide signature container
        signatureContainer.classList.add('hidden');

        // Show signature preview container with filename
        signaturePreviewContainer.classList.remove('hidden');

        // Set filename display
        signatureFilename.textContent = filename;

        // Store image data for preview
        signatureFilename.dataset.imageData = sigCapturedImage;

        console.log('✓ Signature filename displayed:', filename);
    });

    // Preview signature
    previewSignatureBtn.addEventListener('click', function () {
        const imageData = signatureFilename.dataset.imageData;
        if (imageData) {
            signaturePreviewImage.src = imageData;
            signaturePreviewModal.classList.remove('hidden');
        } else {
            alert('No signature to preview!');
        }
    });

    // Close preview modal
    closePreviewBtn.addEventListener('click', function () {
        signaturePreviewModal.classList.add('hidden');
    });

    // Close preview on outside click
    signaturePreviewModal.addEventListener('click', (e) => {
        if (e.target === signaturePreviewModal) {
            signaturePreviewModal.classList.add('hidden');
        }
    });

    // Remove signature
    removeSignatureBtn.addEventListener('click', function () {
        // Clear captured image
        sigCapturedImage = null;
        signatureFilename.dataset.imageData = '';

        // Clear canvas
        ctx.clearRect(0, 0, sigCanvas.width, sigCanvas.height);

        // Hide signature preview container
        signaturePreviewContainer.classList.add('hidden');

        // Show signature button again
        openSignature.classList.remove('hidden');
        signatureContainer.classList.add('hidden');

        console.log('✓ Signature removed');
    });
});


let video = document.getElementById('camera');
let canvas = document.getElementById('canvas');
let takeBtn = document.getElementById('take-btn');
let retakeBtn = document.getElementById('retake-btn');
let doneBtn = document.getElementById('done-btn');
let cameraContainer = document.getElementById('camera-container');
let photoButtons = document.getElementById('photo-buttons');
let openCamera = document.getElementById('open-camera');
let imagePreviewContainer = document.getElementById('image-preview-container');
let imageFilename = document.getElementById('image-filename');
let previewBtn = document.getElementById('preview-btn');
let removeBtn = document.getElementById('remove-btn');
let previewModal = document.getElementById('image-preview-modal');
let previewImage = document.getElementById('preview-image');
let closePreviewBtn = document.getElementById('close-preview-btn');

let stream = null;
let capturedImage = null;

// Start camera
function startCamera() {
    // Reset video element
    video.srcObject = null;
    video.load();
    video.currentTime = 0;

    // Make video visible
    video.classList.remove('hidden');
    video.style.display = 'block';
    video.style.visibility = 'visible';
    video.style.opacity = '1';

    // Get camera stream
    navigator.mediaDevices.getUserMedia({
        video: {
            width: { ideal: 1280 },
            height: { ideal: 720 },
            facingMode: "user"
        }
    })
        .then(s => {
            stream = s;
            video.srcObject = stream;

            video.onloadedmetadata = () => {
                video.play();
                cameraContainer.classList.remove('hidden');
                photoButtons.classList.remove('hidden');
                if (openCamera) {
                    openCamera.classList.add('hidden');
                    retakeBtn.classList.add('hidden')
                    doneBtn.classList.add('hidden')
                    takeBtn.classList.remove('hidden');
                }
            };
        })
        .catch(err => console.error("Camera error:", err));
}

// Stop camera
function stopCamera() {
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
    }
}

// Take photo
takeBtn.addEventListener('click', function () {
    let ctx = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Convert canvas to data URL
    capturedImage = canvas.toDataURL('image/jpeg', 0.9);

    // Stop camera
    stopCamera();

    // Hide video, show canvas
    video.classList.add('hidden');
    video.style.display = 'none';
    canvas.classList.remove('hidden');

    // Update buttons
    takeBtn.classList.add('hidden');
    retakeBtn.classList.remove('hidden');
    doneBtn.classList.remove('hidden');
});

// Retake photo
retakeBtn.addEventListener('click', function () {
    // Hide canvas, show video
    canvas.classList.add('hidden');
    video.classList.remove('hidden');
    video.style.display = 'block';
    video.style.visibility = 'visible';
    video.style.opacity = '1';

    // Update buttons
    takeBtn.classList.remove('hidden');
    retakeBtn.classList.add('hidden');
    doneBtn.classList.add('hidden');

    // Restart camera
    startCamera();
});

// Done button
doneBtn.addEventListener('click', function () {
    // Hide video and canvas
    video.classList.add('hidden');
    video.style.display = 'none';
    canvas.classList.add('hidden');

    // Hide photo buttons
    photoButtons.classList.add('hidden');

    // Hide camera container
    cameraContainer.classList.add('hidden');

    // Show image preview container
    imagePreviewContainer.classList.remove('hidden');

    // Set filename
    const timestamp = new Date().getTime();
    const filename = `photo_${timestamp}.jpg`;
    imageFilename.textContent = filename;

    // Store image data
    imageFilename.dataset.imageData = capturedImage;
});

// Preview button
previewBtn.addEventListener('click', function () {
    const imageData = imageFilename.dataset.imageData;
    if (imageData) {
        previewImage.src = imageData;
        previewModal.classList.remove('hidden');
    }
});

// Close preview modal
closePreviewBtn.addEventListener('click', function () {
    previewModal.classList.add('hidden');
});

// Close preview on outside click
previewModal.addEventListener('click', (e) => {
    if (e.target === previewModal) {
        previewModal.classList.add('hidden');
    }
});

// Remove button
removeBtn.addEventListener('click', function () {
    // Clear captured image
    capturedImage = null;
    imageFilename.dataset.imageData = '';

    // Hide image preview container
    imagePreviewContainer.classList.add('hidden');

    // Show camera button
    openCamera.classList.remove('hidden');
    cameraContainer.classList.add('hidden');
});

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    if (openCamera) {
        openCamera.addEventListener('click', startCamera);
    }
});


document.addEventListener('DOMContentLoaded', () => {
    // Form elements
    let type = document.getElementById('select-type');
    let req = document.getElementById('change-req');
    const steps = document.querySelectorAll(".step");
    const nextBtn = document.getElementById("next-btn");
    const prevBtn = document.getElementById("prev-btn");

    // Error container
    const errorContainer = document.getElementById('form-errors') || createErrorContainer();

    // Type change
    type.addEventListener('change', function () {
        if (type.value === "2") {
            req.classList.remove('hidden');
        } else {
            req.classList.add('hidden');
        }
    });

    // Indicators and progress
    const indicators = [
        document.getElementById("indicator-1"),
        document.getElementById("indicator-2"),
        document.getElementById("indicator-3")
    ];
    const lines = [
        document.getElementById("line-1"),
        document.getElementById("line-2")
    ];
    const progressBar = document.getElementById("progress-bar");
    let currentStep = 0;

    // Create error container if it doesn't exist
    function createErrorContainer() {
        const container = document.createElement('div');
        container.id = 'form-errors';
        container.className = 'hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4';
        document.querySelector('.step').insertBefore(container, document.querySelector('.step').firstChild);
        return container;
    }

    // Show error message
    function showError(message) {
        Toastify({
            text: message,
            duration: 4000,
            gravity: "top",
            position: "right",
            backgroundColor: "#ef4444", // red
            stopOnFocus: true
        }).showToast();
    }

    // Hide error message
    function hideError() {
        errorContainer.classList.add('hidden');
        errorContainer.innerHTML = '';
    }

    // Validate Step 1: Personal Information
    function validateStep1() {
        const errors = [];
        const fname = document.getElementById('fname');
        const mname = document.getElementById('mname');
        const lname = document.getElementById('lname');
        const citizen = document.getElementById('citizen');
        const sex = document.getElementById('sex');
        const civilstatus = document.getElementById('civilstatus');
        const age = document.getElementById('age');

        if (!fname || !fname.value.trim()) errors.push('First name is required');
        if (!lname || !lname.value.trim()) errors.push('Last name is required');
        if (!citizen || !citizen.value.trim()) errors.push('Citizenship is required');
        if (!sex || !sex.value.trim()) errors.push('Sex is required');
        if (!civilstatus || !civilstatus.value.trim()) errors.push('Civil status is required');
        if (!age || !age.value.trim()) errors.push('Age is required');

        return errors;
    }

    // Validate Step 2: Contact/Address
    function validateStep2() {
        const errors = [];
        const contact = document.getElementById('contact');
        const email = document.getElementById('email');
        const street = document.getElementById('street');
        const Barangay = document.getElementById('Barangay');
        const city = document.getElementById('city');

        if (!contact || !contact.value.trim()) errors.push('Contact number is required');
        else if (!/^09\d{9}$/.test(contact.value)) errors.push('Contact must be 11 digits starting with 09');

        if (!email || !email.value.trim()) errors.push('Email is required');
        else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) errors.push('Invalid email format');

        if (!street || !street.value.trim()) errors.push('Street is required');
        if (!Barangay || !Barangay.value.trim()) errors.push('Barangay is required');
        if (!city || !city.value.trim()) errors.push('City is required');

        return errors;
    }

    // Validate Step 3: Photo & Signature
    function validateStep3() {
        const validateCertId = parseInt(document.getElementById('cert-id').value);
        let hideSignature = document.getElementById('open-signature');
        let hideCamera = document.getElementById('open-camera');
        const errors = [];
        const imageFilename = document.getElementById('image-filename');
        const signatureFilename = document.getElementById('signature-filename');
        const letter = document.getElementById('letter-filename');
        const type = document.getElementById('select-type').value;

        const purpose = document.getElementById('purpose').value.trim()

        if (!purpose) {
            errors.push('Empty purpose');
        }

        if (validateCertId === 3 || validateCertId === 4) {
            if (type === '2') {
                if (!letter || !letter.dataset.imageData) {
                    errors.push('Please upload authorization letter');
                }
            }

            if (!imageFilename ||
                !imageFilename.dataset.imageData ||
                imageFilename.dataset.imageData.trim() === "") {
                errors.push('Please add your photo');
            }

            if (!signatureFilename ||
                !signatureFilename.dataset.imageData ||
                signatureFilename.dataset.imageData.trim() === "") {
                errors.push('Please add your signature');
            }

        } else {
            if (hideCamera) hideCamera.classList.add("hidden");
            if (hideSignature) hideSignature.classList.add("hidden");

        }

        console.log("STEP 3 ERRORS:", errors); // DEBUG
        return errors;
    }

    // Validate Step 4: Review
    function validateStep4() {
        const errors = [];

        return errors;
    }

    // Main validation function
    function validateCurrentStep() {
        hideError();
        let errors = [];

        switch (currentStep) {
            case 0:
                errors = validateStep1();
                break;
            case 1:
                errors = validateStep2();
                break;
            case 2:
                errors = validateStep3();
                break;
            case 3:
                errors = validateStep4();
                break;
        }

        if (errors.length > 0) {
            showError(errors.join('\n'));
            return false;
        }

        return true;
    }

    // Update indicators
    function updateIndicators(stepIndex) {
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle("bg-blue-600", index <= stepIndex);
            indicator.classList.toggle("text-white", index <= stepIndex);
            indicator.classList.toggle("bg-gray-300", index > stepIndex);
            indicator.classList.toggle("text-gray-600", index > stepIndex);
        });

        lines.forEach((line, index) => {
            line.classList.toggle("bg-blue-600", index < stepIndex);
            line.classList.toggle("bg-gray-300", index >= stepIndex);
        });
    }

    // Update progress bar
    function updateProgressBar(stepIndex) {
        const progressPercentage = ((stepIndex + 1) / steps.length) * 100;
        progressBar.style.width = `${progressPercentage}%`;
    }

    // Show step
    function showStep(index) {
        steps.forEach((step, i) => {
            step.classList.toggle("hidden", i !== index);
        });
        prevBtn.classList.toggle("hidden", index === 0);
        nextBtn.textContent = index === steps.length - 1 ? "Submit" : "Next";
        updateIndicators(index);
        updateProgressBar(index);
        hideError();
    }

    // Collect form data
    function collectFormData() {
        const keys = document.getElementById('next-btn');

        const letterData = document.getElementById('letter-filename').dataset.imageData || '';
        console.log('Letter data exists:', letterData ? 'YES (length: ' + letterData.length + ')' : 'NO');

        return {
            key: keys.getAttribute('data-getKey'),
            fname: document.getElementById('fname').value.trim(),
            userId: document.getElementById('user-id').value.trim(),
            mname: document.getElementById('mname').value.trim(),
            purpose: document.getElementById('purpose').value.trim(),
            pid: document.getElementById('pi-id').value.trim(),
            lname: document.getElementById('lname').value.trim(),
            citizen: document.getElementById('citizen').value.trim(),
            sex: document.getElementById('sex').value.trim(),
            civilstatus: document.getElementById('civilstatus').value.trim(),
            age: document.getElementById('age').value.trim(),
            contact: document.getElementById('contact').value.trim(),
            email: document.getElementById('email').value.trim(),
            street: document.getElementById('street').value.trim(),
            Barangay: document.getElementById('Barangay').value.trim(),
            city: document.getElementById('city').value.trim(),
            type: document.getElementById('select-type').value,
            photo: document.getElementById('image-filename').dataset.imageData || '',
            signature: document.getElementById('signature-filename').dataset.imageData || '',
            letter: document.getElementById('letter-filename').dataset.imageData || ''
        };
    }

    function openConfirmModal(msg) {
        document.getElementById('my-modal').classList.remove('hidden');
        const textTittle = document.getElementById('modal-title');

        textTittle.innerText = msg
    }

    function openAlertModal() {
        document.getElementById('alert-modal').classList.remove('hidden');
    }

    function closeConfirmModal() {
        document.getElementById('my-modal').classList.add('hidden');
    }

    // Next button with validation
    nextBtn.addEventListener("click", () => {
        if (validateCurrentStep()) {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            } else {
                openConfirmModal()
            }
        }
    });
    // Previous button
    prevBtn.addEventListener("click", () => {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    const submitRequestForm = document.getElementById('confirm-request');
    const textTittle = document.getElementById('modal-title');

    submitRequestForm.addEventListener('click', function (e) {
        e.preventDefault();

        submitForm()
        closeConfirmModal()
    })

    function submitForm() {
        const formData = collectFormData();
        const submitBtn = document.getElementById('next-btn');

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';

        // console.log('=== SUBMITTING FORM ===');
        // console.log('Form Data:', formData);

        fetch('../../data/user-add-requests.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showLoader()
                    setTimeout(() => {
                        openAlertModal()
                        hideLoader()
                    }, 5000)
                } else {
                    alert('Error: ' + data.success);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('An error occurred: ' + error);

                console.error('Error details:', {
                    message: error.error,
                    stack: error.stack
                });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit';
            });
    }

    showStep(currentStep);
});

const updateInformation = document.getElementById('update-user');

if (updateInformation) {
    updateInformation.addEventListener('click', async (e) => {
        e.preventDefault();

        const payload = {
            fname: document.getElementById('fname').value,
            mname: document.getElementById('mname').value,
            lname: document.getElementById('lname').value,
            cship: document.getElementById('cship').value,
            sex: document.getElementById('sex').value,
            cs: document.getElementById('cs').value,
            age: document.getElementById('age').value,
            contact: document.getElementById('contact').value,
            street: document.getElementById('street').value,
            brgy: document.getElementById('brgy').value,
            city: document.getElementById('city').value
        };

        try {
            const res = await fetch("../../data/user-update-info.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            if (data.status === "success") {
                alert(data.message); // fix this too
            } else {
                alert(data.message);
            }

        } catch (error) {
            console.error(error);
            alert("Update failed");
        }
    });
}


