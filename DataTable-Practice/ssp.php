<?php 
$conn = new mysqli("localhost","root","","ajax");
if($conn->connect_error) {
    die ("connection failed:". $conn->connect_error);
}
// $conn->close();
$draw = intval($_POST['draw']);
$start = intval($_POST['start']);
$length = intval($_POST['length']);

$totalQuery = $conn->query("SELECT COUNT(*) As total FROM employee");
$totalRecords = $totalQuery->fetch_assoc() ['total'];
$sql = "SELECT * FROM employee LIMIT $start, $length";
$result = $conn->query($sql);
// $sql_data= "SELECT * FROM employee";
// $result = $conn->query($sql_data);
$data = [];
while ($row = $result->fetch_assoc()){
    $data[] = [
        $row ['first_name'],
         $row ['last_name'],
          $row ['office'],
           $row ['start_date'],
            $row ['salary'],

    ];
}

$response = [
    "draw" => $draw,
    "totalRecords" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
];

header('Content-Type: application/json');
echo json_encode($response);


?>
