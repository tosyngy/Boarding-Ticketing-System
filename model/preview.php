<?php

function connect() {

      $servername = "localhost";
    $username = "id4144831_brttick";
    $password = "brttick";
    $dbname = "id4144831_brttick";


    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


$id = $_GET['ticket'];
$uid = $_SESSION['ticket'];
$ticket = array();

$conn = connect();
$sql = "SELECT tick_owner,tick_id,`tick_start_route`, `tick_end_route` , accumulator, use_accumulator,amt,unit_amt,reg_date,last_use_date,id FROM ticket where tick_id='$id' or tick_id='$uid' order by reg_date, last_use_date";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ticket = $row;
    }
}