<?php

$uid = $_SESSION['USER_ID'];
$pid = $_SESSION['PI_ID'];
$rid = $_SESSION['REQ_ID'];
$cid = $_SESSION['CERT_ID'];

$d = $admin->generate($uid, $pid, $rid, $cid);
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d H:i:s');
?>

<style>
    html,
    body {
        height: auto !important;
        overflow: auto !important;
    }
</style>

<center>
    <div class="inline-flex print:hidden rounded-md shadow-xs pt-3" id="buttons-group" role="group">
        <button onclick="closeTab()" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            Back to certificates
        </button>
        <button onclick="window.print()" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            Print
        </button>
        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            Send as mail
        </button>
    </div>
</center>


<div class="min-h-screen overflow-y-auto w-full">
    <div class="border-2 border-gray-800 p-20 my-32 mx-32 print:mx-9 print:my-9 print:p-9">

        <div class="flex flex-row justify-between w-full text-center">
            <div class="flex items-center justify-center w-28 h-28">
                <img src="../assets/images/logo1.png" alt="">
            </div>
            <div>
                <p class="text-xl font-serif text-gray-700 mt-4 tracking-wide">
                    Republic of the Philippines
                    <br>
                    Province of Negros Oriental
                    <br>
                    City of Bais
                </p>
                <p class="text-xl font-serif text-gray-700 mt-4 uppercase tracking-wide">
                    <?= $d['BARANGAY'] ?>
                </p>
                <p>
                    -o0o-
                </p>
                <p class="text-xl print:text-xl font-serif pt-7 pb-7 font-semibold text-gray-700 mt-4 uppercase tracking-wide">
                    OFFICE OF THE PUNONG BARANGAY
                </p>
            </div>
            <div class="flex items-center justify-center w-28 h-28">
                <img src="../assets/images/logo2.png" alt="">
            </div>
        </div>

        <div class="text-center text-blue-900 border-t border-b border-blue-950 p-2 mb-8">
            <h2 class="text-3xl print:text-xl font-serif font-bold uppercase tracking-widest lg p-5 print:p-3">
                CERTIFICATION
            </h2>
        </div>

        <div>
            <p>
                To whom It May Concern:
            </p>
            <br>
            <p class="" style="font-style: italic;">
                This is to certify that <span class="font-bold underline"> <?= $d['FNAME'] . " " . $d['MNAME'] . " " . $d['LNAME'] ?>,<?= $d['AGE'] ?></span> years old, <span class="font-bold underline"><?= $d['SEX'] ?>, <?= $d['CIVIL'] ?>, <?= $d['CITIZEN'] ?></span> and Bonafide resident of <span class="font-bold underline"><?= $d['BARANGAY'] ?>, <?= strtoupper($d['CITY']) ?></span> , Negros Oriental. Know to be a person of good community standing and has no pending case as to this date, as far as the Office of Punong Barangay is concerned.
                <br><br><br><br>
                This certification is issued upon the request of the aboved-named person is connection with the requirements for <span class="font-bold underline"> <?= $d['PURPOSE'] ?></span>.
                <br><br><br><br>
                Issued this <span class="font-bold underline"><?= date('d', strtotime($date)) ?></span> day of <span class="font-bold underline"><?= date('F', strtotime($date)) ?></span>, <span class="font-bold underline"><?= date('Y', strtotime($date)) ?></span> at <span class="font-bold underline"><?= $d['BARANGAY'] ?>, <?= strtoupper($d['CITY']) ?></span> City, Negros Oriental, Philippines.

                <br><br><br><br><br>
            </p>



            <div class="text-center relative">
                <img src="../../uploads/<?= $d['SIGNATURE'] ?>" alt="" id="signature-image" class="absolute left-0 top-0 h-52 w-52" style="margin-top: -30px; margin-left: -5rem;">
            </div>
            <h1>Specimen Signature:</h1>
            ________________________
        </div>


    </div>
</div>


<script>
    function closeTab() {
        window.open('', '_self');
        window.close();
        window.location.href = 'requests';
    }


    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('sidebar').classList.add('hidden');
        document.getElementById('top-navigation').classList.add('hidden');
    })
</script>