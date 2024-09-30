<?php
// Ensure session is started only if it is not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
include('./database.php');

// Admin credentials for fallback admin login (hardcoded example)
$adminUsername = "admin";
$adminPassword = "afsl@123";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if the user exists in the user_management table with LOGIN_STS 'A'
    $query = "SELECT * FROM user_management WHERE OFFIER_ID = ? AND PWD = ? AND LOGIN_STS = 'A'";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch user details
            $user = $result->fetch_assoc();
            $officerName = $user['OFFICER_NAME'];
            $branchCode = $user['BRANCH_CODE'];

            // Marketing Executive login: USER_ROLL = 'EXE'
            if ($user['USER_ROLL'] === 'EXE') {
                $_SESSION['user'] = $user;  // Store user details in session
                $_SESSION['officer_name'] = $officerName;
                $_SESSION['branch_code'] = $branchCode;

                // Redirect to the executive dashboard
                header('Location: executive_dashboard.php');
                exit;
            }

            // Manager login: USER_ROLL = 'MGR', check BR_MANAGER_CODE in mast_branch
            elseif ($user['USER_ROLL'] === 'MGR') {
                $managerQuery = "SELECT * FROM mast_branch WHERE BR_MANAGER_CODE = ?";
                if ($stmt2 = $conn->prepare($managerQuery)) {
                    $stmt2->bind_param("s", $username);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();

                    if ($result2->num_rows > 0) {
                        $_SESSION['user'] = $user;  // Store user details in session
                        $_SESSION['officer_name'] = $officerName;
                        $_SESSION['branch_code'] = $branchCode;

                        // Redirect to the manager's dashboard
                        header('Location: dashboard.php');
                        exit;
                    } else {
                        // Invalid manager code
                        $_SESSION['error'] = "Invalid manager credentials.";
                        header('Location: index.php');
                        exit;
                    }

                    $stmt2->close();
                }
            }

            // Admin login: USER_ROLL = 'ADMIN'
            elseif ($user['USER_ROLL'] === 'ADMIN') {
                $_SESSION['user'] = $user;  // Store user details in session
                $_SESSION['officer_name'] = $officerName;
                $_SESSION['branch_code'] = $branchCode;

                // Redirect to the admin dashboard
                header('Location: admin_dashboard.php');
                exit;
            }
        } else {
            // Check if the user is the fallback admin
            if ($username === $adminUsername && $password === $adminPassword) {
                // Redirect to the admin dashboard
                header('Location: admin_dashboard.php');
                exit;
            }

            // Invalid credentials
            $_SESSION['error'] = "Invalid username or password.";
            header('Location: index.php');
            exit;
        }

        $stmt->close();
    }
}
