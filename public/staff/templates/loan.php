<?php

$uid = $_SESSION['USER_ID'];
$pid = $_SESSION['PI_ID'];
$rid = $_SESSION['REQ_ID'];
$cid = $_SESSION['CERT_ID'];

$d = $admin->generate($uid, $pid, $rid, $cid);
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d H:i:s');
?>


<script>
    document.addEventListener("DOMContentLoaded", () => {

    })
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    'serif': ['Times New Roman', 'serif'],
                    'script': ['Brush Script MT', 'cursive'],
                }
            }
        }
    }
</script>
<style>
    @page {
        size: A4 portrait;
        margin: 0;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;
            overflow: visible !important;
        }

        body * {
            visibility: hidden;
        }

        #content-navigations,
        #content-navigations * {
            visibility: visible;
        }

        #content-navigations {
            position: absolute;
            top: 0;
            left: 0;

            width: 210mm;
            min-height: 297mm;

            padding: 15mm;
            /* SAFE PRINT MARGIN */
            box-sizing: border-box;

            overflow: visible !important;
        }
    }
</style>


<center>
    <div class="inline-flex rounded-md shadow-xs pt-3" id="buttons-group" role="group">
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

<div class="flex-1 overflow-y-auto lg:p-8 dark:bg-dark-bg bg-slate-50/50 pt-4 pr-4 pb-4 pl-4 ">

    <div class="flex-1 dark:bg-dark-bg bg-white border-2 border-gray-500 px-32 pt-20 h-auto" id="content-navigations">
        <!-- Watermark -->
        <div class="absolute inset-0 opacity-5 flex items-center justify-center pointer-events-none">
            <div class="text-8xl font-serif font-bold text-amber-800 rotate-[-5deg] tracking-widest">BAIS CITY</div>
        </div>

        <!-- Top Header Section -->
        <div class="text-center relative z-10">
            <div class="absolute left-0 top-0  w-28 h-28 bg-linear-to-br from-blue-800 to-blue-600 rounded-full shadow-lg flex items-center justify-center">
                <img src="../assets/images/logo1.png" alt="">
            </div>

            <!-- Center Header -->
            <div class="pb-8">
                <p class="text-xl font-serif font-semibold text-gray-700 mt-4 tracking-wide">
                    Republic of the Philippines
                    <br>
                    Province of Negros Oriental
                    <br>
                    City of Bais
                </p>
                <!-- <div class="w-48 h-1 from-amber-600 to-orange-500 mx-auto rounded-full shadow-md"></div> -->
                <p class="text-xl md:text-2xl font-serif font-semibold text-gray-700 mt-4 uppercase tracking-wide">
                    <?= $d['BARANGAY'] ?>
                </p>
                <p class="text-xl md:text-2xl font-serif font-semibold text-gray-700 mt-4 uppercase tracking-wide">
                    OFFICE OF THE PUNONG BARANGAY
                </p>
            </div>

            <!-- Logo 2 (Right) -->
            <div class="absolute right-0 top-0 w-28 h-28 bg-gradient-to-br from-red-600 to-orange-500 rounded-full shadow-lg flex items-center justify-center">
                <img src="../assets/images/logo2.png" alt="">
            </div>
        </div>

        <!-- Certificate Body -->
        <div class="max-w-3xl mx-auto  space-y-8">
            <!-- Certificate Title -->
            <div class="text-center from-amber-500/20 to-orange-500/20 border-t border-b border-amber-600/50  p-2 backdrop-blur-sm">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-800 uppercase tracking-widest mb-4 drop-shadow-lg">
                    CERTIFICATION
                </h2>
                <div class="w-32 h-1 from-amber-600 via-orange-500 to-red-500 mx-auto rounded-full shadow-md"></div>
            </div>

            <!-- Main Content -->
            <div class="text-lg md:text-xl leading-relaxed text-gray-700 font-serif space-y-6 px-8">
                <p>
                    To whom It May Concern:
                </p>
                <p class="" style="font-style: italic;">
                    This is to certify that <span class="font-bold underline"> <?= $d['FNAME'] . " " . $d['MNAME'] . " " . $d['LNAME'] ?>,<?= $d['AGE'] ?></span> years old, <span class="font-bold underline"><?= $d['SEX'] ?>, <?= $d['CIVIL'] ?>, <?= $d['CITIZEN'] ?></span> and Bonafide resident of <span class="font-bold underline"><?= $d['BARANGAY'] ?>, <?= strtoupper($d['CITY']) ?></span> , Negros Oriental. Know to be a person of good community standing and has no pending case as to this date, as far as the Office of Punong Barangay is concerned.
                    <br><br><br><br>
                    This certification is issued upon the request of the aboved-named person is connection with the requirements for <span class="font-bold underline"> <?= $d['PURPOSE'] ?></span>.
                    <br><br><br><br>
                    Issued this <span class="font-bold underline"><?= date('d', strtotime($date)) ?></span> day of <span class="font-bold underline"><?= date('F', strtotime($date)) ?></span>, <span class="font-bold underline"><?= date('Y', strtotime($date)) ?></span> at <span class="font-bold underline"><?= $d['BARANGAY'] ?>, <?= strtoupper($d['CITY']) ?></span> City, Negros Oriental, Philippines.

                    <br><br><br><br><br>
                </p>
                <p>
                <div class="text-center relative z-10">
                    <div class="absolute left-0 top-0 w-52 h-52" style="margin-top: -30px; margin-left: -3rem;">
                        <img src="../../uploads/<?= $d['SIGNATURE'] ?>" alt="" id="signature-image">
                    </div>

                </div>
                Specimen Signature:
                <br>
                _________________
                </p>
            </div>

            <!-- Signature Section -->
            <div class="mt-16 pt-12 border-t-4 border-dashed border-amber-600/30">
                <div class="grid md:grid-cols-3 gap-8 items-end text-left max-w-2xl mx-auto">
                    <!-- Prepared By -->
                    <div class="text-center md:text-left">
                        <p class="text-sm uppercase tracking-wider text-gray-600 font-semibold mb-2">Prepared by:</p>
                        <div class="h-24 border-t-2 border-gray-400 pt-4">
                            <p class="font-serif font-bold text-lg">MARIA SANTOS</p>
                            <p class="text-sm font-medium text-gray-600">Program Coordinator</p>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="text-center">
                        <p class="text-sm uppercase tracking-wider text-gray-600 font-semibold mb-2">Date:</p>
                        <div class="h-24 border-t-2 border-gray-400 pt-8">
                            <p class="font-serif font-bold text-xl">December 15, 2024</p>
                        </div>
                    </div>

                    <!-- Principal -->
                    <div class="text-center md:text-right">
                        <p class="text-sm uppercase tracking-wider text-gray-600 font-semibold mb-2">Certified by:</p>
                        <div class="h-24 border-t-2 border-gray-400 pt-4">
                            <p class="font-serif font-bold text-lg">DR. JOSE RIZAL</p>
                            <p class="text-sm font-medium text-gray-600">School Principal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Footer -->
        <div class="mt-16 pt-8 border-t-4 border-dashed border-amber-600/30 text-center">
            <p class="text-xs uppercase tracking-widest font-bold text-gray-500 italic">
                Official Certificate • Not Valid for Legal Purposes
            </p>
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