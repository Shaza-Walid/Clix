<?php
session_start();      // continue the session to access user data

// Include the database connection file to interact with the database
require("./connect.php");

//verify if user is logged in. If not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$user_id = (int)$_SESSION['user_id'];   // Get the logged-in user ID from the session
$post_id = (int)($_GET['id'] ?? 0);     // Get the post ID from the GET request, default to 0 if not provided

/*
    Prepare SQL query to fetch the post with the given ID that belongs to the logged-in user -> ensure ownership
    the query uses placeholders (?) to prevent SQL injection by using prepared statements
    placeholders are replaced with actual values when executing the query
    the fetched post is stored in the $post variable as an associative array
*/
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");   // Prepare SQL query to fetch the post to prevent SQL injection
$stmt->execute([$post_id, $user_id]);                                        // Execute the query with the post ID and logged-in user ID
$post = $stmt->fetch(PDO::FETCH_ASSOC);                                      // Fetch the result as an associative array

if (!$post) {  // If the post is not found or does not belong to the user, show error and exit
    die("Post not found or you don't have permission.");
}

/*
    Process form submission to update the post content:
        - Trim whitespace from the submitted content
        - Check if the content is empty and set an error message if so
        - If valid, update the post content in the database using a prepared statement
        - Redirect to the profile page after successful update
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content'] ?? '');
    if ($content === '') {
        $error = "Content cannot be empty.";
    } else {
        $update = $pdo->prepare("UPDATE posts SET content = ? WHERE id = ? AND user_id = ?");
        $update->execute([$content, $post_id, $user_id]);
        header("Location: profile.html");
        exit;
    }
}

/*
    how the code works:
    1. The script starts a session to access user data.
    2. It includes a database connection file to interact with the database.
    3. It checks if the user is logged in by verifying the presence of 'user_id' in the session.
    4. If not logged in, it redirects to the login page and exits.
    5. It retrieves the logged-in user ID from the session and the post ID from the GET request.
    6. It fetches the post from the database and verifies that it belongs to the logged-in user.
    7. If the post is not found or does not belong to the user, it displays an error message and exits.
    8. If the request method is POST, it processes the form submission to update the post content.
    9. It trims whitespace from the content and checks if it is empty; if so, it sets an error message.
    10. If valid, it updates the post content in the database and redirects to the profile page. 
*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css?v=2">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h2>Edit Post</h2>
    <!--
        Check if there is an error message set in PHP script
        If $error is not empty, display it above the form
    -->
        <?php if (!empty($error)): ?>
            <div style="color:red;">
            <!--
            Use htmlspecialchars to prevent XSS attacks
            This ensures that any HTML or script tags in the error are displayed as plain text
            -->
            <?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>   <!-- End of error display block -->
        <form method="POST">
            <div class="input-group">
                <label>Content</label>
                <textarea name="content" rows="6" style="width:100%; padding:10px; border-radius:8px;"><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>
            <button type="submit">Save</button>
            <a href="profile.html" style="color: #00C4B3">Cancel</a>
        </form>
    </div>
</body>
</html>
