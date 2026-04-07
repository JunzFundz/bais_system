   <?php
    require_once __DIR__ . '/../../model/AdminModel.php';
    include 'modal-see-user.php';
    include 'modal-confirm-deactivate.php';
    $admin = new AdminModel();
    $users = $admin->getAllUsersBrgy();

    function e($users)
    {
        return htmlspecialchars($users, ENT_QUOTES, 'UTF-8');
    }
    ?>


   <div class="">
       <div class="flex flex-col md:flex-row md:items-end gap-4 gap-x-4 gap-y-4 justify-between">
           <div class="">
               <h1 id="username-display" class="md:text-4xl text-dark text-3xl font-semibold tracking-tight font-poppins mb-2">Users</h1>
               <p class="text-slate-500 font-poppins">Lists of all users.</p>
           </div>
           <!-- <div class="flex items-center gap-3">
               <button data-modal-target="add-official-modal" data-modal-toggle="add-official-modal" class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                   <iconify-icon icon="solar:add-circle-linear" width="18"></iconify-icon>
                   <span>Add Official</span>
               </button>
           </div> -->
       </div>

       <div class=" w-full max-w-7xl mr-auto ml-auto pt-6 pr-6 pb-6 space-y-8">
           <div class="bg-white rounded-2xl shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] border border-slate-50 overflow-hidden">
               <div class="overflow-x-auto">
                   <table id="myTable3" class="w-full text-left border-collapse">
                       <thead class="">
                           <tr class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                               <th class="px-6 py-4">Full name</th>
                               <th class="px-6 py-4">Barangay</th>
                               <th class="px-6 py-4">Gender</th>
                               <th class="px-6 py-4">Status</th>
                               <th class="px-6 py-4 text-right">Action</th>
                           </tr>
                       </thead>
                       <tbody class="text-sm">
                           <?php if (!empty($users)) {
                                foreach ($users as $rows): ?>
                                   <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                                       <td class="px-6 py-4">
                                           <div class="flex items-center gap-3">
                                               <span class="font-medium text-dark">
                                                   <?= e($rows['FNAME'] . " " . $rows['MNAME'] . " " . $rows['LNAME']) ?>
                                               </span>
                                           </div>
                                       </td>
                                       <td class="px-6 py-4 text-slate-600"><?= e($rows['BRGY_ID']) ?></td>
                                       <td class="px-6 py-4 text-slate-500"><?= e(strtoupper($rows['SEX'])) ?></td>
                                       <td class="px-6 py-4">
                                           <?php
                                            $status = e(strtolower(trim($rows['PI_STATUS'])));

                                            switch ($status) {

                                                case 'active':
                                                    $badge = 'bg-green-100 text-green-700';
                                                    $text = 'active';
                                                    break;

                                                case 'deactivated':
                                                    $badge = 'bg-red-500/50 text-red-900';
                                                    $text = 'deactivated';
                                                    break;

                                                default:
                                                    $badge = 'bg-gray-100 text-gray-700';
                                                    $text = e(ucfirst($status));
                                            }
                                            ?>

                                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $badge ?>">
                                               <?= e($text) ?>
                                           </span>
                                       </td>
                                       <td class="px-6 py-4 text-right text-2xl">
                                           <i class="fa-regular fa-circle-xmark text-red-600 deactivite_id cursor-pointer" data-user_id="<?= e($rows['USER_ID']) ?>"></i>
                                           <i data-see_id="<?= e($rows['USER_ID']) ?>" class="fa-regular fa-eye text-green-800 cursor-pointer view-user-details">
                                           </i>
                                       </td>
                                   </tr>

                               <?php
                                endforeach;
                            } else { ?>
                               <h1>No data found</h1>
                           <?php } ?>

                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>

   <script>
       $(function() {

           $('.view-user-details').on('click', function() {
               const id = $(this).data('see_id');
               $.ajax({
                   url: '../../data/admin-see-user.php',
                   method: 'post',
                   data: {
                       'see': true,
                       id: id
                   },
                   dataType: 'html',
                   success: function(res) {
                       $('.modal-body').html(res);
                       window.detailsInstance.show();
                   },
                   error: function() {

                   }
               })
           })

           $('.deactivite_id').on('click', function() {
               const id = $(this).data('user_id');
               $.ajax({
                   url: '../../data/admin-confirm-deactivate.php',
                   method: 'post',
                   data: {
                       'see': true,
                       id: id
                   },
                   dataType: 'html',
                   success: function(res) {
                       $('.modal-body').html(res);
                       window.deactivateInstance.show();
                   },
                   error: function() {

                   }
               })
           })
       })
   </script>