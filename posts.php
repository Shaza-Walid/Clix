<?php
require("./connect.php");     // Include the database connection file to interact with the database
session_start();   // continue the session to access user data

// Get the logged-in user ID, or 0 if not logged in
$user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

/*
    Prepare the SQL query to fetch posts along with:
    - total likes for each post
    - whether the logged-in user has liked each post
    The query joins the 'posts' table with the 'users' table to get the username of the post creator,
    and left joins with the 'likes' table to count likes and check if the logged-in user has liked each post.
    the query uses placeholders (?) to prevent SQL injection by using prepared statements
    placeholders are replaced with actual values when executing the query
    the fetched post is stored in the $posts variable as an associative array
 */
$sql = "
    SELECT 
        posts.id,
        posts.content,
        posts.user_id,
        users.username,
        COUNT(likes.id) AS total_likes,
        SUM(CASE WHEN likes.user_id = ? THEN 1 ELSE 0 END) AS liked_by_user
    FROM posts
    JOIN users ON posts.user_id = users.id
    LEFT JOIN likes ON posts.id = likes.post_id
    GROUP BY posts.id, posts.content, posts.user_id, users.username
    ORDER BY posts.id DESC

";

$stmt = $pdo->prepare($sql);   // Prepare the SQL query to prevent SQL injection
$stmt->execute([$user_id]);    // Execute the query with the logged-in user ID as parameter to check if the user has liked each post 
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);    // Fetch all results as an associative array to return as JSON

header('Content-Type: application/json');     // Set the response content type to JSON to inform the client(frontend) about the response format
echo json_encode(["posts" => $posts]);        // Return the posts data as a JSON response to the client(frontend)
exit;

/*
    how the code works:
    1. The script starts a session to access user data.
    2. It includes a database connection file to interact with the database.
    3. It retrieves the logged-in user ID from the session, defaulting to 0 if not logged in.
    4. It prepares an SQL query to fetch posts along with the total likes and whether the logged-in user has liked each post.
    5. It executes the query and fetches all results as an associative array.
    6. Finally, it returns the posts data as a JSON response.
*/

