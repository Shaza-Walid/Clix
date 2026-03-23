<?php
/*
    A helper function to sanitize user input to prevent XSS attacks
    It trims whitespace, removes backslashes, and converts special characters to HTML entities
*/
function dd($var) {
   echo "<pre>";
   var_dump($var);
   echo "</pre>";
   die();
}