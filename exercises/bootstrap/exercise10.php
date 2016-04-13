<?php
/**
 * Server-side processing for Exercise #10
 */

require("mysql.php");

// Process DataTables request
$start = $_REQUEST['start'];
$length = $_REQUEST['length'];
$order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0; // column index to order by
$order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : "asc"; // asc or desc
$columns = array("Code", "Name", "Continent", "Capital", "Population");
$order_by = $columns[$order_column];

// Prepare the requested data
$data = array(
    'draw' => (int) $_REQUEST['draw'],
    'recordsTotal' => get_count_total(),
    'recordsFiltered' => get_count_filtered($start, $length, $order_by, $order_dir),
    'data' => get_data($start, $length, $order_by, $order_dir)
);

$mysqli->close();

// Send back in JSON format
echo json_encode($data);
