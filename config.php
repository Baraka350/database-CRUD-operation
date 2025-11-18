<?php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';        
$DB_NAME = 'student_management1';


$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);


if ($mysqli->connect_errno) {
   
    die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}


$mysqli->set_charset("utf8mb4");
