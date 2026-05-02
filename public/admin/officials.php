   <?php
    include __DIR__ . '/header.php';
    if (isset($_GET['barangay'])) {
        $brgy = $_GET['barangay'];

        $viewofficials = $admin->getOfficialsBrgy($brgy);

        include 'modal-add-officials.php'; ?>

       <div class="flex-1 cursor-pointer overflow-y-auto lg:p-8 dark:bg-dark-bg  pt-4 pr-4 pb-4 pl-4 bg-gray-200" id="content-navigations">
           <!-- Welcome Section -->
           <div class="flex flex-col md:flex-row md:items-end gap-4 gap-x-4 gap-y-4 justify-between p-5 bg-white rounded-2xl">
               <div class="">
                   <h1 id="username-display" class="md:text-4xl text-dark text-3xl font-semibold tracking-tight font-poppins mb-2">Officials</h1>
                   <p class="text-slate-500 font-poppins"><?= htmlspecialchars($_SESSION['BARANGAY']) ?></p>
               </div>
               <div class="flex items-center gap-3">
                   <button data-modal-target="add-official-modal" data-modal-toggle="add-official-modal" class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                       <iconify-icon icon="solar:add-circle-linear" width="18"></iconify-icon>
                       <span>Add Officials</span>
                   </button>
               </div>
           </div>

           <section class=" dark:bg-gray-900">
               <div class="container px-6 py-8 mx-auto bg-gray-200">
                   <h2 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white"></h2>

                   <div class="grid gap-8 mt-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                       <?php
                        $hasOfficial = false;

                        if ($viewofficials) {
                            foreach ($viewofficials as $row) {
                                if (empty($row['OFFICIAL_ID'])) continue;
                                $hasOfficial = true;

                                $_SESSION['OFFICIAL_ID'] = $row['OFFICIAL_ID'];
                                $_SESSION['EMAIL'] = $row['EMAIL'];  ?>

                               <div class="w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                                   <img class="object-cover object-center w-full h-56" src="../../profiles/<?= htmlspecialchars(strtoupper($row['PHOTO'])) ?>" alt="avatar">

                                   <div class="flex items-center px-6 py-3 bg-gray-900">
                                       <h1 class="mx-3 text-lg font-semibold text-white"><?= htmlspecialchars(strtoupper($row['POSITION_NAME'])) ?></h1>
                                   </div>

                                   <div class="px-6 py-4">
                                       <h1 class="text-xl font-semibold text-gray-800 dark:text-white"><?= htmlspecialchars(strtoupper($row['L_NAME'] . " " . $row['F_NAME'] . " " . $row['M_NAME'])) ?></h1>

                                       <div data-id="<?= htmlspecialchars($row['OFFICIAL_ID']) ?>" class="update-official cursor-pointer flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                               <path fill="currentColor" d="m11.98 11.248l.907.906l5.829-5.829l-.906-.906zM5.136 19h.906l6.113-6.113l-.906-.906l-6.113 6.113zm8.105-5.76l-2.326-2.346l4.79-4.79l-.36-.36q-.154-.153-.461-.153t-.462.153L9.877 10.29q-.146.146-.335.146t-.334-.146q-.166-.147-.166-.348t.147-.347l4.557-4.557q.485-.485 1.153-.485t1.153.485l.36.36l.827-.828q.242-.242.568-.242t.568.242l1.267 1.268q.243.242.224.53q-.02.287-.262.53zM4.943 20q-.348 0-.577-.23q-.23-.23-.23-.578v-1.098q0-.207.073-.387t.233-.34l6.453-6.453l2.346 2.327l-6.473 6.453q-.16.16-.339.233T6.04 20z" />
                                           </svg>

                                           <h1 class="px-2 text-sm">Update</h1>
                                       </div>

                                       <div data-email="<?= $_SESSION['EMAIL'] ?>" class="open-mail-modal cursor-pointer flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                               <path fill="currentColor" d="m10.866 10.116l-8-5.231v10.5q0 .269.173.442T3.48 16h10.115v1H3.481q-.69 0-1.153-.462t-.462-1.153V4.615q0-.69.462-1.153T3.481 3H18.25q.69 0 1.153.463t.463 1.152v4.77h-1v-4.5zm0-1.116l7.692-5H3.173zm8 11.962q-1.362 0-2.316-.954t-.954-2.316v-4.5q0-.8.543-1.342t1.342-.542t1.342.542t.543 1.342v4.5h-1v-4.5q0-.373-.256-.628q-.256-.256-.63-.256t-.628.256t-.256.628v4.5q0 .94.665 1.605q.664.665 1.605.665q.94 0 1.604-.665q.665-.664.665-1.605v-4h1v4q0 1.362-.954 2.316t-2.316.954m-16-16.077V4v12z" />
                                           </svg>

                                           <h1 class="px-2 text-sm">Send mail</h1>
                                       </div>

                                       <div class="end-term cursor-pointer flex items-center mt-4 text-gray-700 dark:text-gray-200" data-off="<?= htmlspecialchars($row['OFFICIAL_ID']) ?>" data-log="<?= htmlspecialchars($_SESSION['OFFICIALS_LOG_ID']) ?>" data-user="<?= $_SESSION['USER_ID'] ?>">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                               <path fill="currentColor" d="M7 15h10v-1H7zm0-3h3.385v-.885H8.516q.673-.82 1.548-1.372T12 9.193q1.348 0 2.415.773q1.066.774 1.531 2.034h.935q-.485-1.634-1.831-2.664Q13.704 8.308 12 8.308q-1.225 0-2.282.605t-1.834 1.575V8.615H7zm5.003 9q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924t-1.925-2.856T3 12.003t.709-3.51Q4.417 6.85 5.63 5.634t2.857-1.925T11.997 3t3.51.709q1.643.708 2.859 1.922t1.925 2.857t.709 3.509t-.708 3.51t-1.924 2.859t-2.856 1.925t-3.509.709M12 20q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8" />
                                           </svg>

                                           <h1 class="px-2 text-sm">End term</h1>
                                       </div>
                                   </div>
                               </div>
                       <?php }
                        } else {
                            echo "no officials found";
                        } ?>

                   </div>
               </div>
           </section>
       </div>
   <?php } ?>

   <script>
       document.getElementById('sidebar').classList.add('hidden')
       document.getElementById('btn-home-nav').classList.remove('hidden')

       function showToast(msg) {
           Toastify({
               text: msg,
               className: "info",
               style: {
                   background: "linear-gradient(to right, #00b09b, #96c93d)",
               }
           }).showToast();
       }
       $(document).ready(function() {
           $('.open-mail-modal').on('click', function() {
               const mailModal = document.getElementById("add-mail-modal");
               if (mailModal) {
                   window.mailInstance = new Modal(mailModal);
               }
               const email = $(this).data('email');
               const bodyemail = $('#email-send').val(email);
               window.mailInstance.show();
           });

           $('#sendEmailBtn').on('click', function(e) {
               e.preventDefault();

               let $button = $(this);
               let originalText = $button.html();
               $button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sending...');

               let bodyHtml = $('.modal-body-email').clone();
               const email = $('#email-send').val().trim();

               bodyHtml.find('#description').replaceWith($('#description').val());
               bodyHtml.find('script, button, input, textarea, select').remove();
               bodyHtml = bodyHtml.html();

               $.ajax({
                   url: '../../data/send-email.php',
                   method: 'POST',
                   data: {
                       email: email,
                       body: bodyHtml,
                       _token: $('meta[name="csrf-token"]').attr('content')
                   },
                   dataType: 'json',
                   timeout: 30000,
                   success: function(res) {
                       if (res.success) {
                           showToast('Email sent successfully!');
                           $('#description').val('');
                           $('#email-send').val('');
                       } else {
                           showToast('Error: ' + (res.error || 'Failed to send email'));
                       }
                   },
                   error: function(xhr, status, error) {
                       let errorMsg = 'Failed to send email';

                       if (status === 'timeout') {
                           errorMsg = 'Request timeout. Please try again.';
                       } else if (xhr.responseJSON && xhr.responseJSON.message) {
                           errorMsg = xhr.responseJSON.message;
                       }

                       console.error('AJAX Error:', xhr.responseText);
                       showToast(errorMsg);
                   },
                   complete: function() {
                       $button.prop('disabled', false).html(originalText);
                   }
               });
           });

           $('.end-term').on('click', function(e) {
               e.preventDefault();

               const off_id = $(this).data('off');
               const user = $(this).data('user');
               const log = $(this).data('log');

               $.ajax({
                   url: '../../data/admin-end-term.php',
                   method: 'POST',
                   data: {
                       off_id,
                       user,
                       log
                   },
                   dataType: 'json',
                   timeout: 30000,
                   success: function(res) {
                       if (res.success) {
                           showToast('Term successfully ended!');
                           setTimeout(() => {
                               location.reload();
                           }, 3000)
                       } else {
                           showToast(res.message || 'Failed to end term.');
                       }
                   },
                   error: function(xhr, status, error) {
                       let errorMsg = 'Something went wrong';
                       if (status === 'timeout') {
                           errorMsg = 'Request timeout. Please try again.';
                       } else if (xhr.responseJSON && xhr.responseJSON.message) {
                           errorMsg = xhr.responseJSON.message;
                       }
                       console.error('AJAX Error:', xhr.responseText);
                       showToast(errorMsg);
                   },
               });
           });
       })
   </script>

   <?php include 'footer.php' ?>