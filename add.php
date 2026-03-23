<?php 

// Include the database connection file to interact with the database
require("./connect.php");

header("Access-Control-Allow-Origin: *");          // Allow requests from any origin (any domain can access this script and send requests)
header("Access-Control-Allow-Methods: POST");      // Allow only POST requests
header("Content-Type: application/json");          // Set the response content type to JSON

// Check if the request method is POST. If not, do nothing
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);     // Read JSON input data from request body and decode it into a PHP associative array

    if (!isset($data["content"]) || !isset($data["id"])) {      // check if 'content' and 'id' are present in the input data, otherwise return error and exit
        echo json_encode(["msg" => "invalid_input"]);
        exit;
    }

    $content = trim($data["content"]);   // Trim whitespace from the submitted content
    $user_id = $data["id"];

    if ($content === '') {   // If the content is empty, return error message and exit
        echo json_encode(["msg" => "empty_content"]);
        exit;
    }

    /*
    Insert the new post into the database using a prepared statement to prevent SQL injection
    the placeholders (:content, :user_id) are replaced with actual values when executing the query
    */
    $stmt = $pdo->prepare("INSERT INTO posts (content, user_id) VALUES (:content, :user_id)");
    $success = $stmt->execute([       // Execute the query with provided data
        "content" => $content,
        "user_id" => $user_id
    ]);

    echo json_encode(["msg" => $success ? "ok" : "failed"]);
}

/*
    how the code works:
    1. The script includes a database connection file to interact with the database.
    2. It sets headers to allow cross-origin requests, specify allowed methods, and set the content type to JSON.
    3. It checks if the request method is POST. If so, it proceeds to read the JSON input data from the request body.
    4. It decodes the JSON data into a PHP associative array and checks for the presence of 'content' and 'id'.
    5. It trims whitespace from the submitted content and checks if it is empty, returning an error message if so.
    6. If valid, it prepares and executes an SQL query to insert the new post into the database using a prepared statement.
    7. Finally, it returns a JSON response indicating whether the operation was successful or failed.
*/