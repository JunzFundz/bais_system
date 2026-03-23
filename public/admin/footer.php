
</body>
<script src="../assets/js/flowbite.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script src="../assets/js/admin.js"></script>
<script src="Api.js"></script>
<script>
    $(document).ready(function() {
        $('#add-post').on('click', function(e) {
            e.preventDefault(); // prevent default form submission

            let title = $('#post-title').val().trim();
            let description = $('#post-description').val().trim();
            let files = $('#post-file')[0].files;

            if (title === '') {
                alert('Title is required');
                return;
            }

            if (files.length === 0) {
                alert('Please select at least one file');
                return;
            }

            let formData = new FormData();
            formData.append('title', title);
            formData.append('description', description);

            // Append each selected file
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            $.ajax({
                url: '../../data/admin-add-act.php', // your PHP file that calls AdminModel
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    // Response from PHP
                    alert(response.message);
                    if (response.success) {
                        $('#post-title').val('');
                        $('#post-description').val('');
                        $('#post-file').val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Something went wrong while uploading.');
                }
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const modalElement = document.getElementById("custom-modal");
        if (modalElement) {
            window.modalInstance = new Modal(modalElement);
        }
    });

    function transactions() {
        $('#content-navigations').load('transactions.php', function() {
            initFlowbite();
        });
    }

    function officials() {
        $('#content-navigations').load('officials.php', function() {
            initFlowbite();
        });
    }

    function brgy() {
        $('#content-navigations').load('barangay.php', function() {
            initFlowbite();
        });
    }

    function certificates() {
        $('#content-navigations').load('certificates.php', function() {
            initFlowbite();
        });
    }

    function createCert() {
        $('#--add-cert').load('add-certificates.php');
    }

    function requests() {
        $('#content-navigations').load('requests.php', function() {
            initFlowbite();
        });
    }
    function users() {
        $('#content-navigations').load('users.php', function() {
            initFlowbite();
        });
    }

    $('.view-requests').on('click', function(e) {
        e.preventDefault();
        var rid = $(this).data('rid');
        var uid = $(this).data('uid');

        console.log(rid, uid);

        $.ajax({
            url: '../../data/admin-see-req.php',
            type: 'POST',
            data: {
                'view': true,
                req_id: rid,
                user_id: uid
            },
            dataType: "html",
            success: function(response) {
                // Fix: Use jQuery .html() or .text() instead of .innerText
                $('.modal-body').html(response); // Use .html() for HTML content
                // OR $('.modal-body').text(response); // Use .text() for plain text

                if (window.modalInstance) {
                    window.modalInstance.show();
                } else {
                    console.error("Modal instance is not initialized");
                }
            },
            error: function(xhr, status, error) {
                console.error('XHR:', xhr);
                console.error('Status:', status);
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                alert('Error getting data: ' + xhr.responseText);
            }
        });
    });
</script>

</html>