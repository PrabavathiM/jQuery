<?php
// $conn = new mysqli("localhost", "root", "", "ajax");
// if ($conn->connect_error) {
//     die("connection failed:" . $conn->connect_error);
// }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ajax";
$totalRecords = 0;
$recordsFiltered = 0;
$data = [];
$params=[];
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $draw = '';
    $start = '';
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
    $totalRecords = $totalQuery->fetch(PDO::FETCH_ASSOC)['total'];

    $filterSql = '';
    if (!empty($searchValue)) {
        $filterSql = "WHERE first_name LIKE '%$searchValue%' OR office LIKE '%$searchValue%' OR Salary LIKE '%$searchValue%'";
        $params[':search'] = "%$searchValue%";
    }
    $filterQuery = $conn->query("SELECT COUNT(*) AS total FROM employee $filterSql");
    $recordsFiltered = $filterQuery->fetch(PDO::FETCH_ASSOC)['total'];
    $sql = "SELECT * FROM employee $filterSql LIMIT $start, $length";
    $result = $conn->query($sql);
  // print_r($filterSql); die();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = [
            $row['first_name'],
            $row['last_name'],
            $row['office'],
            $row['start_date'],
            $row['salary'],

        ];
    }
} catch (PDOException $e) {
    echo "CONNECTION FAILED " . $e->getMessage();
}


$response = [
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $recordsFiltered,
    "data" => $data
];
header('Content-Type: application/json');
echo json_encode($response);
