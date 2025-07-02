<?php 
require( 'ssp.class.php');
$table = 'employee';
$primaryKey = 'id';
$columns = array(
    array( 'db' => 'first name', 'dt'=>0),
    array( 'db' => 'last name', 'dt'=>1),
    array( 'db' => 'position', 'dt'=>2),
    array( 'db' => 'office', 'dt'=>3),
    array(
         'db' => 'start_date ',
        'dt'=>4,
        'formatter' => function($d, $row){
            return date( 'jS M y', strtotime($d)); 
        }
         
    ),
    array(
        'db'        => 'salary',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return '$'.number_format($d);
        }
    )
);

$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'ajax',
    'host' => 'localhost'
);

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

?>
