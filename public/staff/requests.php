<?php
require_once __DIR__ . '/../../model/Staff.php';
$admin = new Staff();
session_start();

$brgyID = $_SESSION['BRGY_ID'];
$data = $admin->requests($brgyID);

?>
<!-- Recent Orders Table -->
<div class="bg-white rounded-2xl shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] border border-slate-50 overflow-hidden dark:text-white dark:bg-gray-800">

    <div class="overflow-x-auto">
        <table id="myTable" class="w-full text-left border-collapse">
            <?php if (!empty($data)) { ?>
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
                    <?php foreach ($data as $rows):
                        $_SESSION['EMAIL'] = $rows['EMAIL'];
                        $_SESSION['u_id'] = $rows['USER_ID'];
                    ?>
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

                                <i data-rid="<?= htmlspecialchars($rows['REQ_ID']) ?>"
                                    data-uid="<?= htmlspecialchars($rows['USER_ID']) ?>"
                                    class="fa-regular fa-eye text-green-800 cursor-pointer view-requests">
                                </i>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                } else { ?>

                </tbody>
                <h1 class="text-center">No requests yet</h1>
            <?php } ?>
        </table>
    </div>
</div>
