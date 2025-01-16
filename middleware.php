<?php
function isUser()
{
    if (isset($_SESSION['user'])) {
        return true;
    }
    header("Location: /login");
    exit;
}

function isAdmin()
{
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
        return true;
    }
    header("Location: /login");
    exit;
}

function logRequest()
{
    // Log the request for debugging or auditing
    error_log("Request received at " . date('Y-m-d H:i:s'));
    return true;
}
