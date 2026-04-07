<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/output.css">
    <title>Document</title>
</head>

<body class="grid place-items-center h-dvh">
    <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="px-6 py-4">
            <div class="flex justify-center mx-auto">
                <img class="w-auto h-7 sm:h-8" src="../assets/images/banner-rework.png" alt="">
            </div>

            <!-- <h3 class="mt-3 text-xl font-medium text-center text-gray-600 dark:text-gray-200">Welcome Back</h3> -->
            <!-- <p class="mt-1 text-center text-gray-500 dark:text-gray-400">Login or create account</p> -->

            <form action="" method="post">
                <div class="w-full mt-4">
                    <input id="emp_id" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="text" placeholder="Employee Id" aria-label="" />
                </div>

                <div class="w-full mt-4">
                    <input id="emp_pass" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="password" placeholder="Password" aria-label="Password" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <button type="button" onclick="loginOfficials()" class="px-6 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        Log in
                    </button>
                </div>
            </form>
        </div>

        <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
            <span class="text-sm text-gray-600 dark:text-gray-200">Back to</span>

            <a href="../../index.php" class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline">Home</a>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const token = '<?php echo $_SESSION['token_login'] ?? ''; ?>';

        if (!token) {
            if (confirm("Session expired")) {
                window.location.href = "../../index.php";
            } else {
                window.location.href = "../../index.php";
            }
        }

        // clearSessionOnLeave();
    });

    // function clearSessionOnLeave() {
    //     window.addEventListener('beforeunload', function() {
    //         clearSession();
    //     });

    //     window.addEventListener('pagehide', function() {
    //         clearSession();
    //     });

    //     window.addEventListener('unload', function() {
    //         clearSession();
    //     });
    // }

    // function clearSession() {
    //     fetch('../../data/logout.php', {
    //         method: 'POST',
    //         credentials: 'same-origin',
    //         cache: 'no-cache'
    //     }).catch(error => {
    //         console.log('Logout request sent');
    //     });
    // }


    function loginOfficials() {
        const emp_id = document.getElementById('emp_id').value.trim();
        const emp_pass = document.getElementById('emp_pass').value.trim();

        if (!emp_id || !emp_pass) {
            alert('Please enter both Employee ID and Password.');
            return;
        }

        fetch('../../data/verification-login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    emp_id,
                    emp_pass
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while logging in.');
            });
    }
</script>

</html>