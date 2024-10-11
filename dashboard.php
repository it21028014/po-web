<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user'])) {
  header('Location: index.php'); // Redirect to login page if not logged in
  exit;
}

// Role-based access control for Admin
$userRole = $_SESSION['user']['USER_ROLL']; // Assuming USER_ROLL is stored in the user session

if ($userRole !== 'MGR') {
  header('Location: index.php'); // Redirect to login page or error page
  exit;
}

// Include database connection and query functions
include './database.php';
include './Query/dashboard_query.php';

// Get the MGR_CODE and other user details from the session
$user_code = $_SESSION['user']['OFFIER_ID'];
$officerName = isset($_SESSION['user']['OFFICER_NAME']) ? $_SESSION['user']['OFFICER_NAME'] : 'John Doe';
$branchCode = isset($_SESSION['user']['BRANCH_CODE']) ? $_SESSION['user']['BRANCH_CODE'] : 'DefaultBranch';

// Set session variables for officer name and branch code
$_SESSION['officer_name'] = $officerName;
$_SESSION['branch_code'] = $branchCode;

// Fetch data using the query functions
$poRequests = getPoRequests($conn, $user_code);
$approvedAmount = getApprovedAmountForCurrentMonth($conn, $user_code);
$canceledCount = getApprovedCount($conn, $user_code); // New function for canceled count
$approvedCount = getApprovedCount($conn, $user_code);
$canceledCount = getCanceledPosCount($conn, $user_code);

$currentMonthName = date('F');


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body class="text-gray-800 font-inter">
  <?php
  include './navbar.php';
  ?>
  <!-- Content -->
  <div class="p-6">
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-3">
      <div class="p-6 bg-white border border-gray-100 rounded-md shadow-md shadow-black/5">
        <div class="flex justify-between mb-6">
          <div>
            <div class="flex items-center mb-1">
              <div class="text-2xl font-semibold">Rs. <?php echo number_format($approvedAmount, 2); ?></div>
            </div>
          </div>
        </div>
        <div class="text-lg font-bold text-purple-600"><?php echo $currentMonthName; ?> Approved Amount</div>
      </div>
      <div class="p-6 bg-white border border-gray-100 rounded-md shadow-md shadow-black/5">
        <div class="flex justify-between mb-6">
          <div>
            <div class="flex items-center mb-1">
              <div class="text-2xl font-semibold"><?php echo $approvedCount; ?></div>
            </div>
          </div>
        </div>
        <div class="text-lg font-bold text-purple-600">Approved POs</div>
      </div>
      <div class="p-6 bg-white border border-gray-100 rounded-md shadow-md shadow-black/5">
        <div class="flex justify-between mb-6">
          <div>
            <div class="flex items-center mb-1">
              <div class="text-2xl font-semibold"><?php echo $canceledCount; ?></div>
            </div>
          </div>
        </div>
        <div class="text-lg font-bold text-purple-600">Canceled POs</div>
      </div>

    </div>


    <!-- PENDING PO TABLE START -->

    <div class="p-6 bg-white border border-gray-100 rounded-md shadow-md shadow-black/5 lg:col-span-2">
      <div class="font-medium">Pending Purchase Orders</div>
      <br>
      <div class="relative overflow-y-auto max-h-[557px]"> <!-- Adjust max-h as needed -->
        <table class="w-full text-center table-auto min-w-max">
          <thead class="sticky top-0 z-10 bg-white">
            <tr>
              <th class="p-4 border-y border-blue-gray-100">
                <p class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 text-center rounded-tl-md rounded-bl-md">
                  No.
                </p>
              </th>
              <th class="p-4 border-y border-blue-gray-100">
                <p class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 text-center">
                  NIC
                </p>
              </th>
              <th class="p-4 border-y border-blue-gray-100">
                <p class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 text-center">
                  Application No.
                </p>
              </th>
              <th class="p-4 border-y border-blue-gray-100">
                <p class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 text-center">
                  Request Date
                </p>
              </th>
              <th class="p-4 border-y border-blue-gray-100">
                <p class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 text-center">
                  Requested Officer
                </p>
              </th>
              <th class="p-4 border-y border-blue-gray-100">
                <p class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 text-center rounded-tr-md rounded-br-md">
                  Approve
                </p>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($poRequests as $index => $row): ?>
              <tr>
                <td class="p-4 border-b border-blue-gray-50">
                  <div class="flex items-center justify-center gap-3">
                    <p class="block font-sans text-sm font-bold text-blue-gray-900">
                      <?php echo $index + 1; ?>
                    </p>
                  </div>
                </td>
                <td class="p-4 border-b border-blue-gray-50">
                  <p class="block font-sans text-sm font-normal text-blue-gray-900">
                    <?php echo htmlspecialchars($row['CL_NIC']); ?>
                  </p>
                </td>
                <td class="p-4 border-b border-blue-gray-50">
                  <p class="block font-sans text-sm font-normal text-blue-gray-900">
                    <?php echo htmlspecialchars($row['APPLICATION_REF_NO']); ?>
                  </p>
                </td>
                <td class="p-4 border-b border-blue-gray-50">
                  <p class="block font-sans text-sm font-normal text-blue-gray-900">
                    <?php echo htmlspecialchars($row['REQ_DATE']); ?>
                  </p>
                </td>
                <td class="p-4 border-b border-blue-gray-50">
                  <p class="block font-sans text-sm font-normal text-blue-gray-900">
                    <?php echo htmlspecialchars($row['OFFICER_NAME']); ?>
                  </p>
                </td>

                <td class="p-4 border-b border-blue-gray-50">
                  <button class="inline-block p-1 rounded bg-rose-500/10 text-rose-500 font-bold text-[14px] leading-none" type="button" data-refno="<?php echo htmlspecialchars($row['APPLICATION_REF_NO']); ?>" data-mgrcode="<?php echo htmlspecialchars($user_code); ?>">
                    View
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- PENDING PO TABLE END -->
  </div>
  </div>
  <!-- End Content -->

  <!-- component -->

  <!-- component -->

  </main>
  <!-- script for the redirect link -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Get all buttons with the redirect functionality
      const buttons = document.querySelectorAll('button[data-refno][data-mgrcode]');

      buttons.forEach(button => {
        button.addEventListener('click', function() {
          // Get the reference number and manager code from the data attributes
          const refno = this.getAttribute('data-refno');
          const mgrcode = this.getAttribute('data-mgrcode');

          // Construct the URL
          const url = `https://afimobile.abansfinance.lk/mobilephp/Po-Details-Web-MailView.php?refno=${encodeURIComponent(refno)}&mgrcode=${encodeURIComponent(mgrcode)}`;

          // Open the URL in a new tab
          window.open(url, '_blank');
        });
      });
    });
  </script>

  <!-- script for the redirect link end -->

</body>

</html>

</body>

</html>