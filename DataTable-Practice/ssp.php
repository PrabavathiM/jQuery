<?php
$conn = new mysqli("localhost", "root", "", "ajax");
if ($conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
}

$draw = '';
$start='';
$length = '';
$draw = intval($_POST['draw']);
$start = intval($_POST['start']);
$length = intval($_POST['length']);
$searchValue = '';

if (!empty($_POST['first_name'])) {
    $searchValue = $_POST['first_name'];
} elseif (!empty($_POST['office'])) {
    $searchValue = $_POST['office'];
} elseif (!empty($_POST['Salary'])) {
    $searchValue = $_POST['Salary'];
}
$totalQuery = $conn->query("SELECT COUNT(*) As total FROM employee");
$totalRecords = $totalQuery->fetch_assoc()['total'];
$filterSql = '';
if (!empty($searchValue)) {
    $searchValue = $conn->real_escape_string($searchValue);
    $filterSql = "WHERE first_name LIKE '%$searchValue%' OR office LIKE '%$searchValue%' OR Salary LIKE '%$searchValue%'";
}
$filterQuery = $conn->query("SELECT COUNT(*) AS total FROM employee $filterSql");
$recordsFiltered = $filterQuery->fetch_assoc()['total'];
$sql = "SELECT * FROM employee $filterSql LIMIT $start, $length";
$result = $conn->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        $row['first_name'],
        $row['last_name'],
        $row['office'],
        $row['start_date'],
        $row['salary'],

    ];
}
$response = [
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $recordsFiltered,
    "data" => $data
];
header('Content-Type: application/json');
echo json_encode($response);
?>
