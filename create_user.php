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
    <!-- component -->

    <!-- navbar -->
    <?php include './admin/admin-nav.php'; ?>


    <body class="min-h-screen overflow-x-hidden font-sans leading-normal bg-cream text-charcoal lg:overflow-auto">
        <main class="flex flex-col flex-1 md:p-0 lg:pt-8 lg:px-8 md:ml-24">
            <section class="p-4 shadow bg-cream-lighter">
                <div class="md:flex">
                    <h2 class="mb-6 text-sm tracking-wide uppercase md:w-1/3 sm:text-lg">Create New User</h2>
                </div>
                <form action="insert_user.php" method="post">
                    <div class="mb-8 md:flex">
                        <div class="md:w-1/3">
                            <legend class="text-sm tracking-wide uppercase">User Details</legend>
                        </div>
                        <div class="mt-2 md:flex-1 mb:mt-0 md:px-3">
                            <div class="mb-4">
                                <label class="block text-xs font-bold tracking-wide uppercase">Officer Name</label>
                                <input class="w-full p-4 border-0 shadow-inner" type="text" name="officer_name" placeholder="John Doe" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-xs font-bold tracking-wide uppercase">Officer Email</label>
                                <input class="w-full p-4 border-0 shadow-inner" type="email" name="officer_email" placeholder="john.doe@example.com" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-xs font-bold tracking-wide uppercase">Officer NIC</label>
                                <input class="w-full p-4 border-0 shadow-inner" type="text" name="officer_nic" placeholder="123456789V" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-xs font-bold tracking-wide uppercase">Officer EPF</label>
                                <input class="w-full p-4 border-0 shadow-inner" type="text" name="officer_epf" placeholder="EPF Number" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-xs font-bold tracking-wide uppercase">Phone No</label>
                                <input class="w-full p-4 border-0 shadow-inner" type="tel" name="phone_no" placeholder="(555) 555-5555" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 md:flex">
                        <div class="md:w-1/3">
                            <legend class="text-sm tracking-wide uppercase">Login Details</legend>
                        </div>
                        <div class="mt-2 md:flex-1 mb:mt-0 md:px-3">
                            <div class="mb-4">
                                <label class="block text-xs font-bold tracking-wide uppercase">Username</label>
                                <input class="w-full p-4 border-0 shadow-inner" type="text" name="user_name" placeholder="username" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-xs font-bold tracking-wide uppercase">Password</label>
                                <input class="w-full p-4 border-0 shadow-inner" type="password" name="pwd" placeholder="password" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-xs font-bold tracking-wide uppercase">Login Status</label>
                                <select class="w-full p-4 border-0 shadow-inner" name="login_sts" required>
                                    <option value="A">Active</option>
                                    <option value="D">Deactivated</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 md:flex">
                        <div class="md:w-1/3">
                            <legend class="text-sm tracking-wide uppercase">Branch Information</legend>
                        </div>
                        <div class="mt-2 md:flex-1 mb:mt-0 md:px-3">
                            <div class="mb-4">
                                <label class="block text-xs font-bold tracking-wide uppercase">Branch Code</label>
                                <select class="w-full p-4 border-0 shadow-inner" name="branch_code" required>
                                    <?php
                                    // Fetch branch codes from mast_branch table
                                    include 'db_connection.php'; // Assuming a separate DB connection file
                                    $query = "SELECT BRANCH_CODE FROM mast_branch";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['BRANCH_CODE']}'>{$row['BRANCH_CODE']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 md:flex">
                        <div class="px-3 text-center md:flex-1 md:text-right">
                            <input class="button text-cream-lighter bg-brick hover:bg-brick-dark" type="submit" value="Create User">
                        </div>
                    </div>
                </form>
            </section>
        </main>
    </body>

</body>

</html>