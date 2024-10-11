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

// Fetch branch codes for dropdown
$branchCodes = getBranchCodes($conn);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate the form inputs
    $officerName = isset($_POST['officer_name']) ? $conn->real_escape_string($_POST['officer_name']) : null;
    $officerNic = isset($_POST['officer_nic']) ? $conn->real_escape_string($_POST['officer_nic']) : null;
    $officerId = isset($_POST['officer_id']) ? $conn->real_escape_string($_POST['officer_id']) : null;
    $officerEpf = isset($_POST['officer_epf']) ? $conn->real_escape_string($_POST['officer_epf']) : null;
    $officerEmail = isset($_POST['officer_email']) ? $conn->real_escape_string($_POST['officer_email']) : null;
    $officerType = isset($_POST['officer_type']) ? $conn->real_escape_string($_POST['officer_type']) : null;
    $username = isset($_POST['Username']) ? $conn->real_escape_string($_POST['Username']) : null;
    $password = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : null;
    $department = isset($_POST['department']) ? $conn->real_escape_string($_POST['department']) : null;
    $userRole = isset($_POST['user_role']) ? $conn->real_escape_string($_POST['user_role']) : null;
    $entDate = isset($_POST['ent_date']) ? $conn->real_escape_string($_POST['ent_date']) : null;
    $loginStatus = isset($_POST['login_status']) ? $conn->real_escape_string($_POST['login_status']) : null;
    $branchCode = isset($_POST['branch_code']) ? $conn->real_escape_string($_POST['branch_code']) : null;
    $phoneNo = isset($_POST['phone_no']) ? $conn->real_escape_string($_POST['phone_no']) : null;
    // Get the current date for ENT_DATE
    $entDate = date('Y-m-d');

    // Insert query to store the user data into the database
    $insertQuery = "	
    INSERT INTO user_management (OFFICER_NAME, OFFICER_NIC, OFFIER_ID, OFFICER_EPF, OFFICER_EMAIL, OFFIER_TYPE, USER_NAME, PWD, DEPARTMENT, USER_ROLL, ENT_DATE, LOGIN_STS, BRANCH_CODE, PHONE_NO)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($insertQuery)) {
        // Bind the parameters
        $stmt->bind_param(
            "ssssssssssssss",
            $officerName,
            $officerNic,
            $officerId,
            $officerEpf,
            $officerEmail,
            $officerType,
            $username,
            $password,
            $department,
            $userRole,
            $entDate,         // Current date passed here
            $loginStatus,
            $branchCode,
            $phoneNo
        );


        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('User created successfully!');</script>";
            // Redirect to the same page to clear form inputs
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<script>alert('Error creating user: " . $conn->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Database error: " . $conn->error . "');</script>";
    }
}
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
            <section class="rounded-lg shadow p-7 bg-slate-50">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-purple-900 sm:text-4xl">Create User</h2>
                    <p class="mt-2 text-lg leading-8 text-purple-600">Creation of a new user into the system
                </div>

                <form action="#" method="POST" class="max-w-xl mx-auto mt-16 sm:mt-20">


                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">

                        <!-- officer_name Field -->
                        <div class="sm:col-span-2">
                            <label for="officer_name" class="block text-sm font-semibold leading-6 text-black">Officer Name</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_name" id="officer_name"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="officer_nic" class="block text-sm font-semibold leading-6 text-black">Officer NIC</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_nic" id="officer_nic"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="officer_id" class="block text-sm font-semibold leading-6 text-black">Officer ID</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_id" id="officer_id"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="officer_epf" class="block text-sm font-semibold leading-6 text-black">Officer EPF</label>
                            <div class="mt-2.5">
                                <input type="text" name="officer_epf" id="officer_epf"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="officer_email" class="block text-sm font-semibold leading-6 text-black">Officer Email</label>
                            <div class="mt-2.5">
                                <input type="email" name="officer_email" id="officer_email"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <!-- Officer Type (Dropdown) -->
                        <div class="sm:col-span-2">
                            <label for="officer_type" class="block text-sm font-semibold leading-6 text-black">Officer Type</label>
                            <div class="mt-2.5">
                                <select name="officer_type" id="officer_type" class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                                    <option value="EXE">EXE</option>
                                    <option value="RECOVERY">RECOVERY</option>
                                    <option value="OPERATIONS">OPERATIONS</option>
                                    <option value="RMV">RMV</option>
                                    <option value="MARKETING">MARKETING</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="Username" class="block text-sm font-semibold leading-6 text-black">Username</label>
                            <div class="mt-2.5">
                                <input type="text" name="Username" id="Username"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="password" class="block text-sm font-semibold leading-6 text-black">Password</label>
                            <div class="mt-2.5">
                                <input type="text" name="password" id="password"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <!-- Department (Dropdown from DB) -->
                        <div class="sm:col-span-2">
                            <label for="department" class="block text-sm font-semibold leading-6 text-black">Department</label>
                            <div class="mt-2.5">
                                <select name="department" id="department" class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                                    <?php foreach ($branchCodes as $code): ?>
                                        <option value="<?= $code ?>"><?= $code ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- User Role (Dropdown) -->
                        <div class="sm:col-span-2">
                            <label for="user_role" class="block text-sm font-semibold leading-6 text-black">User Role</label>
                            <div class="mt-2.5">
                                <select name="user_role" id="user_role" class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6
                                0">
                                    <option value="ADMIN">Admin</option>
                                    <option value="AUDIT">Audit</option>
                                    <option value="MGR">Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="login_status" class="block text-sm font-semibold leading-6 text-black">Login Status</label>
                            <div class="mt-2.5">
                                <select name="login_status" id="login_status" class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6
                                0">
                                    <option value="A">Active</option>
                                    <option value="D">Not Active</option>
                                    <!-- <option value="MGR">Manager</option> -->
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="branch_code" name="branch_code" id="branch_code" class="block text-sm font-semibold leading-6 text-black">Branch Code</label>
                            <div class="mt-2.5">
                                <select name="branch_code" class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
                                    <?php foreach ($branchCodes as $code): ?>
                                        <option value="<?= $code ?>"><?= $code ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="phone_no" class="block text-sm font-semibold leading-6 text-black">Phone No</label>
                            <div class="mt-2.5">
                                <input type="text" name="phone_no" id="phone_no"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-purple-900 shadow-sm shadow-purple-500 ring-1 ring-inset ring-purple-300 placeholder:text-purple-400 focus:ring-2 focus:ring-inset focus:ring-purple-400 sm:text-sm sm:leading-6">
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