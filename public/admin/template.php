<?php
$json = file_get_contents('certificate_content.json');
$d = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['filename']) || !isset($_POST['paragraph1_intro'])) {
        die("POST data missing");
    }

    $filename = $_POST['filename'];
    $paragraph = $_POST['paragraph1_intro'];

    $data = [
        "paragraph1_intro" => $paragraph
    ];

    $json = json_encode($data, JSON_PRETTY_PRINT);

    if (file_put_contents($filename . ".json", $json)) {
        echo "File saved successfully!";
    } else {
        echo "Failed to save file!";
    }
}
?>

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
                    <p>Certification</p>
                </section>
            </div>

            <div>
                <section>
                    <p>To whom It May Concern,</p>
                </section>

                <section>
                    <textarea name="paragraph1_intro" class="w-full border p-2">
                        <?php echo $d['paragraph1_intro']; ?>
                    </textarea>
                </section>
            </div>
        </div>

        <br>

        <button type="button" onclick="askFile()" class="bg-green-600 p-2 text-white">
            Add
        </button>

    </form>

    <script>
        function askFile() {

            let name = prompt("Enter certificate template name:");

            if (name) {
                document.querySelector('[name="filename"]').value = name;
                document.querySelector('form').submit();
            }

        }
    </script>

</body>