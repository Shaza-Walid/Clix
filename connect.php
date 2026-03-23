<?php
$host = 'localhost';
$dbname = 'clix';
$user = 'root';
$pass = '';

    /*
      الكائن دا هو اللي بجهزه عشان يستقبل مني اوامر SQL  
        PDO => PhP Data Objects
        This is a secure way to connect to a database in PHP
        It allows for prepared statements and better error handling
        It is recommended to use PDO for database interactions
        It also supports multiple database types such as MySQL, PostgreSQL, SQLite, etc.
        how PDO works:
        1. Create a new PDO instance with the database connection details
        2. Set the error mode to exception to handle errors gracefully
        3. Use prepared statements to execute queries securely
        4. Fetch results using fetch methods
        5. Close the connection when done
    */

try {
    // create a new PDO instance with the specified host, database name, username, and password
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Set the PDO error mode to exception to handle errors gracefully
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
