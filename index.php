<?php
session_start();

// Include the authentication logic
include('./Query/Auth2.php');

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    // Destroy the session if the user is logged in
    session_destroy();
    // Optionally, redirect to another page after ending the session
    header('Location: index.php'); // Redirect to the login page
    exit;
}

?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <style>
        #alert.show {
            opacity: 1;
        }
    </style>
</head>

<body>
    <!-- component -->
    <div class="bg-white dark:bg-gray-900">
        <div class="flex justify-center h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url(./images/AFPLC.png)">
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                    <div>
                        <h2 class="text-4xl font-bold text-white">Purchase Orders Portfolio</h2>
                        <p class="max-w-xl mt-3 text-gray-300"></p>
                    </div>
                </div>
            </div>

            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
                <div class="flex-1">
                    <div class="text-center">
                        <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">Purchase Orders Portfolio</h2>
                        <p class="mt-3 text-gray-500 dark:text-gray-300">Sign in to access your account</p>
                    </div>

                    <!-- Include the alert PHP file -->
                    <?php include('./Alerts.php'); ?>

                    <div class="mt-8">
                        <form method="POST" action="index.php">
                            <div>
                                <label for="username" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Username (OFFICER_ID)</label>
                                <input type="text" name="username" id="username" placeholder="Enter OFFICER_ID" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" required />
                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password" class="text-sm text-gray-600 dark:text-gray-200">Password</label>
                                </div>

                                <input type="password" name="password" id="password" placeholder="Your Password" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" required />
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-purple-800 rounded-md hover:bg-purple-400 focus:outline-none focus:bg-purple-400 focus:ring focus:ring-purple-300 focus:ring-opacity-50">
                                    Sign in
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript for handling alert visibility -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alert = document.getElementById('alert');
            if (alert) {
                alert.classList.add('show');
                setTimeout(function() {
                    alert.classList.remove('show');
                }, 2000); // Hide the alert after 2 seconds
            }
        });
    </script>
</body>

</html>