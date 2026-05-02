<?php
require_once __DIR__ . "/../model/Staff.php";
$staff = new Staff();

$id = $_POST['id'];

$get = $staff->getPost($id);
$files = json_decode($get['FILES'] ?? '[]', true);
function d($get)
{
    return htmlspecialchars($get, ENT_QUOTES, 'UTF-8');
}
?>


<form class="p-4 md:p-5" enctype="multipart/form-data">
    <div class="grid gap-4 mb-4 grid-cols-2">
        <input type="text" class="brgy_id" value="<?php echo $id ?>">
        <div class="col-span-2">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input value="<?= d($get['TITLE'] ?? '') ?>" type="text" name="name" id="post-title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Title" required="">
        </div>

        <div class="col-span-2">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea id="post-description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here">
                <?= d(trim($get['DESCRIPTION']) ?? '') ?>
            </textarea>
        </div>

        <div class="col-span-2">
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an type</label>
            <select id="tyoe" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose a type</option>
                <option value="ordinance">Ordinance</option>
                <option value="activities">Activities</option>
                <option value="announcements">Announcements</option>
            </select>
        </div>

        <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Add file</label>
            <input id="" name="files[]" accept=".jpg, .jpeg, .png, .pdf, .docx" multiple class="update-post-file block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file">
        </div>

        <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Uploaded Files
            </label>

            <div id="file-list" class="space-y-2">
                <?php if (!empty($files)): ?>
                    <?php foreach ($files as $file): ?>
                        <div class="flex items-center justify-between p-2 border rounded-lg bg-gray-50 dark:bg-gray-700">

                            <!-- File name -->
                            <span class="text-sm text-gray-800 dark:text-gray-200 truncate">
                                <?= htmlspecialchars($file) ?>
                            </span>

                            <!-- Remove button -->
                            <button type="button"
                                class="remove-file text-red-500 hover:text-red-700 text-sm font-bold"
                                data-file="<?= htmlspecialchars($file) ?>">
                                ✕
                            </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-sm text-gray-500">No files uploaded.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <button id="" type="button" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 update-post">
        Update
    </button>
</form>


<script>
    const updatePostModal = document.getElementById("modal-update-post");
    if (updatePostModal) {
        window.updatePostModalInstance = new Modal(updatePostModal);
    }

    let removedFiles = [];
    $(document).on('click', '.remove-file', function() {
        const file = $(this).data('file');
        removedFiles.push(file);

        $(this).closest('div').remove();
        console.log("Removed:", removedFiles);
    });

    $(document).on('click', '.update-post', function(e) {
        e.preventDefault();

        let brgy_id = $('.brgy_id').val();
        let files = $('.update-post-file')[0].files;

        let formData = new FormData();

        formData.append('brgy_id', brgy_id);
        formData.append('removed_files', JSON.stringify(removedFiles));

        if (files.length === 0) {
            console.log('NO FILE SELECTED');
        }

        for (let i = 0; i < files.length; i++) {
            console.log('Appending:', files[i].name);
            formData.append('files[]', files[i]);
        }

        fetch('../../data/staff-removed-files.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                activities()
                window.updatePostModalInstance.hide()
                console.log(data);
            });
    });
</script>