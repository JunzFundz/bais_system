   <?php
    include 'modal-add-officials.php';
    require_once __DIR__ . '/../../model/AdminModel.php';

    $req = new AdminModel();
    $data = $req->officials();
    ?>


   <div class="md:p-10 w-full max-w-7xl mr-auto ml-auto pt-6 pr-6 pb-6 pl-6 space-y-8">
       <!-- Welcome Section -->
       <div class="flex flex-col md:flex-row md:items-end gap-4 gap-x-4 gap-y-4 justify-between">
           <div class="">
               <h1 id="username-display" class="md:text-4xl text-dark text-3xl font-semibold tracking-tight font-poppins mb-2">Officials</h1>
               <p class="text-slate-500 font-poppins">Lists of official in all barangays will see here.</p>

           </div>
           <div class="flex items-center gap-3">
               <button data-modal-target="add-official-modal" data-modal-toggle="add-official-modal" class="flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-700 text-white text-sm font-medium shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                   <iconify-icon icon="solar:add-circle-linear" width="18"></iconify-icon>
                   <span>Add Official</span>
               </button>
           </div>
       </div>

       <div class=" w-full max-w-7xl mr-auto ml-auto pt-6 pr-6 pb-6 space-y-8">

           <!-- Recent Orders Table -->
           <div class="bg-white rounded-2xl shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] border border-slate-50 overflow-hidden">

               <div class="overflow-x-auto">
                   <table id="myTable3" class="w-full text-left border-collapse">
                       <thead class="">
                           <tr class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                               <th class="px-6 py-4">ID</th>
                               <th class="px-6 py-4">Full name</th>
                               <th class="px-6 py-4">Barangay</th>
                               <th class="px-6 py-4">Position</th>
                               <th class="px-6 py-4">Status</th>
                               <th class="px-6 py-4 text-right">Action</th>
                           </tr>
                       </thead>
                       <tbody class="text-sm">
                           <?php if (!empty($data)) {
                                foreach ($data as $rows): ?>
                                   <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                                       <td class="px-6 py-4 font-mono text-slate-500"><?= htmlspecialchars($rows['OFFICIAL_ID']) ?></td>
                                       <td class="px-6 py-4">
                                           <div class="flex items-center gap-3">
                                               <!-- <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold">JD</div> -->
                                               <span class="font-medium text-dark">
                                                   <?= htmlspecialchars($rows['FNAME'] . " " . $rows['MNAME'] . " " . $rows['LNAME']) ?>
                                               </span>
                                           </div>
                                       </td>
                                       <td class="px-6 py-4 text-slate-600"><?= htmlspecialchars($rows['BRGY']) ?></td>
                                       <td class="px-6 py-4 text-slate-500"><?= strtoupper($rows['POSITION']) ?></td>
                                       <td class="px-6 py-4">
                                           <?php
                                            $status = strtolower(trim($rows['PI_STATUS']));

                                            switch ($status) {

                                                case 'yes':
                                                    $badge = 'bg-yellow-100 text-yellow-700';
                                                    $text = 'Pending';
                                                    break;

                                                case 'no':
                                                    $badge = 'bg-blue-100 text-blue-700';
                                                    $text = 'Approved';
                                                    break;

                                                default:
                                                    $badge = 'bg-gray-100 text-gray-700';
                                                    $text = ucfirst($status);
                                            }
                                            ?>

                                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $badge ?>">
                                               <?= htmlspecialchars($text) ?>
                                           </span>
                                       </td>
                                       <td class="px-6 py-4 text-right text-2xl">
                                           <i class="fa-solid fa-delete-left text-red-500"></i>

                                           <i
                                               class="fa-regular fa-eye text-green-800 cursor-pointer view-requests">
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

       <script>
           let table = new DataTable('#myTable3');
       </script>

   </div>
   <script>
       // let table = new DataTable('#myTable');
   </script>