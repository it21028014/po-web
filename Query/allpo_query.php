<?php

// Function to fetch Purchase Order Requests
function getPoRequests($conn, $mgrCode)
{
    $query = "
        SELECT 
            po.CL_NIC, 
            po.APPLICATION_REF_NO, 
            po.REQ_DATE, 
            um.OFFICER_NAME,
            po.REQ_PO_STS  -- Including the status in the result set
        FROM po_request po
        JOIN user_management um ON po.REQ_OFFICER = um.OFFIER_ID
        WHERE po.MGR_CODE = ?
        ORDER BY po.REQ_DATE DESC
    ";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $mgrCode);  // Bind the manager code parameter
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === FALSE) {
            die("Query failed: " . $conn->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);  // Returning the result as an associative array
    }

    return false;
}

// Function to fetch Purchase Order Requests and calculate amounts/counts
function getPoRequestsWithDetails($conn, $mgrCode)
{
    // Initialize variables for branch code, total amount, and counts
    $branchCode = null;
    $totalAmount = 0;
    $approvedCount = 0;
    $canceledCount = 0;

    // Queries to fetch branch code, total amount, and counts
    $branchQuery = "
        SELECT BRANCH_CODE 
        FROM mast_branch 
        WHERE BR_MANAGER_CODE = ?
    ";

    // Get the current month and year
    $currentMonth = date('m');
    $currentYear = date('Y');

    // Prepare and execute the query to fetch the branch code
    if ($stmt = $conn->prepare($branchQuery)) {
        $stmt->bind_param("s", $mgrCode);  // Bind the manager's code
        $stmt->execute();
        $stmt->bind_result($branchCode);   // Fetch the branch code
        $stmt->fetch();
        $stmt->close();  // Close the statement

        // Check if a valid branch code was retrieved
        if ($branchCode) {
            // Query to get the sum of AP_INVOICE_AMT for the branch and current month
            $amountQuery = "
                SELECT SUM(AP_INVOICE_AMT) as totalAmount 
                FROM le_application 
                WHERE AP_BRANCH = ? 
                  AND AP_APPROVE_STS = '002'
                  AND MONTH(AP_APPROVE_DATE) = ? 
                  AND YEAR(AP_APPROVE_DATE) = ?
            ";

            if ($stmt = $conn->prepare($amountQuery)) {
                $stmt->bind_param("sii", $branchCode, $currentMonth, $currentYear);  // Bind branch code, month, and year
                $stmt->execute();
                $stmt->bind_result($totalAmount);  // Fetch the total amount
                $stmt->fetch();
                $stmt->close();
            }

            // Query to get the counts for approved and canceled POs for the branch and current month
            $countQuery = "
                SELECT 
                    SUM(CASE WHEN AP_APPROVE_STS = '002' THEN 1 ELSE 0 END) as approvedCount,
                    SUM(CASE WHEN AP_APPROVE_STS = '100' THEN 1 ELSE 0 END) as canceledCount
                FROM le_application 
                WHERE AP_BRANCH = ? 
                  AND MONTH(AP_APPROVE_DATE) = ? 
                  AND YEAR(AP_APPROVE_DATE) = ?
            ";

            if ($stmt = $conn->prepare($countQuery)) {
                $stmt->bind_param("sii", $branchCode, $currentMonth, $currentYear);  // Bind branch code, month, and year
                $stmt->execute();
                $stmt->bind_result($approvedCount, $canceledCount);  // Fetch the counts
                $stmt->fetch();
                $stmt->close();
            }
        }
    }

    // Query to fetch Purchase Order Requests
    $query = "
        SELECT 
            po.CL_NIC, 
            po.APPLICATION_REF_NO, 
            po.REQ_DATE, 
            um.OFFICER_NAME,
            po.REQ_PO_STS  -- Including the status in the result set
        FROM po_request po
        JOIN user_management um ON po.REQ_OFFICER = um.OFFIER_ID
        WHERE po.MGR_CODE = ?
        ORDER BY po.REQ_DATE DESC
    ";

    // Prepare and execute the query to fetch Purchase Order Requests
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $mgrCode);  // Bind the manager code parameter
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === FALSE) {
            die("Query failed: " . $conn->error);
        }

        $poRequests = $result->fetch_all(MYSQLI_ASSOC);  // Fetch the purchase order requests

        // Return the PO requests along with the calculated amounts and counts
        return [
            'requests' => $poRequests,
            'totalAmount' => $totalAmount,
            'counts' => [
                'approved' => $approvedCount,
                'canceled' => $canceledCount
            ]
        ];
    }

    return [
        'requests' => [],
        'totalAmount' => 0,
        'counts' => [
            'approved' => 0,
            'canceled' => 0
        ]
    ];  // Return default values if the query fails or no data is found
}

function getCanceledPosForBranch($conn, $mgrCode)
{
    // Initialize branch code and canceled count
    $canceledCount = 0; // Initialize canceled count
    $branchCode = null; // Initialize branch code
    $branchCodeResult = null;
    // Get the current month and year
    $currentMonth = date('m');
    $currentYear = date('Y');

    // Query to get the branch code for the logged-in manager
    $branchQuery = "
        SELECT BRANCH_CODE 
        FROM mast_branch 
        WHERE BR_MANAGER_CODE = ?
    ";

    // Prepare and execute the query to fetch the branch code
    if ($stmt = $conn->prepare($branchQuery)) {
        $stmt->bind_param("s", $mgrCode);  // Bind the manager's code
        $stmt->execute();
        $stmt->bind_result($branchCode);   // Fetch the branch code
        $stmt->fetch();
        $stmt->close();  // Close the statement

        // Check if a valid branch code was retrieved
        if ($branchCode) {
            // Now, get the count of canceled POs for the branch for the current month
            $countQuery = "
                SELECT 
                    LEFT(pcd.APP_REF_NO, 2) AS BRANCH_CODE,
                    COUNT(pcd.APP_REF_NO) AS canceled_po_count 
                FROM 
                    po_cancel_details pcd
                JOIN 
                    mast_branch mb ON mb.PO_CAN_MGR_CODE COLLATE utf8_general_ci = pcd.APPROVE_OFFICER COLLATE utf8_general_ci
                WHERE 
                    LEFT(pcd.APP_REF_NO, 2) = ? 
                    AND MONTH(pcd.APPROVE_DATE) = ?
                    AND YEAR(pcd.APPROVE_DATE) = ?
                GROUP BY 
                    LEFT(pcd.APP_REF_NO, 2)
            ";

            if ($stmt = $conn->prepare($countQuery)) {
                $stmt->bind_param("sii", $branchCode, $currentMonth, $currentYear);  // Bind branch code
                $stmt->execute();
                $stmt->bind_result($branchCodeResult, $canceledCount);  // Fetch the canceled count
                $stmt->fetch();
                $stmt->close();

                // Log the count of canceled POs
                error_log("Canceled POs Count for Branch $branchCodeResult: $canceledCount");
            } else {
                error_log("Failed to prepare count query: " . $conn->error);
            }
        } else {
            error_log("No branch code found for Manager Code: $mgrCode");
        }
    } else {
        error_log("Failed to prepare branch query: " . $conn->error);
    }

    return $canceledCount;  // Return canceled count (will be 0 if no data is found)
}
