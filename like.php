<?php
// Include the database connection file to interact with the database
require("connect.php");

session_start();       // continue the session to access user data

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {    //if user_id is not set in session, user is not logged in, return error and exit
    echo json_encode(["status" => "error", "message" => "NOT_LOGGED_IN"]);
    exit;
}

// Get the logged-in user ID from the session
$user_id = $_SESSION["user_id"];
$post_id = $_POST["post_id"] ?? 0;  // Get the post ID from the POST request, default to 0 if not provided

if (!$post_id) {  // If no post ID is provided, return error and exit
    echo json_encode(["status" => "error", "message" => "NO_POST_ID"]);
    exit;
}

/*
    Check if the user has already liked the post by querying the 'likes' table and toggle like/unlike accordingly
    ===> ? operation is used to prevent SQL injection by using prepared statements with placeholders
    placeholders are replaced with actual values when executing the query
*/
$check = $pdo->prepare("SELECT id FROM likes WHERE user_id = ? AND post_id = ?");
$check->execute([$user_id, $post_id]);

// If a like exists, remove it (unlike); otherwise, add a new like
if ($check->rowCount() > 0) {  // If a like exists for this user and post
    // remove like
    $del = $pdo->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");  // Prepare the delete query to remove the like
    $del->execute([$user_id, $post_id]);                                          // Execute the delete query with the user ID and post ID
    echo json_encode(["status" => "success", "message" => "UNLIKED"]);            // Return success message as JSON
    exit;
}
// add like
$stmt = $pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)");      // Prepare the insert query to add a new like
$stmt->execute([$user_id, $post_id]);                                            // Execute the insert query with the user ID and post ID
echo json_encode(["status" => "success", "message" => "LIKED"]);                 // Return success message as JSON
exit;

/*
    how the code works:
    1. The script starts a session to access user data.
    2. It checks if the user is logged in by verifying the presence of 'user_id' in the session.
    3. If not logged in, it returns an error message as JSON and exits.
    4. It retrieves the logged-in user ID from the session and the post ID from the POST request.
    5. If no post ID is provided, it returns an error message as JSON and exits.
    6. It checks if the user has already liked the specified post by querying the 'likes' table.
    7. If a like exists, it removes the like from the database and returns a success message indicating "UNLIKED".
    8. If no like exists, it adds a new like to the database and returns a success message indicating "LIKED".
*/


