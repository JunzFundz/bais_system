
$.ajaxSetup({
    dataType: 'json'
});

function showLoader() {
    const loader = document.getElementById('preloader');
    if (loader) {
        loader.classList.remove('hidden');
    }
}

function hideLoader() {
    const loader = document.getElementById('preloader');
    if (loader) {
        loader.classList.add('hidden');
    }
}

hideLoader()

function addBrgy(e) {
    e.preventDefault();

    const brgy = $('#brgy').val();

    if (!brgy) {
        alert('Barangay field is required');
        return;
    }

    if (brgy.length < 2) {
        alert('Barangay name must be at least 2 characters');
        return;
    }

    if (brgy.length > 100) {
        alert('Barangay name must be less than 100 characters');
        return;
    }

    if (!/^[a-zA-Z\s-]+$/.test(brgy)) {
        alert('Barangay name can only contain letters, spaces, and hyphens');
        return;
    }

    $.ajax({
        url: '../../data/admin-operation.php',
        type: 'POST',
        data: {
            addData: true,
            brgy: brgy
        },
        success: function (response) {
            if (response.status === 'success') {
                $('#brgy').val('');
            }
            $('#content-navigations').html(response.message);
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            $('#content-navigations').html('<p class="text-red-500">An error occurred</p>');
        },
        timeout: 10000 // 10 seconds
    });
}

function addOfficial() {
    showLoader()
    const formData = new FormData();

    formData.append('addOfficial', true);
    formData.append('fname', $('#fname').val());
    formData.append('mname', $('#mname').val());
    formData.append('lname', $('#lname').val());
    formData.append('dob', $('#dob').val());
    formData.append('pob', $('#pob').val());
    formData.append('cs', $('#cs').val());
    formData.append('email', $('#email').val());
    formData.append('contact', $('#contact').val());
    formData.append('position', $('#position').val());
    formData.append('brgy', $('#brgy').val());
    formData.append('otitle', $('#otitle').val());
    formData.append('emp_id', $('#emp_id').val());

    const fileInput = document.getElementById('photo_profile');
    if (fileInput.files.length > 0) {
        formData.append('photo', fileInput.files[0]);
    }

    $.ajax({
        url: '../../data/admin-add-officials.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            // console.log(response);
            if (response.success) {
                if(confirm(response.success+"Add another officials?")){
                    $('#add-official-modal').find('input:not([type="hidden"]), textarea, select').val('');
                }else{
                    $('#add-official-modal').classList.add('hidden')
                }
                hideLoader()
            } else if (response.error) {
                alert(response.error);
                hideLoader()
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            alert("Error: " + error);
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const updateModal = document.getElementById("modal-update-official");
    if (updateModal) {
        window.updateModalInstance = new Modal(updateModal);
    }

    const modalElement = document.getElementById("custom-modal");
    if (modalElement) {
        window.customModalInstance = new Modal(modalElement);
    }
    const reqModal = document.getElementById("modal-requests-certs");
    if (reqModal) {
        window.requestsModal = new Modal(reqModal);
    }
});

document.addEventListener("DOMContentLoaded", function () {

    $('.update-official').on('click', function (e) {
        e.preventDefault();

        const modal = $('#modal-update-official');
        const id = $(this).data('id');

        $.ajax({
            url: '../../data/admin-update-officials.php',
            method: 'post',
            data: {
                'update': true,
                id: id
            },
            dataType: 'html',
            success: function (res) {
                $('.modal-body').html(res);
                window.updateModalInstance.show();
            },
            error: function () {

            }
        })
    })

})



