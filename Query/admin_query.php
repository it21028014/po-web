<?php
// admin_query.php

// Function to fetch branch-wise and total amount
function getBranchWiseAndTotalAmount($conn)
{
    $currentMonth = date('m');
    $currentYear = date('Y');

    // Query to get the approved sum and count for each branch
    $branchQuery = "
        SELECT br.BRANCH_NAME AS Branch,
               um.OFFICER_NAME AS Branch_Manager_Name, 
               SUM(le.AP_INVOICE_AMT) AS Total_Amount,
               COUNT(le.APPLICATION_REF_NO) AS Facility_Count
        FROM le_application le
        JOIN mast_branch br ON le.AP_BRANCH = br.BRANCH_CODE
        LEFT JOIN user_management um ON br.BR_MANAGER_CODE = um.OFFIER_ID
        WHERE le.AP_APPROVE_STS = '002'
          AND MONTH(le.AP_APPROVE_DATE) = ?
          AND YEAR(le.AP_APPROVE_DATE) = ?
        GROUP BY br.BRANCH_NAME, um.OFFICER_NAME";

    // Query to get the total approved amount and count for all branches
    $totalQuery = "
        SELECT SUM(AP_INVOICE_AMT) AS Total_Amount, COUNT(APPLICATION_REF_NO) AS Facility_Count
        FROM le_application
        WHERE AP_APPROVE_STS = '002'
          AND MONTH(AP_APPROVE_DATE) = ?
          AND YEAR(AP_APPROVE_DATE) = ?";

    $branchDetails = [];
    $totalAmount = 0;
    $totalFacilityCount = 0;

    // Execute branch-wise query
    if ($stmt = $conn->prepare($branchQuery)) {
        $stmt->bind_param("ii", $currentMonth, $currentYear);
        $stmt->execute();
        $result = $stmt->get_result();
        $branchDetails = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    // Execute total query
    if ($stmt = $conn->prepare($totalQuery)) {
        $stmt->bind_param("ii", $currentMonth, $currentYear);
        $stmt->execute();
        $stmt->bind_result($totalAmount, $totalFacilityCount);
        $stmt->fetch();
        $stmt->close();
    }

    return [
        'branchDetails' => $branchDetails,
        'totalAmount' => $totalAmount,
        'totalFacilityCount' => $totalFacilityCount
    ];
}

// Function to fetch branch codes for dropdown
function getBranchCodes($conn)
{
    $branchQuery = "SELECT BRANCH_CODE FROM mast_branch";
    $branchCodes = [];

    if ($result = $conn->query($branchQuery)) {
        while ($row = $result->fetch_assoc()) {
            $branchCodes[] = $row['BRANCH_CODE'];
        }
    }

    return $branchCodes;
}
