   <?php
    include __DIR__ . '/header.php';
    if (isset($_GET['barangay'])) {
        $brgy = $_GET['barangay'];

        $viewofficials = $admin->getOfficialsBrgy($brgy);

        include 'modal-add-officials.php'; ?>


       <div class="flex-1 overflow-y-auto lg:p-8 dark:bg-dark-bg bg-slate-50/50 pt-4 pr-4 pb-4 pl-4" id="content-navigations">
           <!-- Welcome Section -->
           <div class="flex flex-col md:flex-row md:items-end gap-4 gap-x-4 gap-y-4 justify-between">
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

           <section class="bg-white dark:bg-gray-900">
               <div class="container px-6 py-8 mx-auto">
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

                               <div class="w-full max-w-xs">
                                   <img class="object-cover object-center w-full h-48 mx-auto rounded-lg" src="../../profiles/<?= htmlspecialchars(strtoupper($row['PHOTO'])) ?>" alt="avatar" />
                                   <div class="mt-2">
                                       <h3 class="text-lg font-medium text-gray-700 dark:text-gray-200"><?= htmlspecialchars($row['L_NAME'] . " " . $row['F_NAME'] . " " . $row['M_NAME']) ?></h3>
                                       <span class="mt-1 font-medium text-gray-600 dark:text-gray-300"><?= htmlspecialchars(strtoupper($row['POSITION_NAME'])) ?></span>
                                   </div>
                                   <div class="inline-flex rounded-md shadow-xs">
                                       <a href="javascript: void(0)" data-id="<?= htmlspecialchars($row['OFFICIAL_ID']) ?>" id="" aria-current="page" class="update-official px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                           Update
                                       </a>
                                       <a data-email="<?= $_SESSION['EMAIL'] ?>" href="javascript: void(0)" class="open-mail-modal px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                           Mail
                                       </a>
                                       <a data-off="<?= htmlspecialchars($row['OFFICIAL_ID']) ?>" data-log="<?= htmlspecialchars($_SESSION['OFFICIALS_LOG_ID']) ?>" data-user="<?= $_SESSION['USER_ID'] ?>" href="javascript: void(0)" class="end-term px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                           End
                                       </a>
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