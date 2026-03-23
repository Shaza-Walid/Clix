<?php
session_start();     // continue the session to access user data

// Include the database connection file to interact with the database
require("./connect.php");

//verify if user is logged in. If not, return error and exit
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo "Not logged in";
    exit;
}

$user_id = (int)$_SESSION['user_id'];    // Get the logged-in user ID from the session
$post_id = (int)($_GET['id'] ?? 0);      // Get the post ID from the GET request, default to 0 if not provided

if ($post_id <= 0) {         // If the post ID is invalid, return error and exit
    http_response_code(400);
    echo "Invalid post id";
    exit;
}

// Delete the post only if it belongs to the logged-in user (ensure ownership)
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$post_id, $user_id]);   // Execute the delete query with the post ID and logged-in user ID

// if any row was affected (post was deleted), return success message. If not, return error message.
if ($stmt->rowCount() > 0) {   
    echo "Post deleted successfully";
} else {
    http_response_code(404);
    echo "Post not found or you don't have permission";
}

/*
    how the code works:
    1. The script starts a session to access user data.
    2. It includes a database connection file to interact with the database.
    3. It checks if the user is logged in by verifying the presence of 'user_id' in the session.
    4. If not logged in, it returns a 403 error response and exits.
    5. It retrieves the logged-in user ID from the session and the post ID from the GET request.
    6. If the post ID is invalid (less than or equal to 0), it returns a 400 error response and exits.
    7. It prepares and executes a DELETE SQL query to remove the post from the database only if it belongs to the logged-in user.
    8. If the deletion is successful (row count > 0), it returns a success message; otherwise, it returns a 404 error response indicating that the post was not found or permission was denied.
*/
