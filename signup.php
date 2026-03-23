<?php
session_start(); // Start the session to store user data

// Include the database connection file
require("./connect.php");

/*
    read JSON input data from request body
    if the json request body is:
    {
        "username": "desired_username",
        "email": "user@example.com",
        "password": "secure_password"
    }
    then $data will be an associative array like:  
    $data = [
        "username" => "desired_username",
        "email" => "user@example.com",
        "password" => "secure_password"
    ];
*/
$data = json_decode(file_get_contents("php://input"), true);

//extract username, email, and password from the data array
$username = $data["username"] ?? '';   
$email = $data["email"] ?? '';
$password = $data["password"] ?? '';
/*
    note: ?? operator means if a the value is here use it,Otherwise use the default value provided(after ??)
          in the code: the default value is an empty string '' 
*/

//if any field is missing, return error as JSON and exit
if (!$username || !$email || !$password) {
    echo json_encode(["error" => "Missing fields"]);
    exit;
}

//insert new user to the database
$q = "INSERT INTO users (username, email, pass) VALUES (:username, :email, :pass)";  //[:username, :email, :pass] are placeholders for prepared statements
$stmt = $pdo->prepare($q);   // Use prepared statements to prevent SQL injection
$stmt->execute([             // Execute the query with provided data
    "username" => $username,
    "email" => $email,
    "pass" => $password
]);

// afrer executing the insert, get the last inserted ID (the column 'id' in 'users' table is auto-incremented)
$user_id = $pdo->lastInsertId();

// Create session automatically for the new user to use right after signup in the whole site
$_SESSION['user_id'] = $user_id;

// Return id and username with status success as JSON response
header("Content-Type: application/json");
echo json_encode([
    "id" => $user_id,
    "username" => $username,
    "status" => "success"
]);

/*
    how the code works:
    1. The script starts a session to store user data.
    2. It includes a database connection file to interact with the database.
    3. It reads the raw JSON input data from the request body and decodes it into a PHP associative array.
    4. It extracts the username, email, and password from the decoded data array.
    5. It checks if any of the required fields are missing. If so, it returns an error message as a JSON response and exits.
    6. It prepares and executes an SQL query to insert the new user into the 'users' table using prepared statements to prevent SQL injection.
    7. After executing the insert, it retrieves the last inserted ID (the new user's ID).
    8. It creates a session for the new user by storing the user ID in the session variable.
    9. Finally, it returns the new user's ID, username, and a success status as a JSON response.
*/
