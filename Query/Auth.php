<?php
// Ensure session is started only if it is not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
include('./database.php');

// Admin credentials
$adminUsername = "admin";
$adminPassword = "afsl@123";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user is the admin
    if ($username === $adminUsername && $password === $adminPassword) {
        // Redirect to the admin dashboard
        header('Location: admin_dashboard.php');
        exit;
    }

    // SQL query to check if the user exists in the user_management table
    $query = "SELECT * FROM user_management WHERE OFFIER_ID = ? AND PWD = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Check if the OFFICER_ID matches MGR_CODE in po_request table
            $query = "SELECT * FROM po_request WHERE MGR_CODE = ?";
            if ($stmt2 = $conn->prepare($query)) {
                $stmt2->bind_param("s", $username);
                $stmt2->execute();
                $result2 = $stmt2->get_result();

                if ($result2->num_rows > 0) {
                    // Store user details in session
                    $user = $result->fetch_assoc();
                    $_SESSION['user'] = $user;

                    // Redirect to the regular dashboard
                    header('Location: dashboard.php');
                    exit;
                } else {
                    // Invalid manager code
                    $_SESSION['error'] = "Invalid manager code.";
                    header('Location: index.php');
                    exit;
                }

                $stmt2->close();
            }
        } else {
            // Invalid username or password
            $_SESSION['error'] = "Invalid username or password.";
            header('Location: index.php');
            exit;
        }

        $stmt->close();
    }
}
