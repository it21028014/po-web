<?php
session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit;
}

// Role-based access control for Admin
$userRole = $_SESSION['user']['USER_ROLL']; // Assuming USER_ROLL is stored in the user session

if ($userRole !== 'ADMIN') {
    header('Location: index.php'); // Redirect to login page or error page
    exit;
}

// Get the MGR_CODE from the session
$user_code = $_SESSION['user']['OFFIER_ID'];

// Retrieve the officer's name from the session
$officerName = isset($_SESSION['user']['OFFICER_NAME']) ? $_SESSION['user']['OFFICER_NAME'] : 'Default User';
$branchCode = isset($_SESSION['user']['BRANCH_CODE']) ? $_SESSION['user']['BRANCH_CODE'] : 'DefaultBranch';


// Include required files
include './Query/admin_query.php';
include './database.php'; // Assuming you have a connection file

// Fetch branch-wise and total data from the query
$data = getBranchWiseAndTotalAmount($conn);

$branchDetails = $data['branchDetails'];
$totalAmount = $data['totalAmount'];
$totalFacilityCount = $data['totalFacilityCount'];
$currentMonthName = date('F');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Creation</title>
</head>

<body>
    <!-- navbar -->
    <?php include './admin/admin-nav.php'; ?>

    <body class="min-h-screen overflow-x-hidden font-sans leading-normal bg-cream text-charcoal lg:overflow-auto">
        <main class="flex flex-col flex-1 md:p-0 lg:pt-8 lg:px-8 md:ml-24">
            <section class="rounded-lg shadow p-7 bg-slate-50">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Create User</h2>
                    <p class="mt-2 text-lg leading-8 text-gray-600">Creation of a new user into the system
                </div>
                <form action="#" method="POST" class="max-w-xl mx-auto mt-16 sm:mt-20">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                        <!-- officer_name Field -->
                        <div class="sm:col-span-2">
                            <label for="officer_name" class="block text-sm font-semibold leading-6 text-black">Officer Name</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_name" id="officer_name"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="officer_nic" class="block text-sm font-semibold leading-6 text-black">Officer NIC</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_nic" id="officer_nic"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="officer_id" class="block text-sm font-semibold leading-6 text-black">Officer ID</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_id" id="officer_id"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="officer_epf" class="block text-sm font-semibold leading-6 text-black">Officer EPF</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_epf" id="officer_epf"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="officer_name" class="block text-sm font-semibold leading-6 text-black">Officer Email</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_name" id="officer_emil"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="officer_name" class="block text-sm font-semibold leading-6 text-black">Officer Type</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_name" id="officer_name"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="Username" class="block text-sm font-semibold leading-6 text-black">Username</label>
                            <div class="mt-2.5">
                                <input type="text" name="Username" id="Username"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="password" class="block text-sm font-semibold leading-6 text-black">Password</label>
                            <div class="mt-2.5">
                                <input type="text" name="password" id="password"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="department" class="block text-sm font-semibold leading-6 text-black">Department</label>
                            <div class="mt-2.5">
                                <input type="text" name="department" id="department"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="user_role" class="block text-sm font-semibold leading-6 text-black">User Role</label>
                            <div class="mt-2.5">
                                <input type="text" name="user_role" id="user_role"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="login_status" class="block text-sm font-semibold leading-6 text-black">Login Status</label>
                            <div class="mt-2.5">
                                <input type="text" name="login_status" id="login_status"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="officer_name" class="block text-sm font-semibold leading-6 text-black">Branch Code</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_name" id="branch_code"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <br>
                        <div class="items-center mt-10 transition duration-300 ease-in-out delay-150 bg-purple-500 rounded-md mx-30 align-center hover:-translate-y-1 hover:scale-110 hover:bg-purple-700">
                            <button type="submit"
                                class=" block w-full rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm">
                                Create User
                            </button>
                        </div>
                    </div>
                    </div>
                </form>
            </section>
        </main>
    </body>

</body>

</html>