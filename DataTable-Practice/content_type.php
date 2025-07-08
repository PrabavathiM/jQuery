<?php
// Sample array
$data = [
    ["Name", "Email", "Age"],
    ["Alice", "alice@example.com", 25],
    ["Bob", "bob@example.com", 30],
];

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data.csv"');
header('Pragma: no-cache');
header('Expires: 0');

// Open output stream
$output = fopen('php://output', 'w');

foreach ($data as $row) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
