<?php

$data = [
    ["Name", "Email", "Age"],
    ["Alice", "alice@example.com", 25],
    ["Bob", "bob@example.com", 30],
    ["preethi", "preethi@gmail.com"]
];

$data = [
    ["Name", "Email", "Age"],
    ["Alice", "alice@example.com", 25],
    ["Bob", "bob@example.com", 30],
    ["preethi", "preethi@gmail.com"]
];
 


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data.csv"');
header('Pragma: no-cache');
header('Expires: 0');


$output = fopen('php://output', 'w');

foreach ($data as $row) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
