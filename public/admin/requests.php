<?php

require_once __DIR__ . '/../../model/AdminModel.php';
$admin = new AdminModel();
$data = $admin->requests();
include('modal-requests.php');
?>

<div class="flex flex-col md:flex-row md:items-end gap-4 gap-x-4 gap-y-4 justify-between">
    <div class="">
        <h1 id="username-display" class="md:text-4xl text-dark text-3xl font-semibold tracking-tight font-poppins mb-2">Requests</h1>
        <p class="text-slate-500 font-poppins">Lists of all requests.</p>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="bg-white rounded-2xl shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] border border-slate-50 overflow-hidden dark:text-white dark:bg-gray-800">

    <div class="overflow-x-auto">
        <table id="myTable" class="w-full text-left border-collapse">
            <thead class="">
                <tr class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-400 font-semibold">
                    <th class="px-6 py-4">Order ID</th>
                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Product</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if (!empty($data)) {
                    foreach ($data as $rows): ?>
                        <tr class="group hover:bg-slate-50/80 transition-colors border-b border-slate-50 last:border-0">
                            <td class="px-6 py-4 font-mono text-slate-500"><?= htmlspecialchars($rows['CTRL_NUM']) ?></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <!-- <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold">JD</div> -->
                                    <span class="font-medium text-dark">
                                        <?= htmlspecialchars($rows['FNAME'] . " " . $rows['MNAME'] . " " . $rows['LNAME']) ?>
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600"><?= htmlspecialchars($rows['CERT_NAME']) ?></td>
                            <td class="px-6 py-4 text-slate-500"><?= htmlspecialchars(date('M d,Y', strtotime($rows['REQ_DATE']))) ?></td>
                            <td class="px-6 py-4">
                                <?php
                                $status = strtolower(trim($rows['REQ_STATUS']));

                                switch ($status) {

                                    case 'pending':
                                        $badge = 'bg-yellow-100 text-yellow-700';
                                        $text = 'Pending';
                                        break;

                                    case 'approved':
                                        $badge = 'bg-blue-100 text-blue-700';
                                        $text = 'Approved';
                                        break;

                                    case 'released':
                                        $badge = 'bg-emerald-100 text-emerald-700';
                                        $text = 'Released';
                                        break;

                                    case 'rejected':
                                        $badge = 'bg-red-100 text-red-700';
                                        $text = 'Rejected';
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
                                    data-rid="<?= htmlspecialchars($rows['REQ_ID']) ?>"
                                    data-uid="<?= htmlspecialchars($rows['USER_ID']) ?>"
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

<script>
    let table = new DataTable('#myTable');






</script>