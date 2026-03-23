<?php
session_start();      // continue the session to access user data

// Include the database connection file to interact with the database
require("./connect.php");      

//verify if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Content-Type: application/json");    // Set the response content type to JSON
    echo json_encode([                           // Return error as JSON
        "error" => "NOT_LOGGED_IN"
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];      // Get the logged-in user ID from the session

//fetch user information from the database
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");   // Prepare SQL query to fetch user information to prevent SQL injection
$stmt->execute([$user_id]);                  // Execute the query with the logged-in user ID
$user = $stmt->fetch(PDO::FETCH_ASSOC);      // Fetch the result as an associative array

// if user not found (should not happen)
if (!$user) {
    header("Content-Type: application/json");
    echo json_encode(["error" => "USER_NOT_FOUND"]);    // Return error as JSON
    exit;
}

/*
    fetch user's posts from the database
    Prepare SQL query to fetch all posts created by the logged-in user 
    the posts are ordered by id in descending order (latest post first) to show the most recent posts at the top 
    the query uses placeholders (?) to prevent SQL injection by using prepared statements
    placeholders are replaced with actual values when executing the query
    the fetched post is stored in the $posts variable as an associative array
*/
$stmt2 = $pdo->prepare("SELECT id, content, created_at FROM posts WHERE user_id = ? ORDER BY id DESC");  // Prepare SQL query to prevent SQL injection
$stmt2->execute([$user_id]);          // Execute the query with the logged-in user ID
$posts = $stmt2->fetchAll(PDO::FETCH_ASSOC);          // Fetch all results as an associative array

// Return JSON only, no HTML
header("Content-Type: application/json");
echo json_encode([           // Return user info and posts as JSON response
    "user" => $user,
    "posts" => $posts
]);
exit;

/*
    how the code works:
    1. The script starts a session to access user data. 
    2. It includes a database connection file to interact with the database.
    3. It verifies if the user is logged in by checking the session variable 'user_id'.
    4. If the user is not logged in, it returns a JSON error response and exits.
    5. If logged in, it fetches the user's information (username) from the database.
    6. It then fetches all posts created by the logged-in user from the database.
    7. Finally, it returns the user's information and their posts as a JSON response.
*/

