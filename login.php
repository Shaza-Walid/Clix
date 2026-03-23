<?php
session_start();    // Start the session to store user data

// Include the database connection file
require("./connect.php");

header("Access-Control-Allow-Origin: *");             // Allow requests from any origin (any domain can access this script and send requests)
header("Access-Control-Allow-Methods: POST");         // Allow only POST requests
header("Access-Control-Allow-Headers: Content-Type"); // Allow Content-Type header(JSON requests)

// Check if the request method is POST. If not, do nothing
if($_SERVER["REQUEST_METHOD"]=="POST"){
 
    $data = file_get_contents("php://input");  // Get the raw POST data from the request body
    $data_arr = json_decode($data, true);      // Decode the JSON data into a PHP associative array

    $email = $data_arr["email"];
    $pass = $data_arr["password"];

    // Prepare and execute the SQL query to check if a user with the provided email and password exists
    $q2 = "SELECT id FROM users WHERE email=:email AND pass=:pass";
    $stmt2 = $pdo->prepare($q2);    // Use prepared statements to prevent SQL injection
    $stmt2->execute(["email" => $email, "pass" => $pass]);    // Execute the query with the provided email and password
    $id_arr = $stmt2->fetch(PDO::FETCH_ASSOC);     // Fetch the result as an associative array

    // Store the user ID in the session, or 0 if not found
    $_SESSION['user_id'] = $id_arr['id'] ?? 0;

    // Return the user ID as a JSON response
    if($id_arr){
        echo json_encode($id_arr);
    } else {
        echo json_encode(["id" => 0]);   // Return 0 if no matching user is found as JSON
    }
}

/*
    how the code works:
    1. The script starts a session to store user data.
    2. It includes a database connection file to interact with the database.
    3. It sets headers to allow cross-origin requests and specify allowed methods and headers.
    4. It checks if the request method is POST. If so, it proceeds to read the JSON input data from the request body.
    5. It decodes the JSON data into a PHP associative array and extracts the email and password.
    6. It prepares and executes an SQL query to check if a user with the provided email and password exists in the database.
    7. It fetches the result as an associative array and stores the user ID in the session (or 0 if not found).
    8. Finally, it returns the user ID as a JSON response. If no matching user is found, it returns 0.
*/


