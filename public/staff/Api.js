
$.ajaxSetup({
    dataType: 'json'
});

document.addEventListener("DOMContentLoaded", function () {
    const updateModal = document.getElementById("modal-update-official");
    if (updateModal) {
        window.updateModalInstance = new Modal(updateModal);
    }
});

function showToast(msg) {
    Toastify({
        text: msg,
        className: "info",
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        }
    }).showToast();
}

$(document).ready(function () {
    $('#add-post').on('click', function (e) {
        e.preventDefault();

        document.getElementById('add-post').innerText = "Posting....";

        const brgy_id = $('#brgy_id').val().trim();
        let title = $('#post-title').val().trim();
        let description = $('#post-description').val().trim();
        let files = $('#post-file')[0].files;

        if (title === '') {
            showToast('Title is required');
            document.getElementById('add-post').innerText = "Post";
            return;
        }

        if (files.length === 0) {
            showToast('Please select at least one file');
            document.getElementById('add-post').innerText = "Post";
            return;
        }

        let formData = new FormData();
        formData.append('brgy_id', brgy_id);
        formData.append('title', title);
        formData.append('description', description);

        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        $.ajax({
            url: '../../data/staff-add-act.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                window.updateModalInstance.hide();
                showToast(response.message);
                // activities() 
            },
            error: function (xhr, status, error) {
                showToast('Something went wrong while uploading.');
            }
        });
    });
});

$('#change-password-data').on('click', function (e) {
    e.preventDefault();

    const u_id = $('#u_id').val();
    const current = $('#cpass').val();
    const newpass = $('#npass').val();
    const confirm = $('#cnpass').val();

    if (newpass !== confirm) {
        showToast('Passwords do not match');
        return;
    }

    $.ajax({
        url: '../../data/admin-change-password.php',
        method: 'POST',
        data: {
            u_id: u_id,
            current: current,
            newpass: newpass
        },
        dataType: 'json',
        success: function (res) {
            if (res.status === 'success') {
                showToast(res.message);
                setTimeout(() => {
                    location.reload();
                })
            } else {
                showToast(res.message);
            }
        },
        error: function () {
            showToast('Something went wrong');
        }
    });
});

function settings() {
    $('#content-navigations').load('settings.php', function () {
        initFlowbite();
    });
}

function officials() {
    $('#content-navigations').load('officials.php', function () {
        initFlowbite();
    });
}

function dashboard() {
    $('#content-navigations').load('dashboard.php', function () {
        initFlowbite();
        initCharts() 
    });
}

function brgy() {
    $('#content-navigations').load('barangay.php', function () {
        initFlowbite();

        $('.update-official').on('click', function (e) {
            e.preventDefault();

            const modal = $('#modal-update-official');
            const id = $(this).data('id');

            console.log(id)

            $.ajax({
                url: '../../data/staff-update-officials.php',
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


    });
}

function activities() {
    $('#content-navigations').load('activities.php', function () {
        initFlowbite();

        $('.delete-post').on('click', function () {
            const id = $(this).data('post');

            $.ajax({
                url: '../../data/admin-archive-post.php',
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        showToast(res.success)
                        activities()
                    } else {
                        showToast(res.error)
                    }
                },
                error: function () {

                }
            })
        });

    });
}

function requests() {
    $('#content-navigations').load('requests.php', function () {
        initFlowbite();

        $('.view-requests').on('click', function (e) {
            e.preventDefault();
            var rid = $(this).data('rid');
            var uid = $(this).data('uid');

            console.log(rid, uid);

            $.ajax({
                url: '../../data/staff-see-req.php',
                type: 'POST',
                data: {
                    'view': true,
                    req_id: rid,
                    user_id: uid
                },
                dataType: "html",
                success: function (response) {
                    $('.modal-body').html(response);
                    if (window.requestsModal) {
                        window.requestsModal.show();
                    } else {
                        console.error("Modal instance is not initialized");
                    }
                },
                error: function (xhr, status, error) {
                    console.error('XHR:', xhr);
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response:', xhr.responseText);
                    alert('Error getting data: ' + xhr.responseText);
                }
            });
        });

    });
}

function users() {
    $('#content-navigations').load('users.php', function () {
        initFlowbite();
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const updateModal = document.getElementById("modal-update-official");
    if (updateModal) {
        window.updateModalInstance = new Modal(updateModal);
    }
});


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
        url: '../../data/staff-add-officials.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,

        success: function (response) {
            console.log(response);

            if (response.success) {
                showToast(response.success);
                barangay()
            } else if (response.error) {
                showToast(response.error);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            showToast("Error: " + error);
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

