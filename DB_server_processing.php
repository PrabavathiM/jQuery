<?php
include 'db.php';

header('Content-Type: application/json');

// 1. Get filter values
$submitEmail = $_POST['submitEmail'] ?? '';
$submitMobile = $_POST['filterMobile'] ?? '';
$filterDOB   = $_POST['filterDOB'] ?? '';

// 2. Initialize WHERE condition
$where = "WHERE 1=1";

if ($filterEmail !== '') {
    $where .= " AND email LIKE '%$filterEmail%'";
}

if ($filterPhone !== '') {
    $where .= " AND mobile_number LIKE '%$filterPhone%'";
}

if ($filterDOB !== '') {
    $where .= " AND dob = '$filterDOB'";
}

// 3. Handle pagination
$start = $_POST['start'] ?? 0;
$length = $_POST['length'] ?? 10;
$draw = $_POST['draw'] ?? 1;

// 4. Total records
$totalResult = $conn->query("SELECT COUNT(*) as total FROM reg_form");
$total = $totalResult->fetch_assoc()['total'];

// 5. Filtered records
$sql = "SELECT * FROM reg_form $where LIMIT $start, $length";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $row['actions'] = '<button class="editBtn" data-id="'.$row['id'].'">Edit</button>';
    $data[] = $row;
}

// 6. Filtered count
$countResult = $conn->query("SELECT COUNT(*) as total FROM reg_form $where");
$filteredTotal = $countResult->fetch_assoc()['total'];

// 7. Return JSON
echo json_encode([
    "draw" => intval($draw),
    "recordsTotal" => $total,
    "recordsFiltered" => $filteredTotal,
    "data" => $data
]);
