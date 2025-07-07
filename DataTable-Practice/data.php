<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
    
$data = [
  ["name" => "Alice", "position" => "Developer", "office" => "New York", "salary" => "$3000"],
  ["name" => "Bob", "position" => "Designer", "office" => "London", "salary" => "$2500"],
  ["name" => "Charlie", "position" => "Manager", "office" => "Tokyo", "salary" => "$4000"]
];

header('Content-Type: application/json');
echo json_encode($data);
