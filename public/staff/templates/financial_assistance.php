<?php
$offs = $admin->getOfficialInfo($off_id);
$uid = $_SESSION['USER_ID'];
$pid = $_SESSION['PI_ID'];
$rid = $_SESSION['REQ_ID'];
$cid = $_SESSION['CERT_ID'];

$d = $admin->generate($uid, $pid, $rid, $cid);


date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d H:i:s');
?>

<style>
    .autoWidth {
        min-width: 50px;
        max-width: 100%;
        display: inline-block;
        vertical-align: middle;
        line-height: 1.5;
        padding: 0;
    }

    .hide-for-export {
        display: none !important;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #certificate,
        #certificate * {
            visibility: visible;
        }

        #certificate {
            position: absolute;
            left: 0;
            top: 0;
            width: 210mm;
            height: 297mm;
        }

        #buttons-group {
            display: none !important;
        }
    }
</style>
<!-- Add this line to load html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<center>
    <div class="inline-flex print:hidden rounded-md shadow-xs pt-3" id="buttons-group" role="group">
        <button onclick="closeTab()" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            Back to certificates
        </button>
        <button onclick="window.print()" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            Print
        </button>
        <button id="btn-send-file" onclick="sendAsMail('<?php echo $_SESSION['EMAIL'] ?>')" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            Send as mail
        </button>
    </div>
</center>


<div class="min-h-screen overflow-y-auto w-full">
    <div id="certificate" class="p-10 mx-auto bg-white"
        style="width:210mm; height:297mm; box-sizing:border-box; font-family:serif;">
        <div class="p-8 border-2 border-gray-800" style="width:100%; height:100%;">
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
                    This is to certify that
                    <span class="font-bold underline"> <?= $d['FNAME'] . " " . $d['MNAME'] . " " . $d['LNAME'] . ", " . $d['AGE'] ?></span> years old, <span class="font-bold underline"><?= $d['SEX'] ?>, <?= $d['CIVIL'] ?>, <?= $d['CITIZEN'] ?></span> and Bonafide resident of <span class="font-bold underline"><?= $d['BARANGAY'] ?>, <?= strtoupper($d['CITY']) ?></span> , Negros Oriental.
                    <br><br><br><br>

                    This is to certify that
                    <input type="text" class="autoWidth border-b border-gray-900 w-auto inline-block min-w-[50px]">
                    and
                    <input type="text" class="autoWidth border-b border-gray-900 w-auto inline-block min-w-[50px]">
                    family are classified as INDIGENT resident of
                    <input type="text" class="autoWidth border-b border-gray-900 w-auto inline-block min-w-[50px]" value="<?= $d['BARANGAY'] ?>, <?= $d['CITY'] ?> Negros Oriental.">
                    <br><br><br><br>
                    This certification is being issued upon the request of the above-named person in connection with the requirement to seek Financial Assistance for his/her
                    <input type="text" class="autoWidth border-b border-gray-900 w-auto inline-block min-w-[50px]" value="<?= $d['PURPOSE'] ?>"> at the
                    <textarea
                        class="autoWidth border-b border-gray-900 inline-block resize-none overflow-hidden align-middle"
                        rows="1"></textarea>


                    <span class="font-bold underline"><?= date('d', strtotime($date)) ?></span> day of <span class="font-bold underline"><?= date('F', strtotime($date)) ?></span>, <span class="font-bold underline"><?= date('Y', strtotime($date)) ?></span> at <span class="font-bold underline"><?= $d['BARANGAY'] ?>, <?= strtoupper($d['CITY']) ?></span> City, Negros Oriental, Philippines.

                    <br><br><br><br><br>
                </p>

                <div id="container" class="relative">
                    <div id="resizable1" style="position:absolute; top:0; left:0; display:inline-block;">
                        <img src="../../uploads/signatures/<?= $d['SIGNATURE'] ?>"
                            id="signature-image"
                            style="height:200px; width:200px; cursor:move; display:block;">

                        <div class="resize-handle" id="resize-handle1"
                            style="width:15px; height:15px; background:black; position:absolute; bottom:0; right:0; cursor:se-resize;">
                        </div>
                    </div>
                </div>

                <h1 class="float-left">
                    Specimen Signature: <br>
                    ________________________
                </h1>

                <div id="container2" class="relative">
                    <div id="resizable2" style="position:absolute; top:0; left:0; display:inline-block;">
                        <img src="../../uploads/signatures/<?= $offs['OFF_SIGNATURE'] ?>"
                            id="signature-image2"
                            style="height:200px; width:200px; cursor:move; display:block;">

                        <div class="resize-handle" id="resize-handle2"
                            style="width:15px; height:15px; background:black; position:absolute; bottom:0; right:0; cursor:se-resize;">
                        </div>
                    </div>
                </div>

                <h1 class="flex float-right text-center font-bold">
                    <?= htmlspecialchars(strtoupper($offs['F_NAME'] . " " . substr($offs['M_NAME'], 0, 1) . ". " . $offs['L_NAME'])) ?><br>
                    ________________________
                    <br>
                    Punong Barangay
                    <br>
                </h1>

            </div>
            <div class="pb-[8rem] mb-20">

            </div>


        </div>
    </div>
</div>


<script>
    $('.autoWidth').on('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    $('.autoWidth').on('input', function() {
        let len = this.value.length;
        $(this).css('width', Math.max(len + 1, 5) + 'ch');
    }).trigger('input');

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('sidebar').classList.add('hidden');
        document.getElementById('top-navigation').classList.add('hidden');
    })

    const box1 = document.getElementById("resizable1");
    const img1 = document.getElementById("signature-image");
    const handle1 = document.getElementById("resize-handle1");

    const box2 = document.getElementById("resizable2");
    const img2 = document.getElementById("signature-image2");
    const handle2 = document.getElementById("resize-handle2");

    makeDraggableResizable(box1, img1, handle1);
    makeDraggableResizable(box2, img2, handle2);


    function makeDraggableResizable(box, img, handle) {
        let isDragging = false;
        let isResizing = false;
        let offsetX = 0;
        let offsetY = 0;

        box.addEventListener("mousedown", (e) => {
            if (e.target === handle) return;
            isDragging = true;
            offsetX = e.clientX - box.offsetLeft;
            offsetY = e.clientY - box.offsetTop;
        });

        document.addEventListener("mousemove", (e) => {
            if (isDragging) {
                box.style.left = (e.clientX - offsetX) + "px";
                box.style.top = (e.clientY - offsetY) + "px";
            }

            if (isResizing) {
                let width = e.clientX - box.getBoundingClientRect().left;
                let height = e.clientY - box.getBoundingClientRect().top;

                box.style.width = width + "px";
                box.style.height = height + "px";

                img.style.width = "100%";
                img.style.height = "100%";
            }
        });

        document.addEventListener("mouseup", () => {
            isDragging = false;
            isResizing = false;
        });

        handle.addEventListener("mousedown", (e) => {
            e.stopPropagation();
            isResizing = true;
        });
    }

    function closeTab() {
        window.open('', '_self');
        window.close();
        window.location.href = 'requests';
    }

    function approveRequest() {
        const id = <?= $_SESSION['REQ_ID'] ?>;

        return fetch('../../data/staff-approved-requests.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id
                })
            })
            .then(async (res) => {
                const text = await res.text();
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error('Invalid JSON:', text);
                    throw new Error('Server returned invalid JSON');
                }
            })
            .then(data => {
                return data;
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                return {
                    success: false,
                    message: 'Request failed'
                };
            });
    }

    async function sendAsMail(email) {
        const btn = document.getElementById('btn-send-file');
        btn.innerText = "Generating PDF...";

        try {
            document.querySelectorAll('.resize-handle').forEach(el => {
                el.classList.add('hide-for-export');
            });

            const element = document.getElementById('certificate');

            const opt = {
                margin: 0,
                filename: 'certificate.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            const pdfBlob = await html2pdf().set(opt).from(element).outputPdf('blob');

            document.querySelectorAll('.resize-handle').forEach(el => {
                el.classList.remove('hide-for-export');
            });

            const formData = new FormData();
            formData.append('file', pdfBlob, 'certificate.pdf');
            formData.append('email', email);

            btn.innerText = "Sending email...";

            const res = await fetch('../../data/staff-send-certificate.php', {
                method: 'POST',
                body: formData
            });

            const result = await res.json();

            btn.innerText = "Send as mail";

            if (result.success) {
                approveRequest();

            } else {
                alert("Failed");
            }

        } catch (error) {
            document.querySelectorAll('.resize-handle').forEach(el => {
                el.classList.remove('hide-for-export');
            });

            btn.innerText = "Send as mail";
            console.error(error);
            alert(error.message);
        }
    }
</script>