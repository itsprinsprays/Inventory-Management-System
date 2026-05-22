<?php

function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit();
    }
}

function requireRole(string ...$roles) {
    requireLogin(); // must be logged in first
    if (!in_array($_SESSION['role'], $roles)) {
        http_response_code(403);
        die("
            <h2>Access Denied</h2>
            <p>You do not have permission to view this page.</p>
            <a href='index.php?action=dashboard'>Go back</a>
        ");
    }
}
?>