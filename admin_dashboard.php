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
  <link href="./output.css" rel="stylesheet">
  <title>Granting Summary</title>
  <style>
    th {
      cursor: pointer;
    }

    .sort-icon {
      display: inline-block;
      width: 1rem;
      height: 1rem;
    }
  </style>
</head>

<body>
  <!-- component -->
  <div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- navbar -->
    <?php include './admin/admin-nav.php'; ?>

    <div class="flex h-screen bg-gray-200">
      <div class="flex flex-col flex-1 overflow-hidden">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
          <div class="container px-6 py-8 mx-auto">
            <h3 class="text-3xl font-medium text-gray-700 h-[4.3rem]">Granting Summary</h3>




            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-3">
              <div class="p-6 bg-white border border-gray-100 rounded-md shadow-md shadow-black/5">
                <div class="flex justify-between mb-6">
                  <div>
                    <div class="flex items-center mb-1">
                      <div class="text-2xl font-semibold">Rs. <?php echo number_format($totalAmount, 2); ?></div>
                    </div>
                  </div>
                </div>
                <div class="text-lg font-bold text-purple-600"><?php echo $currentMonthName; ?> Approved Amount</div>
              </div>
              <div class="p-6 bg-white border border-gray-100 rounded-md shadow-md shadow-black/5">
                <div class="flex justify-between mb-6">
                  <div>
                    <div class="flex items-center mb-1">
                      <div class="text-2xl font-semibold"><?php echo number_format($totalFacilityCount); ?></div>
                    </div>
                  </div>
                </div>
                <div class="text-lg font-bold text-purple-600">Approved POs</div>
              </div>
              <div class="p-6 bg-white border border-gray-100 rounded-md shadow-md shadow-black/5">
                <div class="flex justify-between mb-6">
                  <div>
                    <div class="flex items-center mb-1">
                      <div class="text-2xl font-semibold">0</div>
                    </div>
                  </div>
                </div>
                <div class="text-lg font-bold text-purple-600">Canceled POs</div>
              </div>
            </div>

            <div class="flex flex-col mt-8">
              <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                  <table id="grantingTable" class="min-w-full">
                    <thead>
                      <tr>
                        <!-- Branch -->
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                          onclick="sortTable(0, this)">Branch
                          <svg class="sort-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                          </svg>
                        </th>
                        <!-- Branch Manager Name -->
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                          onclick="sortTable(1, this)">Branch Manager Name
                          <svg class="sort-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                          </svg>
                        </th>
                        <!-- Total Amount -->
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                          onclick="sortTable(2, this)">Total Amount
                          <svg class="sort-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                          </svg>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white">
                      <?php foreach ($branchDetails as $row): ?>
                        <tr>
                          <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900"><?php echo $row['Branch']; ?></div>
                          </td>
                          <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900"><?php echo $row['Branch_Manager_Name']; ?></div>
                          </td>
                          <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">Rs. <?php echo number_format($row['Total_Amount'], 2); ?></div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>

  <script>
    function sortTable(columnIndex, headerElement) {
      var table = document.getElementById("grantingTable");
      var rows = Array.from(table.rows).slice(1); // Skip header row
      var isAsc = headerElement.getAttribute("data-sort-order") === "asc";

      // Sort rows
      rows.sort(function(rowA, rowB) {
        var cellA = rowA.cells[columnIndex].innerText.trim();
        var cellB = rowB.cells[columnIndex].innerText.trim();

        if (columnIndex === 2) { // For "Total Amount" column (numerical sorting)
          // Ensure both values are converted to numbers, treating invalid values as 0
          cellA = parseFloat(cellA.replace(/[^\d.-]/g, "")) || 0;
          cellB = parseFloat(cellB.replace(/[^\d.-]/g, "")) || 0;

          return isAsc ? cellA - cellB : cellB - cellA;
        } else {
          // Alphabetical sorting for other columns
          return isAsc ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
        }
      });

      // Toggle sort order
      headerElement.setAttribute("data-sort-order", isAsc ? "desc" : "asc");

      // Update the sort icon
      var icon = headerElement.querySelector("svg.sort-icon");
      if (isAsc) {
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>'; // Ascending icon
      } else {
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>'; // Descending icon
      }

      // Append sorted rows back to the table
      rows.forEach(function(row) {
        table.querySelector("tbody").appendChild(row);
      });
    }
  </script>
</body>

</html>