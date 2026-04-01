<?php
$json = file_get_contents('certificate_content.json');
$d = json_decode($json, true);
?>

<style>
    input {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-style: italic;
    }
</style>

<body class="bg-white text-gray-800">

    <form method="POST">

        <input type="hidden" name="filename">

        <div>
            <div id="header">
                <section><img src="" alt=""></section>

                <section class="text-center">
                    <p>Republic of the Philippines</p>
                    <p>Province of Negros Oriental</p>
                    <p>Bais City</p>
                    <p>-o0o-</p>
                </section>

                <section><img src="" alt=""></section>
            </div>

            <div id="title" style="padding-top: 4rem;">
                <section class="text-center">
                    <p>OFFICE OF THE PUNONG BARANGAY</p>
                </section>

                <section class="text-center">
                    <!-- Certification -->
                    <input type="text" class="text-center auto-expand border-b border-black outline-none" placeholder="Type" value="Certification">
                </section><br>
            </div>

            <div>
                <section>
                    <p>To whom It May Concern,</p><br>
                </section>

                <section class="">
                    <p id="p1" class="border border-red-500">
                        <input id="pr1-s1" type="text" class="text-center auto-expand ml-7 auto-expand border-b border-black outline-none" value="<?php echo $d['pr1-s1'] ?>">

                        <span class="">Full name, Citizenship, Sex, Civil, 35</span>

                        <input id="pr1-s2" type="text" class="text-center auto-expand border-b border-black outline-none" value="<?php echo $d['pr1-s2'] ?>">

                        <span>Brgy II</span>

                        <input id="pr1-s3" type="text" class="text-center auto-expand border-b border-black outline-none" value="<?php echo $d['pr1-s3'] ?>">

                        <textarea
                            id="pr1-s4"
                            class="border-b border-black outline-none resize-none w-full overflow-hidden"
                            rows="1"><?php echo $d['pr1-s4'] ?>
                        </textarea>
                        <br><br><br>
                    </p>
                    <br>
                    <p id="p2" class=" pt-9 border border-red-500">
                        <span class=" font-serif text-red-500">Paragraph #2</span><br>
                        <input id="pr1-s1" type="text" class="text-center auto-expand ml-7 auto-expand border-b border-black outline-none" value="<?php echo $d['pr1-s1'] ?>">
                        <textarea
                            id="pr1-s4"
                            class="border-b border-black outline-none resize-none w-full overflow-hidden"
                            rows="1"><?php echo $d['pr2-s1'] ?>
                        </textarea>
                    </p>
                </section>
            </div>
        </div>

        <br>
        <script>
            document.querySelectorAll("input.auto-expand").forEach(function(input) {

                function resize() {
                    // Stretch input based on value length
                    input.style.width = (input.value.length + 1) + "ch";
                }

                // Stretch when typing
                input.addEventListener("input", resize);

                // Stretch when clicked (on focus)
                input.addEventListener("click", resize);


                resize();
            });

            document.querySelectorAll("textarea").forEach(function(el) {

                function resize() {
                    el.style.height = "auto";
                    el.style.height = el.scrollHeight + "px";
                }

                el.addEventListener("input", resize);

                resize(); // on load
            });
        </script>
</body>